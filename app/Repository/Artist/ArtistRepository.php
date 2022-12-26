<?php

namespace App\Repository\Artist;

use App\Models\Artist;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class ArtistRepository implements AtistRepositoryInterface
{
    public function findArtist($id) : ?Artist
    {
        return Artist::find($id);
    }

    public function findOrCreateArtist(string $name, int $userId) : Artist
    {
        $artist = $this->findArtistByName($name);

        if (!$artist)
        {
            $artist = $this->createArtist(['name' => $name, 'user_id' => $userId]);
        }

        return $artist;
    }

    public function getAllArtist() : Collection
    {
        return Artist::all();
    }

    public function getAllArtistWithPaginate(int $paginate = 5) : LengthAwarePaginator
    {
        return Artist::orderBY("created_at", "DESC")->paginate($paginate);
    }

    public function findArtistByName(string $name) : ?Artist
    {
        return Artist::where(['name' => $name])->first();
    }

    public function findAllArtistByName(string $name, int $paginate = 5) : ?LengthAwarePaginator
    {
        return Artist::where('name', 'LIKE', "%{$name}%")->paginate($paginate);
    }

    public function createArtist(array $params) : Artist
    {
        return Artist::create($params);
    }

    public function updateArtist(int $id, array $params) : ?Artist
    {
        $artist = $this->findArtist($id);
        if ($artist)
        {
            $artist->update($params);
        }

        return $artist;
    }

    public function deleteArtist(int $id)
    {
        $artist = $this->findArtist($id);
        if ($artist)
        {
            $artist->delete();
        }
    }
}
