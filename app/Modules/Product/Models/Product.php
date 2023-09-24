<?php

namespace App\Modules\Product\Models;

use App\Modules\File\Traits\HasImage;
use App\Modules\Product\Traits\HasCategory;
use App\Modules\Product\Traits\HasTag;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasImage, HasCategory, HasTag, HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'id';
    protected $fillable = [
        'product_code',
        'display_order',
        'open',
        'status'
    ];
}
