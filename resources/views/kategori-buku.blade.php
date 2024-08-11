@extends('layout.home', ['title' => $pageTitle])

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">Daftar kategori</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama kategori</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategoris as $kat)
                            <tr>
                                <td>{{ $kat->kategoriId }}</td>
                                <td>{{ $kat->kategoriNama }}</td>
                                <td>
                                    <a href="{{ route('kategori-buku.edit', $kat->kategoriId) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('kategori-buku.destroy', $kat->kategoriId) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Form Tambah/Edit kategori -->
    <div class="col-lg-6 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                {{ isset($kategori) ? 'Edit Kategori' : 'Tambah Kategori' }}
                <a href="{{ route('kategori-buku.index') }}"><i class="fas fa-refresh"></a></i>
            </div>
            <div class="card-body">
                <form action="{{ isset($kategori) ? route('kategori-buku.update', $kategori->kategoriId) : route('kategori-buku.store') }}" method="POST">
                    @csrf
                    @if(isset($kategori))
                        @method('PUT')
                    @endif
                    <div class="form-group mb-5">
                        <label for="kategoriNama">Nama Kategori Buku</label>
                        <input type="text" name="kategoriNama" class="form-control" value="{{ isset($kategori) ? $kategori->kategoriNama : old('kategoriNama') }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        {{ isset($kategori) ? 'Update Kategori' : 'Simpan Kategori' }}
                    </button>
                </form>
                
            </div>
        </div>
    </div>

@endsection
