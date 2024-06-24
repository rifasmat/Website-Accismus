<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class History extends Model
{
    use HasFactory;

    protected $primaryKey = 'history_id';
    protected $keyType = 'int';
    public $incrementing = true;

    protected $fillable = [
        'history_uuid',
        'history_rf',
        'history_foto',
        'history_tahun',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->history_uuid)) {
                $model->history_uuid = (string) Str::uuid();
            }
        });
    }
}
