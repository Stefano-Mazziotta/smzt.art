<?php

namespace App\Http\Controllers;


use App\Models\Album;

use App\Services\AlbumService;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAlbumRequest;


class AlbumController extends Controller
{
    protected AlbumService $albumService;
    public function __construct(AlbumService $albumService)
    {
        $this->albumService = $albumService;
    }

    public function index()
    {
        return Album::all();
    }

    public function store(StoreAlbumRequest $request)
    {
        try {

            $newAlbum = $this->albumService->store($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Album created successfully',
                'data' => $newAlbum
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating the album',
            ], 500);
        }
    }

    public function show(Album $album)
    {
        //
    }

    public function update(Request $request, Album $album)
    {
        //
    }

    public function destroy(Album $album)
    {
        //
    }
}
