<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\KategoriBuku;

class KategoriBukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            ['kategoriNama' => 'Fiksi'],
            ['kategoriNama' => 'Non-Fiksi'],
            ['kategoriNama' => 'Komik'],
            ['kategoriNama' => 'Biografi'],
            ['kategoriNama' => 'Sains'],
        ];

        // Menyisipkan data ke dalam tabel kategori_buku
        KategoriBuku::insert($kategori);
    }
}
