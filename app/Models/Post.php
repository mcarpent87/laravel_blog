<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;

class Post {
    public static function all()
    {
        return File::files(resource_path("posts/"));
    }
    public static function find($slug)
    {
    if (! file_exists($path = resource_path("posts/{$slug}.html"))) {
        throw new ModelNotFoundException();
    }
    return cache()->remember("posts.{$slug}", 3600, function() use ($path) {
        return file_get_contents($path);
    });

    }
}