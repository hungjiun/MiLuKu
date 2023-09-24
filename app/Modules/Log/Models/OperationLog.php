<?php

namespace App\Modules\Log\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OperationLog extends Model implements Transformable
{
    use HasFactory, TransformableTrait;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'path',
        'method',
        'ip',
        'user_id',
        'created_at',
    ];

    public function operationLogInput()
    {
        return $this->hasOne(OperationLogInput::class);
    }
}
