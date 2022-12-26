<?php

namespace App\Helpers\Images;

use App\Helpers\Trim\TrimHelper;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class ImagesHelper
{
    private TrimHelper $helper;

    public function __construct()
    {
        $this->helper = app(TrimHelper::class);
    }

    public function saveImage(?string $urlImage, string $folder) : string|null|FileException
    {
        if (!$urlImage) {
            return null;
        }

        $file = file_get_contents($urlImage);
        if (!$file)
        {
            return throw new FileException('Ошибка чтения файла');
        }

        $headers = get_headers($urlImage, 1);
        $headers = array_change_key_case($headers, CASE_LOWER);

        $fileExt = $headers['content-type'];
        $fileExt = $this->helper->trimHeader($fileExt);

        $fileName = uniqid('',true);

        $image = \Storage::put("public/{$folder}/{$fileName}.{$fileExt}", $file);

        if (!$image)
        {
            return throw new FileException('Ошибка сохранения файла');
        }

        return "{$fileName}.{$fileExt}";
    }

    public function deleteImage(?string $file, string $folder)
    {
        \Storage::delete("public/{$folder}/{$file}");
    }
}
