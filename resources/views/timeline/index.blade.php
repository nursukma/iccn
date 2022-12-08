@extends('layouts.default')

@section('page-style')
    <style>
        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .img-bg {
            background-repeat: no-repeat;
            background-position: center;
            background-size: cover;
            position: relative;
            padding-bottom: 100%;
        }
    </style>
@endsection

@section('content')
    <main class="main" id="main">
        <div class="pagetitle">
            <h1>Data Linimasi</h1>
        </div>

        <div class="row">
            <!-- Tables -->
            <div class="col-xl-12 col-lg-10">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                        <button type="button" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"
                            data-bs-toggle="modal" data-bs-target="#addModal">
                            <i class="fas fa-plus fa-sm text-white-50"></i>
                            Tambah
                        </button>
                    </div>

                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="row mx-auto mt-1">
                            <div class="col-12">
                                <table class="table datatable" id="table-timeline">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Gambar</th>
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
                                                    <img src="{{ 'storage/' . $item->image }}" class="img-thumbnail"
                                                        width="60px" height="40px">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Ubah"
                                                        id='edit' name='edit' data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-bs-act="{{ route('timeline.update', $item->id) }}"
                                                        data-bs-title="{{ $item->title }}"
                                                        data-bs-image="{{ $item->image }}">
                                                        <i class="ri-edit-2-line"></i></button>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                        id="hapus" name="hapus" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-bs-act="{{ route('timeline.destroy', $item->id) }}"
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

                <!-- Moda Tambahl -->
                <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Form Linimasa</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation" action="{{ route('timeline.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="col-12 ">
                                        <div class="col-md-12">
                                            <label for="floatingName">Judul</label>
                                            <div class="input-group has-validation">
                                                <input type="text" class="form-control" name="title" required>
                                                <div class="invalid-feedback">Harap isi bidang ini!</div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <label class="btn btn-primary mt-2">
                                                Upload Images
                                                <input type="file" name="image" class="upload__inputfile"
                                                    id="up_images" onchange="previewImage()" accept="image/*">
                                            </label>
                                            <img class="img-preview
                                                    img-fluid col-sm-5"
                                                style="display:block; object-fit:cover; margin-top:10px" />
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Modal edit --}}
                <div class="modal fade" id="editModal" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Data Slider</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation" id="update-form" action="/" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label for="link" class="form-label">Judul</label>
                                        <div class="input-group has-validation">
                                            <input type="text" class="form-control" id="title" name="title"
                                                required>
                                            <div class="invalid-feedback">Harap isi bidang ini!</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="btn btn-primary mt-2">
                                            Upload Images
                                            <input type="file" name="image" class="upload__inputfile"
                                                id="edit_images" onchange="editImage()" accept="image/*">
                                        </label>
                                        <img id="img-edit" class="edit-preview img-fluid col-sm-5"
                                            style="display:block; object-fit:cover; margin-top:10px" />
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Modal hapus --}}
                <div class="modal fade" id="deleteModal" data-bs-backdrop="static" tabindex="-1">
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
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
    {{-- <script>
        $(function() {
            var path = 'storage/';
            $('#table-timeline').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/getTimeline',
                columns: [{
                        data: 'no'
                    },
                    {
                        data: 'title'
                    },
                    {
                        data: 'image',
                        render: function(data) {
                            return `<img src="` + path + data +
                                `" width='240px';height='180px'>`;
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
                                    href="/timeline/` + data.id + `/edit"> 
                                    <i class="fas fa-solid fa-pen-nib"></i> 
                                </a> 
                                <a title="Hapus" class="d-none d-sm-inline-block btn btn-sm btn-circle shadow-sm"
                                id="hapus" name="hapus" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal"
                                                data-bs-act="/timeline/` + data.id + `"
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
    </script> --}}

    <script>
        function previewImage() {
            const image = document.querySelector('#up_images');
            const imgPreview = document.querySelector('.img-preview');

            var fileName = document.getElementById("up_images").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

            const fileSize = image.files[0].size / 1024 / 1024; // in MiB

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            };

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    if (fileSize < 2) {
                        imgPreview.src = event.target.result;
                    } else {
                        toastr.error("Ukuran gambar terlalu besar!");
                    }
                }
            } else {
                imgPreview.style.display = 'none';
                toastr.warning("Hanya boleh mengunggah berkas gambar!");
            }
        }

        function editImage() {
            const image = document.querySelector('#edit_images');
            const imgPreview = document.querySelector('.edit-preview');

            var fileName = document.getElementById("edit_images").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

            const fileSize = image.files[0].size / 1024 / 1024; // in MiB

            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-top-right"
            };

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    if (fileSize < 2) {
                        imgPreview.src = event.target.result;
                    } else {
                        toastr.error("Ukuran gambar terlalu besar!");
                    }
                }
            } else {
                imgPreview.style.display = 'none';
                toastr.warning("Hanya boleh mengunggah berkas gambar!");
            }
        }
    </script>

    <script type="text/javascript">
        // edit modal
        $('#editModal').bind('show.bs.modal', event => {
            const updateForm = $('form#update-form');
            const updateButton = $(event.relatedTarget);
            const path = 'storage/' + updateButton.attr('data-bs-image');

            updateForm.attr('action', updateButton.attr('data-bs-act'));
            updateForm.find('#title').val(updateButton.attr('data-bs-title'));
            updateForm.find('#img-edit').attr("src", path);
        }).bind('hide.bs.modal', e => {
            const updateForm = $('form#update-form');
            updateForm.attr('action', '/');
            updateForm[0].reset();
        });

        // delete modal
        $('#deleteModal').bind('show.bs.modal', event => {
            const delButton = $(event.relatedTarget);
            const delForm = $('form#delete-form');
            delForm.attr('action', delButton.attr('data-bs-act'));
            delForm.find('#title').text('"' + delButton.attr('data-bs-title') + '"')
        })
    </script>
@endsection
