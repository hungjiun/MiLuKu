<?php

namespace App\Modules\Product\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Modules\Product\Models\Categories;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

trait HasCategory
{
    /** @var string */
    private $categoryClass;

    public function getCategoryClass()
    {
        if (! isset($this->categoryClass)) {
            $this->categoryClass = app(Categories::class);
        }

        return $this->categoryClass;
    }

    public function categories(): BelongsToMany
    {
        return $this->morphToMany(
            Categories::class,
            'model',
            'model_has_categoris',
            'model_id',
            'categoty_id'
        );
    }

    public function assignCategories($categories)
    {
        $this->categories()->attach($categories);
        $this->load('categories');

        return $this;
    }

    public function removeCategories($categories)
    {
        $this->categories()->detach($categories);
        $this->load('categories');

        return $this;
    }

    public function syncCategories($categories)
    {
        $this->categories()->sync($categories);
        $this->load('categories');

        return $this;
    }
}
