<?php

namespace App\Services;

use App\Models\Album;

class AlbumService
{
    protected PhotoService $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function store(array $albumData): Album
    {
        // entity
        $title = $albumData['title'];
        $description = $albumData['description'];
        $slug = $this->generateSlug($title);
        $featuredPhotoFile = $albumData['featuredPhoto'];

        $featuredPhotoPath = $this->photoService->uploadFeaturedPhoto($featuredPhotoFile);

        // Create a new album with the validated data
        $album = Album::create([
            'title' => $title,
            'description' => $description,
            'slug' => $slug,
            'featuredPhoto' => $featuredPhotoPath
        ]);

        $uploadedPhotos = $albumData['photos'];
        $photos = $this->photoService->storePhotos($uploadedPhotos); // return a photo entity array 



        // relations
        $labelIds = $albumData['labelIds']; // array label entity


        // create relations between album-photo
        // create relations between album-label


        return $album;

        // // // Create a new album with the validated data
        // // $album = Album::create([
        // //     'title' => $validatedData['title'],
        // //     'description' => $validatedData['description'],
        // //     'slug' => $validatedData['title'], // Generate a slug from the title
        // //     'thumbnail' => $thumbnailPath,
        // // ]);

        // // Attach photos to the album
        // if (isset($validatedData['photos'])) {
        //     $album->photos()->attach($validatedData['photos']);
        // }

        // // Attach labels to the album
        // if (isset($validatedData['labels'])) {
        //     $album->labels()->attach($validatedData['labels']);
        // }
    }

    private function generateSlug(string $title): string
    {
        $slug = str_replace(" ", "-", $title);
        return $slug;
    }
}
