<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Repository\Album\AlbumRepositoryInterface;
use App\Repository\Artist\AtistRepositoryInterface;
use Illuminate\View\View;

class MainController extends Controller
{
    private AlbumRepositoryInterface $albumRepository;
    private AtistRepositoryInterface $artistRepository;

    public function __construct(
        AtistRepositoryInterface $artistRepository,
        AlbumRepositoryInterface $albumRepository
    )
    {
        $this->artistRepository = $artistRepository;
        $this->albumRepository = $albumRepository;
    }

    public function homePage() : View
    {
        $albums = $this->albumRepository->getAllAlbums();

        return view('welcome', [
            'albums' => $albums,
        ]);
    }

    public function searchAlbumsByArtist(int $id) : View
    {
        $albums = $this->albumRepository->getAlbumsByArtist($id);

        return view('welcome', [
            'albums' => $albums,
        ]);
    }

    public function artistsPage() : View
    {
        $artists = $this->artistRepository->getAllArtistWithPaginate();
        return view( 'artists', [
            'artists' => $artists
        ]);
    }

    public function findArtists(SearchRequest $request) : View
    {
        $data = $request->validated();
        $artists = $this->artistRepository->findAllArtistByName($data['artist']);
        return view( 'artists', [
            'artists' => $artists
        ]);
    }
}
