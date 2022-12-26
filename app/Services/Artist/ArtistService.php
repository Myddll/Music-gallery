<?php

namespace App\Services\Artist;

use App\Exceptions\ArtistException;
use App\Helpers\Images\ImagesHelper;
use App\Helpers\Trim\TrimHelper;
use App\Repository\Artist\ArtistRepository;
use App\Repository\Artist\AtistRepositoryInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ArtistService
{
    private ArtistRepository $repository;
    private ImagesHelper $imagesHelper;
    private TrimHelper $trimHelper;

    public function __construct(
        AtistRepositoryInterface $repository,
        ImagesHelper             $imagesHelper,
        TrimHelper               $helper)
    {
        $this->repository = $repository;
        $this->imagesHelper = $imagesHelper;
        $this->trimHelper = $helper;
    }

    public function createArtist(array $data) : ?ArtistException
    {
        $artist = $this->repository->findArtistByName($data['name']);

        if ($artist)
        {
            return throw new ArtistException('Данный артист уже существует!');
        }

        try {
            $photo = $this->imagesHelper->saveImage($data['photo'], 'artist');
        } catch (FileException) {
            return throw new ArtistException('Ошибка при сохранении изображения');
        }

        $data['photo'] = $photo;
        $this->repository->createArtist($data);

        return null;
    }

    public function updateArtist(array $data, int $id) : ?ArtistException
    {
        $old = $this->repository->findArtist($id);

        $data = $this->trimHelper->trimEmptyArrayKey($data);
        if (isset($data['photo']))
        {
            $this->imagesHelper->deleteImage($old->photo, 'artist');
            try {
                $photo = $this->imagesHelper->saveImage($data['photo'], 'artist');
            } catch (FileException) {
                return throw new ArtistException('Ошибка при сохранении изображения');
            }

            $data['photo'] = $photo;
        }
        $this->repository->updateArtist($id, $data);

        return null;
    }
}
