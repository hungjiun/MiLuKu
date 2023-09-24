<?php

namespace App\Modules\File\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Modules\File\Models\SysFiles;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasImage
{
    /** @var string */
    private $imageClass;

    public function getImageClass()
    {
        if (! isset($this->imageClass)) {
            $this->imageClass = app(SysFiles::class);
        }

        return $this->imageClass;
    }

    public function images(): BelongsToMany
    {
        return $this->morphToMany(
            \App\Models\SysFiles::class,
            'model',
            'model_has_images',
            'model_id',
            'image_id'
        );
    }

    public function assignImages($images)
    {
        $this->images()->attach($images);
        $this->load('images');

        return $this;
    }

    public function removeImages($images)
    {
        $this->images()->detach($images);
        $this->load('images');

        return $this;
    }

    public function syncImages($images)
    {
        $this->images()->sync($images);
        $this->load('images');

        return $this;
    }
}
