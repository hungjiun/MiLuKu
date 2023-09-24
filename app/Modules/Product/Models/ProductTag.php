<?php

namespace App\Modules\Product\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;

    protected $table = 'product_tags';
    protected $primaryKey = 'id';
    protected $fillable = [
        'type',
        'title',
        'code',
        'status'
    ];
}
