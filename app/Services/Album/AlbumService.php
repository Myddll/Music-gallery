<?php

namespace App\Services\Album;

use App\Exceptions\AlbumException;
use App\Helpers\Images\ImagesHelper;
use App\Helpers\Trim\TrimHelper;
use App\Logger\AlbumLogger;
use App\Repository\Album\AlbumRepository;
use App\Repository\Album\AlbumRepositoryInterface;
use App\Repository\Artist\ArtistRepository;
use App\Repository\Artist\AtistRepositoryInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AlbumService
{
    private TrimHelper $trimHelper;
    private ImagesHelper $imagesHelper;
    private AlbumRepository $albumRepository;
    private ArtistRepository $artistRepository;
    private AlbumLogger $logger;

    public function __construct(
        AlbumRepositoryInterface $albumRepository,
        AtistRepositoryInterface $artistRepository,
        TrimHelper               $trimHelper,
        ImagesHelper             $imagesHelper,
        AlbumLogger              $logger)
    {
        $this->artistRepository = $artistRepository;
        $this->albumRepository = $albumRepository;
        $this->trimHelper = $trimHelper;
        $this->imagesHelper = $imagesHelper;
        $this->logger = $logger;
    }

    public function createAlbum(array $data) : ?AlbumException
    {
        $data['description'] = $this->trimHelper->trimLink($data['description']);

        $album = $this->albumRepository->getAlbumWithParams(['name' => $data['name']]);

        if ($album && $album->artist->name === $data['artist_name']) {
            return throw new AlbumException('Такой артист с альбомом уже существуют!');
        }

        $artist = $this->artistRepository->findOrCreateArtist($data['artist_name'], $data['user_id']);
        $data['artist_id'] = $artist->id;

        try {
            $photo = $this->imagesHelper->saveImage($data['cover'], 'albums');
        } catch (FileException) {
            return throw new AlbumException('Ошибка при сохранении изображения');
        }

        $data['cover'] = $photo;

        $this->albumRepository->createAlbum($data);

        return null;
    }

    public function updateAlbum(array $data, int $id) : ?AlbumException
    {
        $old = $this->albumRepository->getAlbum($id);

        $data = $this->trimHelper->trimEmptyArrayKey($data);

        if (isset($data['description'])) {
            $data['description'] = $this->trimHelper->trimLink($data['description']);
        }

        $artist = $this->artistRepository->findOrCreateArtist($data['artist_name'], $data['user_id']);

        if (isset($data['cover'])) {
            $this->imagesHelper->deleteImage($old['cover'], 'albums');

            try {
                $file = $this->imagesHelper->saveImage($data['cover'], 'albums');
            } catch (FileException) {
                return throw new AlbumException('Ошибка при сохранении изображения');
            }

            $data['cover'] = $file;
        }
        $data['artist_id'] = $artist->id;
        $new = $this->albumRepository->updateAlbum($id, $data);

        $this->logger->loggingUpdate($old, $new);

        return null;
    }
}
