<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    use HasFactory;

    protected $table = 'beranda.sliders';
    protected $fillable = ['title', 'link', 'image'];

    protected $primaryKey = 'id';
    protected $keyType = 'string';

    // protected $casts = [
    //     'id' => 'string'
    // ];

    public $incrementing = false;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid();
            }
        });
    }
}