<?php

namespace App\Repository\Album;

use App\Models\Album;
use Illuminate\Pagination\LengthAwarePaginator;

class AlbumRepository implements AlbumRepositoryInterface
{
    public function getAllAlbums(int $paginate = 5) : LengthAwarePaginator
    {
        return Album::orderBY("created_at", "DESC")->paginate($paginate);
    }

    public function getAlbumsByArtist(int $id, int $paginate = 5) : LengthAwarePaginator
    {
        return Album::where(['artist_id' => $id])->orderBY("created_at", "DESC")->paginate($paginate);
    }

    public function getAlbum(int $id) : ?Album
    {
        return Album::find($id);
    }

    public function getAlbumWithParams(array $params) : ?Album
    {
        return Album::where($params)->first();
    }

    public function createAlbum(array $params) : Album
    {
        return Album::create($params);
    }

    public function updateAlbum(int $id, array $params) : ?Album
    {
        $album = $this->getAlbum($id);
        if ($album)
        {
            $album->update($params);
            return $album;
        }
        return null;
    }

    public function deleteAlbum(int $id) : void
    {
        $album = $this->getAlbum($id);
        if ($album)
        {
            $album->delete();
        }
    }
}
