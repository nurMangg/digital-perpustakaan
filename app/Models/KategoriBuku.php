<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriBuku extends Model
{
    use HasFactory;

    protected $table = 'dp_kategoriBuku';
    protected $primaryKey = 'kategoriId';
    protected $fillable = ['kategoriNama'];
}
