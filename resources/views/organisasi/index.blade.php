@extends('layouts.default')

@section('page-style')
@endsection

@section('content')
<main id="main">
    <div class="pagetitle">
        <h1>Data Organisasi</h1>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-10">
            {{-- Struktur Organisasi --}}
            <div class="card shadow mb-4">
                <div class="card-header">
                    <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white"></i>
                        Tambah
                    </a>
                </div>
                <div class="card-body">
                    <div class="row mx-auto">
                        <div class="col-12">
                            <table class="table" id="table-organisasi">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Jabatan</td>
                                        <td>Nama</td>
                                        <td>Foto</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($data as $item) --}}
                                    <tr>
                                        <th scope="row">

                                        </th>
                                        <td>
                                            {{-- {{ $item->$jabatan }} --}}
                                        </td>
                                        <td>
                                            {{-- {{ $item->$nama }} --}}
                                        </td>
                                        <td>
                                            {{-- <img src="{{ 'storage/' . $item->$image }}" alt="Foto"
                                                class="img-thumbnail"> --}}
                                        </td>
                                        <td>
                                            <a href="{{ route('organisasi.edit'), $item->id) }}"
                                                class="btn btn-light rounded-pill" title="Ubah" id='edit' name='edit'>
                                                <i class="ri-edit-2-line"></i></a>
                                            <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                id="hapus" name="hapus" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-bs-act="{{ route('organisasi.destroy', $item->id) }}"
                                                data-bs-title="{{ $item->title }}">
                                                <i class="ri-delete-bin-line"></i></button>
                                        </td>
                                    </tr>
                                    {{-- @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pengurus --}}
            <div class="col-xl-12 col-lg-10">
                <div class="card">

                </div>
            </div>

            {{-- Koordinator Daerah --}}
            <div class="col-xl-12 col-lg-10">

            </div>
        </div>

        {{-- Delete Modal --}}
        <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1">
            <div class="modal-dialog" role="dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="delete-form" action="" class="row g-3 needs-validation" method="POST" novalidate>
                        {{-- @csrf --}}
                        {{-- @method('delete') --}}
                        <div class="modal-body">
                            <p class="text-center">
                                Apakah anda yakin menghapus data?
                            </p>
                            <div class="alert alert-danger text-center" role="alert">
                                <i class="bi bi-exclamation-octagon me-1"></i>
                                <span>Perhatian! Data akan terhapus dari sistem.</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('page-script')
@endsection