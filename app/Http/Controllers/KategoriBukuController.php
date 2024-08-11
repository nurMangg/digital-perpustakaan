<?php

namespace App\Http\Controllers;

use App\Models\KategoriBuku;
use Illuminate\Http\Request;

class KategoriBukuController extends Controller
{
    public $pageTitle = 'Kategori Buku';

    public function index()
    {
        $kategoris = KategoriBuku::all();
        return view('kategori-buku', 
            [
                'kategoris' => $kategoris,
                'pageTitle' => $this->pageTitle
            ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategoriNama' => 'required|string|max:255',
        ]);

        KategoriBuku::create([
            'kategoriNama' => $request->kategoriNama,
        ]);

        return redirect()->route('kategori-buku.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        $kategoris = KategoriBuku::all();
        return view('kategori-buku', 
            [   
                'kategoris' => $kategoris,
                'kategori' => $kategori,
                'pageTitle' => $this->pageTitle
            ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategoriNama' => 'required|string|max:255',
        ]);

        $kategori = KategoriBuku::findOrFail($id);
        $kategori->update([
            'kategoriNama' => $request->kategoriNama,
        ]);

        return redirect()->route('kategori-buku.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $kategori = KategoriBuku::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori-buku.index')->with('success', 'Kategori berhasil dihapus');
    }
}
