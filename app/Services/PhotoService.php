<?php

namespace App\Services;

use App\Enums\ExtensionImage;
use App\Models\Photo;
use Illuminate\Http\UploadedFile;

use Intervention\Image\Interfaces\ImageInterface;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\Interfaces\EncodedImageInterface;

class PhotoService
{
    private $galleryDisk = "gallery";
    private $lightboxDisk = "lightbox";
    private $albumFeaturedPhotosDisk = "album_featured_photos";
    protected ImageManager $imageManager;

    public function __construct()
    {
        $this->imageManager = new ImageManager(new Driver());
    }

    private function generateName(ExtensionImage $extension): string
    {
        $fileName = str()->uuid() . '_' . time() . "." . $extension->value;
        return $fileName;
    }

    private function optimizeToGallery(ImageInterface $image)
    {
        $imageWidth = $image->width();
        $imageHeight = $image->height();

        $isVertical = $imageHeight > $imageWidth;

        $width = 1280;
        $height = 720;

        if ($isVertical) {
            $width = 720;
            $height = 1280;
        }

        $imageCompressed = $image
            ->scaleDown($width, $height)
            ->toWebp(90);

        return $imageCompressed;
    }

    private function optimizeToLightbox(ImageInterface $image)
    { {
            $imageWidth = $image->width();
            $imageHeight = $image->height();

            $isVertical = $imageHeight > $imageWidth;

            $width = 1920;
            $height = 1080;

            if ($isVertical) {
                $width = 1080;
                $height = 1920;
            }

            $imageCompressed = $image
                ->scaleDown($width, $height)
                ->toWebp(90);

            return $imageCompressed;
        }
    }

    private function save(string $disk, string $photoName, EncodedImageInterface $photo): bool
    {
        $result = Storage::disk($disk)->put($photoName, $photo->__toString());
        return $result;
    }

    private function uploadLightbox(UploadedFile $photo, string $photoName): bool
    {
        $image = $this->imageManager->read($photo);
        $optimizedPhoto = $this->optimizeToLightbox($image);

        $isSaved = $this->save($this->lightboxDisk, $photoName, $optimizedPhoto);
        return $isSaved;
    }

    private function uploadPhoto(UploadedFile $photo): string
    {
        $photoName = $this->generateName(ExtensionImage::WEBP);

        $image = $this->imageManager->read($photo);
        $optimizedPhoto = $this->optimizeToGallery($image);

        $isSaved = $this->save($this->galleryDisk, $photoName, $optimizedPhoto);

        // - save image's lightbox to /public/lightbox with the same name
        $isLightboxSaved = $this->uploadLightbox($photo, $photoName);

        return $photoName;
    }

    public function store(array $photoData): Photo
    {
        // entity
        $locationId = $photoData['locationId'];
        $cameraId = $photoData['cameraId'];
        $filmId = $photoData['filmId'];
        $title = $photoData['title'];
        $description = $photoData['description'];
        $width = $photoData['width'];
        $height = $photoData['height'];

        $uploadedPhoto = $photoData['photo'];
        $photoName = $this->uploadPhoto($uploadedPhoto);

        // - relations between photo-label
        $labelsId = $photoData['labelsId'];

        $photo = Photo::Create([
            'location_id' => $locationId,
            'camera_id' => $cameraId,
            'film_id' => $filmId,
            'title' => $title,
            'description' => $description,
            'width' => $width,
            'height' => $height,
            'path' => $photoName
        ]);

        return $photo;
    }

    public function storePhotos(array $uploadedPhotos): array
    {
        $photos = [];
        foreach ($uploadedPhotos as $key => $photo) {

            $photo = $this->store($photo);
            array_push($photos, $photo);
        }
        return $photos;
    }

    public function uploadFeaturedPhoto(UploadedFile $featuredPhoto): string
    {
        $photoName = $this->generateName(ExtensionImage::WEBP);
        $image = $this->imageManager->read($featuredPhoto);

        $optimizedPhoto = $this->optimizeToGallery($image);

        $this->save($this->albumFeaturedPhotosDisk, $photoName, $optimizedPhoto);

        $path = '/uploads/album_featured_photos/' . $photoName;
        return $path;
    }
}
