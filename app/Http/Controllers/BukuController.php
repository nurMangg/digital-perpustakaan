<?php

namespace App\Http\Controllers;

use App\Exports\BukusExport;
use App\Models\Buku;
use App\Models\KategoriBuku;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BukuController extends Controller
{
    public $pageTitle = 'Buku';


    public function index(Request $request)
    {
        $search = $request->query('search');
        $kategoriId = $request->query('kategori');
    
        // Ambil semua kategori untuk dropdown
        $kategori = KategoriBuku::all();
    
        // Cek apakah pengguna adalah admin
        if (auth()->user()->isAdmin()) {
            // Jika admin, tampilkan semua buku dengan filter search dan kategori
            $bukus = Buku::when($search, function ($query, $search) {
                return $query->where('bukuNama', 'like', "%{$search}%");
            })->when($kategoriId, function ($query, $kategoriId) {
                return $query->where('bukuIdKategori', $kategoriId);
            })->get();
        } else {
            // Jika bukan admin, hanya tampilkan buku yang dibuat oleh pengguna itu sendiri
            $bukus = Buku::where('user_id', auth()->id())
                ->when($search, function ($query, $search) {
                    return $query->where('bukuNama', 'like', "%{$search}%");
                })->when($kategoriId, function ($query, $kategoriId) {
                    return $query->where('bukuIdKategori', $kategoriId);
                })->get();
        }
    
        return view('buku', [
            'bukus' => $bukus,
            'kategori' => $kategori,
            'pageTitle' => $this->pageTitle,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bukuNama' => 'required|string|max:255',
            'bukuIdKategori' => 'required|integer',
            'bukuDeskripsi' => 'nullable|string',
            'bukuJumlah' => 'required|integer',
            'bukuPdf' => 'nullable|file|mimes:pdf|max:20480',
            'bukuCover' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('bukuCover', 'bukuPdf');
        $data['user_id'] = auth()->id();

        if ($request->hasFile('bukuCover')) {
            $file = $request->file('bukuCover');
            $fileContents = file_get_contents($file);
            $data['bukuCover'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($fileContents);
        }

        if ($request->hasFile('bukuPdf')) {
            $file = $request->file('bukuPdf');
            $path = $file->store('pdfs', 'public');
            $data['bukuPdf'] = $path;
        }

        Buku::create($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku', compact('buku'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $bukus = Buku::where('user_id', auth()->id())->get();
        
        $kategori = KategoriBuku::all(); 
        return view('buku', [ 
            'buku' => $buku,
            'bukus' => $bukus,
            'kategori' => $kategori,
            'pageTitle' => 'Edit Buku', 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'bukuNama' => 'required|string|max:255',
            'bukuIdKategori' => 'required|integer',
            'bukuDeskripsi' => 'nullable|string',
            'bukuJumlah' => 'required|integer',
            'bukuPdf' => 'nullable|file|mimes:pdf|max:20480',
            'bukuCover' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->except('bukuCover', 'bukuPdf');

        if ($request->hasFile('bukuCover')) {
            $file = $request->file('bukuCover');
            $fileContents = file_get_contents($file);
            $data['bukuCover'] = 'data:' . $file->getMimeType() . ';base64,' . base64_encode($fileContents);
        }

        if ($request->hasFile('bukuPdf')) {
            $file = $request->file('bukuPdf');
            $path = $file->store('pdfs', 'public');
            $data['bukuPdf'] = $path;
        }

        $buku->update($data);

        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $buku = Buku::findOrFail($id);
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus');
    }

    public function exportExcel()
    {
        $user = auth()->user();
    
        if ($user->isAdmin()) {
            $bukus = Buku::all();
        } else {
            $bukus = Buku::where('user_id', $user->id)->get();
        }
    
        return Excel::download(new BukusExport($bukus), 'daftar_buku.xlsx');
    }
    
    public function exportPdf()
    {
        $user = auth()->user();
    
        if ($user->isAdmin()) {
            $bukus = Buku::with('kategori')->get();
        } else {
            $bukus = Buku::with('kategori')->where('user_id', $user->id)->get();
        }
    
        $pdf = PDF::loadView('buku_pdf', ['bukus' => $bukus]);
        return $pdf->download('daftar_buku.pdf');
    }
    
}
