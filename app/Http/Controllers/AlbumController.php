<?php

namespace App\Http\Controllers;

use App\Models\Album;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAlbumRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Imagick\Driver;
use Intervention\Image\ImageManager;
use Intervention\Image\Interfaces\ImageInterface;

class AlbumController extends Controller
{

    private $disk = "public";
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Album::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAlbumRequest $request)
    {
        try {
        

            // utilizar storage para almacenar los archivos optimizados
            $validated = $request->validated();
            $manager = new ImageManager(new Driver());
            
            $featuredImgFile = $validated['featuredImage'];
            $featuredImgName = str()->uuid().'-'. time().".webp"; // Generate a unique name for the file            

            $featuredImage = $manager->read($featuredImgFile);

            $saveUrl = public_path() . "uploads/".$featuredImgName; 
            $compressedFile = $this->compressImage($featuredImage, $saveUrl);
            
            $path = Storage::disk('album_featured_images')->put($featuredImgName, $compressedFile->__toString());

            return [
                'thumbnail_path' => $path,
            ];

            
            

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
        } catch (\Throwable $th) {
            error_log("Mi error: ".$th->getMessage());
            // return redirect()->back()->with('error', 'Error creating the album');
        }
       
     
    }

    // compress image se va a compartir entre modulos
    private function compressImage(ImageInterface $image, string $saveUrl){
        $imageWidth = $image->width();
        $imageHeight = $image->height();

        $imageCompressed = $image
            ->scaleDown(1280,720)
            ->toWebp(90);

        return $imageCompressed;
        // $imageCompressed->save(base_path($saveUrl));
    }

    /**
     * Display the specified resource.
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Album $album)
    {
        //
    }
}
