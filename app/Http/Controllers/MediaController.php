<?php

namespace App\Http\Controllers;

use App\Models\Media;

class MediaController extends CrudController
{
    protected function model(): string { return Media::class; }
    protected function searchableFields(): array { return ['filename', 'alt_text']; }
}
