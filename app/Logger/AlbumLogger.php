<?php

namespace App\Logger;

use App\Models\Album;
use Illuminate\Support\Facades\Log;

class AlbumLogger
{
    public function loggingUpdate(Album $old, Album $new)
    {
        Log::channel('album-update')->info('Album has update!', [
            'old' => $old,
            'new' => $new
        ]);
    }
}
