<?php

namespace App\Services;

use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Http;

class LastFmApiService
{
    private string $link;
    private string $key;
    private string $format;

    public function __construct()
    {
        $this->link = env('LASTFM_API_LINK', 'http://ws.audioscrobbler.com/2.0/');
        $this->key = env('LASTFM_API_KEY', '53c674fc2dcdef14adddaa1ccc577718');
        $this->format = env('LASTFM_API_FORMAT', 'json');
    }

    public function getArtist(string $name) : array|null
    {
        $response = $this->getInfoArtistResponse($name);

        if (!$response) {
            return abort(404, 'Артист не найден');
        }

        $artist = [
            'name' => $response['name'],
            'photo' => $response['image']['5']['#text'],
        ];

        return $artist;
    }

    public function getDescription(string $artist) : array|null
    {
        $response = $this->getInfoArtistResponse($artist);

        if (!$response) {
            return abort(404, 'Описание не найдено');
        }

        $description = [
            'description' => $response['bio']['summary']
        ];

        return $description;
    }

    public function getAlbum(string $artist, string $album) : array|null
    {
        $response = $this->getInfoAlbumResponse($artist, $album);

        if (!$response) {
            return abort(404, 'Альбом не найден');
        }

        $album = [
            'album' => $response['name'],
            'cover' => $response['image']['5']['#text'],
        ];

        return $album;
    }

    public function search(string $key, string $text) : array|null
    {
        $response = $this->searchResponse($key, $text);

        if (!$response) {
            return abort(404, 'Ничего не найдено');
        }

        return $response;
    }

    protected function getInfoArtistResponse(string $artist) : array|null
    {
        try {
            $response = Http::get($this->link, [
                'method' => "artist.getInfo",
                'api_key' => $this->key,
                'artist' => $artist,
                'format' => $this->format,
                'autocorrect' => 1
            ]);
        } catch (RequestException) {
            return abort(500, 'Ошибка подключения');
        }

        $response = json_decode($response, true);

        if (array_key_exists('error', $response)) {
            return null;
        }
        return $response['artist'];
    }

    protected function getInfoAlbumResponse(string $album, string $artist) : array|null
    {
        try {
            $response = Http::get($this->link, [
                'method' => "album.getInfo",
                'api_key' => $this->key,
                'artist' => $artist,
                'album' => $album,
                'format' => $this->format,
                'autocorrect' => 1
            ]);
        } catch (RequestException) {
            return abort(500, 'Ошибка подключения');
        }

        $response = json_decode($response, true);

        if (array_key_exists('error', $response))
        {
            return null;
        }
        return $response['album'];
    }

    protected function searchResponse(string $key, string $text) : array|null
    {
        try {
            $response = Http::get($this->link, [
                'method' => "{$key}.search",
                'api_key' => $this->key,
                $key => $text,
                'format' => $this->format,
            ]);
        } catch (RequestException) {
            return abort(500, 'Ошибка подключения');
        }

        $matches = json_decode($response, true);

        if (!$matches['results']["{$key}matches"]) {
            return null;
        }

        return $matches['results']["{$key}matches"][$key];
    }
}
