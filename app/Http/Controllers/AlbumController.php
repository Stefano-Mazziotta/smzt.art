<?php

namespace App\Http\Controllers;

use App\Models\Album;

use Illuminate\Http\Request;
use App\Http\Requests\StoreAlbumRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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


        $validated = $request->validated();
    
        $thumbnailFile = $validated['thumbnail'];
        
        // Generate a unique name for the file
        $thumbnailName = 'test_' . time() . '.' . $thumbnailFile->getClientOriginalExtension();

        $thumbnailPath = $thumbnailFile->storeAs('', $thumbnailName, 'public');
        return ['thumbnail_path' => $thumbnailPath];

        // Storage::disk('public')->put('test', $thumbnail);
        
        

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
