<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\LastFmApiService;
use Illuminate\Http\JsonResponse;

class LastFmController extends Controller
{
    private LastFmApiService $service;

    public function __construct(LastFmApiService $service)
    {
        $this->service = $service;
    }

    public function getArtist(string $artist) : JsonResponse
    {
        $artist = $this->service->getArtist($artist);
        return response()->json($artist);
    }

    public function getDescription(string $artist) : JsonResponse
    {
        $description = $this->service->getDescription($artist);
        return response()->json($description);
    }

    public function getAlbum(string $artist, string $album) : JsonResponse
    {
        $albumInfo = $this->service->getAlbum($artist, $album);
        return response()->json($albumInfo);
    }

    public function search(string $key, string $text) : JsonResponse
    {
        $response = $this->service->search($key, $text);
        return response()->json($response);
    }
}
