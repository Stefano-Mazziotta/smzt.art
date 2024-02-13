<?php

namespace App\Services;

use App\Enums\ExtensionImage;
use App\Models\Photo;
use Illuminate\Http\UploadedFile;

use Intervention\Image\Interfaces\ImageInterface;
use Illuminate\Support\Facades\Storage;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PhotoService
{
    private $masonryGalleryDisk = "masonry_gallery";
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

    private function optimize(ImageInterface $image)
    {
        $imageWidth = $image->width();
        $imageHeight = $image->height();

        $imageCompressed = $image
            ->scaleDown(1280, 720)
            ->toWebp(90);

        return $imageCompressed;
    }

    public function uploadPhoto($uploadedPhoto)
    {
        // upload photo
        // - generate name file
        $photoName = $this->generateName(ExtensionImage::WEBP);

        $uploadedPhotoImg = $this->imageManager->read($uploadedPhoto);
        // - optimize image
        // - save image to /public/gallery

        // - save image's lightbox to /public/lightbox with the same name
        $this->uploadLightbox($uploadedPhoto, $photoName);

        // call createPhoto()

    }

    public function uploadPhotos(array $uploadedPhotos): array
    {
        foreach ($uploadedPhotos as $key => $uploadedPhoto) {
            $this->uploadPhoto($uploadedPhoto);
        }

        return [];
    }

    /**
     * @description create photo entity
     */
    public function create(array $photoData): Photo
    {
        // - relations between photo-album photo-label

        $photo = Photo::Create([
            'title' => 'test',
            // ... complete
        ]);

        return $photo;
    }

    private function uploadLightbox($uploadedPhoto, $photoName)
    {
    }

    public function uploadFeaturedPhoto(UploadedFile $featuredPhotoFile): string
    {
        $featuredPhotoName = $this->generateName(ExtensionImage::WEBP);
        $featuredPhoto = $this->imageManager->read($featuredPhotoFile);

        $compressedPhoto = $this->optimize($featuredPhoto);

        Storage::disk($this->albumFeaturedPhotosDisk)->put($featuredPhotoName, $compressedPhoto->__toString()); // save image to album featured photo  disk

        $path = '/uploads/album_featured_photos/' . $featuredPhotoName;
        return $path;
    }
}
