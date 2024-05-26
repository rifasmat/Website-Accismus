<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'informasi_judul',
        'informasi_subjudul',
        'informasi_rf',
        'informasi_instagram',
        'informasi_discord',
        'informasi_wa'
    ];
}
