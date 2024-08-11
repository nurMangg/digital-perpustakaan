@extends('layout.home', ['title' => $pageTitle])

@section('content')
<div class="row">
    <!-- Form Tambah/Edit Buku -->
    <div class="col-lg-12 mb-4">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                {{ isset($buku) ? 'Edit Buku' : 'Tambah Buku' }}
                <a href="{{ route('buku.index') }}"><i class="fas fa-refresh"></a></i>
            </div>
            <div class="card-body">
                <form action="{{ isset($buku) ? route('buku.update', $buku->bukuId) : route('buku.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(isset($buku))
                    @method('PUT')
                    @endif
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label for="bukuNama" class="form-label">Nama Buku</label>
                            <input type="text" name="bukuNama" class="form-control"
                                value="{{ isset($buku) ? $buku->bukuNama : old('bukuNama') }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="bukuIdKategori" class="form-label">Kategori Buku</label>
                            <select name="bukuIdKategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach($kategori as $kat)
                                <option value="{{ $kat->kategoriId }}"
                                    {{ isset($buku) && $buku->bukuIdKategori == $kat->kategoriId ? 'selected' : '' }}>
                                    {{ $kat->kategoriNama }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="bukuDeskripsi" class="form-label">Deskripsi Buku</label>
                            <input type="text" name="bukuDeskripsi" class="form-control"
                                value="{{ isset($buku) ? $buku->bukuDeskripsi : old('bukuDeskripsi') }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label for="bukuJumlah" class="form-label">Jumlah Buku</label>
                            <input type="number" name="bukuJumlah" class="form-control"
                                value="{{ isset($buku) ? $buku->bukuJumlah : old('bukuJumlah') }}" required>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="bukuPdf" class="form-label">File PDF Buku</label>
                            <input type="file" name="bukuPdf" class="form-control">

                        </div>
                        <div class="col-6 mb-3">
                            <label for="bukuCover" class="form-label">Cover Buku</label>
                            <input type="file" name="bukuCover" class="form-control">

                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit"
                            class="btn btn-primary">{{ isset($buku) ? 'Update Buku' : 'Simpan Buku' }}</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Daftar Buku -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">Daftar Buku</div>
                <div class="card-body">
                    <form action="{{ route('buku.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control"
                                placeholder="Cari buku berdasarkan nama..." value="{{ request()->query('search') }}">
                            <select name="kategori" class="form-control" style="margin-left: 10px;">
                                <option value="">Semua Kategori</option>
                                @foreach($kategori as $kat)
                                <option value="{{ $kat->kategoriId }}"
                                    {{ request()->query('kategori') == $kat->kategoriId ? 'selected' : '' }}>
                                    {{ $kat->kategoriNama }}
                                </option>
                                @endforeach
                            </select>
                            <button class="btn btn-primary" type="submit" style="margin-left: 10px;">Cari</button>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif
                    <div class="btn-group" role="group" aria-label="Export Buttons">
                        <a href="{{ route('buku.exportExcel') }}" class="btn btn-success">
                            <i class="fas fa-file-excel"></i> Export to Excel
                        </a>
                        <a href="{{ route('buku.exportpdf') }}" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i> Export to PDF
                        </a>
                    </div>
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama Buku</th>
                                <th>Kategori</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                                <th>File PDF</th>
                                <th>Cover</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bukus as $buku)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $buku->bukuNama }}</td>
                                <td>{{ $buku->kategori->kategoriNama ?? 'No Kategori' }}</td>
                                <td>{{ $buku->bukuDeskripsi }}</td>
                                <td>{{ $buku->bukuJumlah }}</td>
                                <td>
                                    @if($buku->bukuPdf)
                                    <a href="{{ asset('storage/' . $buku->bukuPdf) }}" target="_blank"
                                        title="Lihat PDF">
                                        <i class="fas fa-file-pdf" style="font-size: 24px; color: red;"></i>
                                    </a>
                                    @else
                                    No PDF
                                    @endif
                                </td>
                                <td>
                                    @if($buku->bukuCover)
                                    {{-- <a href="{{ $buku->bukuCover }}" target="_blank"> --}}
                                    <img src="{{ $buku->bukuCover }}" alt="Cover Buku"
                                        style="width: 100px; height: auto;">
                                    {{-- </a> --}}
                                    @else
                                    No Cover
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('buku.edit', $buku->bukuId) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('buku.destroy', $buku->bukuId) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="text-center">Belum ada data</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
