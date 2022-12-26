<?php

namespace App\Repository\Album;

use App\Models\Album;
use Illuminate\Pagination\LengthAwarePaginator;

interface AlbumRepositoryInterface
{
    public function getAllAlbums(int $paginate = 5) : LengthAwarePaginator;

    public function getAlbum(int $id) : ?Album;

    public function getAlbumWithParams(array $params) : ?Album;

    public function updateAlbum(int $id, array $params) : ?Album;

    public function deleteAlbum(int $id) : void;

}
