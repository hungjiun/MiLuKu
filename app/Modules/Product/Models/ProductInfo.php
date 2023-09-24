<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductInfo extends Model
{
    use HasFactory;

    protected $table = 'product_infos';
    protected $primaryKey = 'id';
    protected $fillable = [
        'num',
        'name',
        'summary',
        'detail'
    ];
}
