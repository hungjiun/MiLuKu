<?php

namespace App\Modules\Product\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Modules\Product\Models\ProductTag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasTag
{
    /** @var string */
    private $tagClass;

    public function getTagClass()
    {
        if (! isset($this->tagClass)) {
            $this->tagClass = app(ProductTag::class);
        }

        return $this->tagClass;
    }

    public function tags(): BelongsToMany
    {
        return $this->morphToMany(
            ProductTag::class,
            'model',
            'model_has_tags',
            'model_id',
            'tag_id'
        );
    }

    public function assignTags($tags)
    {
        $this->tags()->attach($tags);
        $this->load('tags');

        return $this;
    }

    public function removeTags($tags)
    {
        $this->tags()->detach($tags);
        $this->load('tags');

        return $this;
    }

    public function syncTags($tags)
    {
        $this->tags()->sync($tags);
        $this->load('tags');

        return $this;
    }
}
