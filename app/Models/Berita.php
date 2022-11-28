<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    protected $table = '';
    protected $fillable = ['title', 'deskripsi', 'image', 'date', 'penulis'];

    protected $primaryKey = 'id';
    
}
