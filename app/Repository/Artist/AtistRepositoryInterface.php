<?php

namespace App\Repository\Artist;

use App\Models\Artist;

interface AtistRepositoryInterface
{
    public function findArtist(int $id) : ?Artist;

    public function createArtist(array $params) : Artist;

    public function updateArtist(int $id, array $params) : ?Artist;
}
