<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'dp_buku';

    protected $primaryKey = 'bukuId';
    protected $fillable = [
        'bukuNama',
        'bukuIdKategori',
        'bukuDeskripsi',
        'bukuJumlah',
        'bukuPdf',
        'bukuCover',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBuku::class, 'bukuIdKategori');
    }
}