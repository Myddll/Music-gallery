<?php

namespace App\Http\Controllers\Album;

use App\Exceptions\AlbumException;
use App\Http\Controllers\Controller;
use App\Http\Requests\AlbumRequest;
use App\Repository\Album\AlbumRepositoryInterface;
use App\Helpers\Images\ImagesHelper;
use App\Repository\Artist\AtistRepositoryInterface;
use App\Services\Album\AlbumService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlbumController extends Controller
{
    private AlbumRepositoryInterface $albumRepository;
    private AtistRepositoryInterface $artistRepository;
    private ImagesHelper $imagesHelper;
    private AlbumService $service;

    public function __construct(
        AtistRepositoryInterface $artistRepository,
        AlbumRepositoryInterface $albumRepository,
        ImagesHelper             $imagesHelper,
        AlbumService             $service
    )
    {
        $this->artistRepository = $artistRepository;
        $this->albumRepository = $albumRepository;
        $this->imagesHelper = $imagesHelper;
        $this->service = $service;
    }

    public function create() : View
    {
        $artists = $this->artistRepository->getAllArtist();

        return view('album.create', [
            'artists' => $artists
        ]);
    }

    public function store(AlbumRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        try {
            $this->service->createAlbum($data);
        } catch (AlbumException $e) {
            return redirect(route("album.create"))->withErrors(["status" => $e->getMessage()]);
        }

        return redirect(route('home'));
    }

    public function edit(Request $request, int $id) : View
    {
        $album = $this->albumRepository->getAlbum($id);
        if ($request->user()->cannot('update', $album)) {
            abort(403);
        }
        $artists = $this->artistRepository->getAllArtist();

        return view('album.edit', [
            'album' => $album,
            'artists' => $artists
        ]);
    }

    public function update(AlbumRequest $request, int $id) : RedirectResponse
    {
        $old = $this->albumRepository->getAlbum($id);
        if ($request->user()->cannot('update', $old)) {
            abort(403);
        }

        $data = $request->validated();

        try {
            $this->service->updateAlbum($data, $id);
        } catch (AlbumException $e) {
            back()->withErrors(['status' => $e->getMessage()]);
        }

        return redirect(route('home'));
    }

    public function destroy(Request $request, int $id) : RedirectResponse
    {
        $album = $this->albumRepository->getAlbum($id);
        if ($request->user()->cannot('forceDelete', $album)) {
            abort(403);
        }

        $this->imagesHelper->deleteImage($album->cover, 'albums');
        $this->albumRepository->deleteAlbum($id);
        return redirect(route('home'));
    }
}
