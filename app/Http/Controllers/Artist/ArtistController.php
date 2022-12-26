<?php

namespace App\Http\Controllers\Artist;

use App\Exceptions\ArtistException;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArtistRequest;
use App\Helpers\Images\ImagesHelper;
use App\Repository\Artist\AtistRepositoryInterface;
use App\Services\Artist\ArtistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArtistController extends Controller
{
    private AtistRepositoryInterface $repository;
    private ArtistService $service;
    private ImagesHelper $imagesHelper;

    public function __construct(
        AtistRepositoryInterface $repository,
        ArtistService            $service,
        ImagesHelper             $imagesHelper
    )
    {
        $this->repository = $repository;
        $this->service = $service;
        $this->imagesHelper = $imagesHelper;
    }

    public function create() : View
    {
        return view('artist.create');
    }

    public function store(ArtistRequest $request) : RedirectResponse
    {
        $data = $request->validated();

        try {
            $this->service->createArtist($data);
        } catch (ArtistException $e) {
            return back()->withErrors(['status' => $e->getMessage()]);
        }

        return redirect(route('all-artists'));
    }

    public function edit(Request $request, int $id) : View
    {
        $artist = $this->repository->findArtist($id);
        if ($request->user()->cannot('update', $artist)) {
            abort(403);
        }
        return view('artist.edit', [
            'artist' => $artist,
        ]);
    }

    public function update(ArtistRequest $request, int $id) : RedirectResponse
    {
        $data = $request->validated();
        $old = $this->repository->findArtist($id);
        if ($request->user()->cannot('update', $old)) {
            abort(403);
        }

        try {
            $this->service->updateArtist($data, $id);
        } catch (ArtistException $e) {
            return back()->withErrors(['status' => $e->getMessage()]);
        }

        return redirect(route('all-artists'));
    }

    public function destroy(Request $request, int $id) : RedirectResponse
    {
        $artist = $this->repository->findArtist($id);
        if ($request->user()->cannot('update', $artist)) {
            abort(403);
        }

        $this->imagesHelper->deleteImage($artist->photo, 'artist');
        $this->repository->deleteArtist($id);

        return redirect(route('all-artists'));
    }
}
