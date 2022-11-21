@extends('layouts.default')

@section('page-style')
@endsection

@section('content')
    <div class="row">
        <!-- Tables -->
        <div class="col-xl-12 col-lg-10">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Prinsip Kota</h6>
                    <a href="{{ route('prinsip-kota.create') }}"
                        class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        Tambah
                    </a>
                    {{-- <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                        data-bs-toggle="modal" data-bs-target="#addModal">
                        <i class="fas fa-plus fa-sm text-white-50"></i>
                        Tambah
                    </button> --}}
                </div>

                <!-- Card Body -->
                <div class="card-body">
                    <div class="row mx-auto mt-1">
                        <div class="col-12">
                            <table class="table" id="table-prinsip">
                                <thead>
                                    <tr>
                                        <td>No</td>
                                        <td>Judul</td>
                                        <td>Deskripsi</td>
                                        <td>Gambar</td>
                                        <td>Aksi</td>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Moda Tambahl -->
            <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                aria-labelledby="addModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Static Backdrop Modal</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="row g-3 needs-validation" action="#" method="post" novalidate>
                            @csrf
                            <div class="modal-body">...</div>
                        </form>
                        <div class="modal-footer"><button class="btn btn-secondary" type="button"
                                data-bs-dismiss="modal">Close</button><button class="btn btn-primary"
                                type="button">Understood</button></div>
                    </div>
                </div>
            </div>

            {{-- Modal hapus --}}
            <div class="modal fade" id="deleteModal" tabindex="-1">
                <div class="modal-dialog modal-md modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Konfirmasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form class="row g-3 needs-validation" id="delete-form" action="/" method="post" novalidate>
                            @csrf
                            @method('delete')
                            <div class="modal-body">
                                <p class="text-center">
                                    Yakin untuk menghapus data dengan judul <strong
                                        class="badge border-danger border-1 text-danger" id="title"> </strong>?
                                </p>
                                <div class="alert alert-danger text-center" role="alert">
                                    <i class="bi bi-exclamation-octagon me-1"></i>
                                    <span class=""> Perhatian! Menghapus visitor juga berarti menghapus akun
                                        visitor.</span>
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
@endsection

@section('page-script')
    <script>
        $(function() {
            var path = 'storage/';
            $('#table-prinsip').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/getPrinsip',
                columns: [{
                        data: 'no'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'desc'
                    },
                    {
                        data: 'image',
                        render: function(data) {
                            return `<img src="` + path + data + `" width='40px'; height:30px>`;
                        }
                    },
                    {
                        data: {
                            id: 'id',
                            title: 'title',
                            orderable: false,
                            searchable: false
                        },
                        render: function(data) {
                            return `
                            <d-flex flex-row align-items-center justify-content-between"> 
                                <a title="Perbarui" class="d-none d-sm-inline-block btn btn-sm btn-circle shadow-sm"
                                    href="/prinsip-kota/` + data.id + `/edit"> 
                                    <i class="fas fa-solid fa-pen-nib"></i> 
                                </a> 
                                <a title="Hapus" class="d-none d-sm-inline-block btn btn-sm btn-circle shadow-sm"
                                id="hapus" name="hapus" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-bs-act="/prinsip-kota/` + data.id + `"
                                                data-bs-nama="` + data.title + `"> 
                                    <i class="fas fa-solid fa-eraser"></i> 
                                </a> 
                            </div>
                            `;
                        }
                    },
                ]
            });
        });
    </script>

    <script type="text/javascript">
        // delete modal
        $('#deleteModal').bind('show.bs.modal', event => {
            const delButton = $(event.relatedTarget);
            const delForm = $('form#delete-form');
            delForm.attr('action', delButton.attr('data-bs-act'));
            delForm.find('#title').text('"' + delButton.attr('data-bs-nama') + '"')
        })
    </script>
@endsection
