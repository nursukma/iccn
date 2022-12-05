@extends('layouts.default')

@section('page-style')
@endsection

@section('content')
    <main class="main" id="main">
        <div class="pagetitle">
            <h1>Data Koordinator Organisasi</h1>
        </div>

        <div class="row">
            <!-- Tables -->
            <div class="col-xl-12 col-lg-10">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                        <a href="{{ route('koordinator.create') }}"
                            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah
                        </a>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row mx-auto mt-1">
                            <div class="col-12">
                                <table class="table datatable" id="table-about">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $item->title }}
                                                </td>
                                                <td>
                                                    {!! $item->desc !!}
                                                </td>
                                                <td>
                                                    <a href="{{ route('koordinator.edit', $item->id) }}"
                                                        class="btn btn-light rounded-pill" title="Ubah" id='edit'
                                                        name='edit'>
                                                        <i class="ri-edit-2-line"></i></a>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                        id="hapus" name="hapus" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-bs-act="{{ route('koordinator.destroy', $item->id) }}"
                                                        data-bs-title="{{ $item->title }}">
                                                        <i class="ri-delete-bin-line"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Modal hapus --}}
                <div class="modal fade" id="deleteModal" tabindex="-1" data-bs-backdrop="static">
                    <div class="modal-dialog" role="dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Konfirmasi</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-3 needs-validation" id="delete-form" action="/" method="post"
                                novalidate>
                                @csrf
                                @method('delete')
                                <div class="modal-body">
                                    <p class="text-center">
                                        Yakin untuk menghapus data dengan judul <strong
                                            class="badge border-danger border-1 text-danger" id="title"> </strong>?
                                    </p>
                                    <div class="alert alert-danger text-center" role="alert">
                                        <i class="bi bi-exclamation-octagon me-1"></i>
                                        <span class=""> Perhatian! data akan terhapus dari sistem.</span>
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
        </div>
    </main>
@endsection

@section('page-script')
    <script type="text/javascript">
        // delete modal
        $('#deleteModal').bind('show.bs.modal', event => {
            const delButton = $(event.relatedTarget);
            const delForm = $('form#delete-form');
            delForm.attr('action', delButton.attr('data-bs-act'));
            delForm.find('#title').text('"' + delButton.attr('data-bs-title') + '"')
        })
    </script>
@endsection
