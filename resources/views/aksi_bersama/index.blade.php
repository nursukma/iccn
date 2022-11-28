@extends('layouts.default')

@section('page-style')
    <style>
        .upload__box {
            padding: 20px;
        }

        .upload__inputfile {
            width: 0.1px;
            height: 0.1px;
            opacity: 0;
            overflow: hidden;
            position: absolute;
            z-index: -1;
        }

        .upload__btn {
            display: inline-block;
            /* font-weight: 600; */
            color: #fff;
            text-align: center;
            min-width: 116px;
            /* padding: 5px; */
            transition: all 0.3s ease;
            cursor: pointer;
            /* border: 2px solid; */
            background-color: #4045ba;
            border-color: #4045ba;
            border-radius: 10px;
            margin: 0 -18px;
            /* line-height: 26px; */
            /* font-size: 14px; */
        }

        .upload__btn:hover {
            background-color: unset;
            color: #4045ba;
            transition: all 0.3s ease;
        }

        .upload__btn-box {
            margin-bottom: 15px;
        }

        .upload__img-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -45px;
        }

        .upload__img-box {
            width: 200px;
            padding: 0 10px;
            margin-bottom: 12px;
        }
    </style>
@endsection

@section('content')
    <main class="main" id="main">
        <div class="pagetitle">
            <h1>Data Aksi Bersama</h1>
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
                                <table class="table datatable" id="table-aksi">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Gambar</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    <a class="text-info fw-bold detaildata" href="javascript:void(0)"
                                                        data-id="{{ $item->id }}">
                                                        {{ $item->title }}
                                                    </a>
                                                </td>
                                                <td>
                                                    {{ $item->desc }}
                                                </td>
                                                <td>
                                                    <img src="{{ 'storage/' . $item->image }}" class="img-thumbnail"
                                                        width="60px" height="40px">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-light rounded-pill"
                                                        title="Tambah Item" id='itemAdd' name='itemAdd'
                                                        data-bs-toggle="modal" data-bs-target="#itemModal"
                                                        data-bs-act="{{ route('aksi-bersama.item', $item->id) }}">
                                                        <i class="ri-add-circle-line"></i></button>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Ubah"
                                                        id='edit' name='edit' data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-bs-act="{{ route('aksi-bersama.update', $item->id) }}"
                                                        data-bs-title="{{ $item->title }}"
                                                        data-bs-desc=" {{ $item->desc }}"
                                                        data-bs-image="{{ $item->image }}">
                                                        <i class="ri-edit-2-line"></i></button>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                        id="hapus" name="hapus" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-bs-act="{{ route('aksi-bersama.destroy', $item->id) }}"
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

                <!-- Modal Tambah Item -->
                <div class="modal fade" id="itemModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Form Aksi Bersama Item</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation" id="item-form" action="/" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label for="link" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="item_title" name="title" required>
                                    </div>
                                    <div class="col-12">
                                        <label for="link" class="form-label">Pranala Pendukung</label>
                                        <input type="text" class="form-control" id="item_link" name="link" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="btn btn-primary mt-2">
                                            Upload Images
                                            <input type="file" name="item_image" class="upload__inputfile"
                                                id="item_images" onchange="itemImage()" accept="image/*">
                                        </label>
                                        <img id="img-item" class="item-preview img-fluid col-sm-5"
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

                <!-- Modal Detail Item -->
                <div class="modal fade" id="itemDetailModal" style="z-index: 1400;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Data Aksi Bersama Item</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="body-detail">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Moda Tambah -->
                <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Form Aksi Bersama</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation" action="{{ route('aksi-bersama.store') }}"
                                method="post" enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label for="link" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="aksi_title" name="aksi_title"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="link" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" id="aksi_desc" name="aksi_desc"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="btn btn-primary mt-2">
                                            Upload Images
                                            <input type="file" name="aksi_image" class="upload__inputfile"
                                                id="up_images" onchange="previewImage()" accept="image/*">
                                        </label>
                                        <img id="img-preview" class="img-preview img-fluid col-sm-5"
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

                {{-- Modal edit --}}
                <div class="modal fade" id="editModal" tabindex="-1" data-bs-backdrop="static">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Data Aksi Bersama</h5>
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
                                        <input type="text" class="form-control" id="title" name="title"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="link" class="form-label">Deskripsi</label>
                                        <input type="text" class="form-control" id="desc" name="desc"
                                            required>
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
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                {{-- Modal edit item --}}
                <div class="modal fade" id="editItemModal" data-backdrop="static" style="z-index: 1600;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Ubah Data Item Aksi Bersama</h5>
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
                                        <input type="text" class="form-control" id="title" name="title"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="link" class="form-label">Pranala</label>
                                        <input type="text" class="form-control" id="link" name="link"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="btn btn-primary mt-2">
                                            Upload Images
                                            <input type="file" name="edit_item_image" class="upload__inputfile"
                                                id="edit_item_images" onchange="editItemImage()" accept="image/*">
                                        </label>
                                        <img id="img-edit-item" class="edit-item-preview img-fluid col-sm-5"
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
            </div>
        </div>
    </main>
@endsection

@section('page-script')
    {{-- <script>
        $(function() {
            var path = 'storage/';
            $('#table-aksi').DataTable({
                processing: true,
                serverSide: true,
                ajax: '/getAksiBersama',
                columns: [{
                        data: 'no'
                    },
                    {
                        data: {
                            id: 'id',
                            title: 'title'
                        },
                        render: function(data, type, row) {
                            return `<a class="text-info fw-bold detaildata" href="javascript:void(0)"
                                                        onclick='detailItem(${data.id})'>
                                                        ${data.title }
                                                    </a>`
                        }
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
                                <a title="Perbarui" class="btn btn-light rounded-pill" id='edit' name='edit' data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-bs-title="` + data.title + `"
                                                        data-bs-desc="` + data.desc + `"
                                                        data-bs-image="` + data.image + `"
                                                        data-bs-act="/aksi-bersama/` + data.id + `/edit"> 
                                                        <i class="ri-edit-2-line"></i>
                                </a> 
                                <a title="Hapus" class="btn btn-light rounded-pill" title="Hapus"
                                                        id="hapus" name="hapus" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-bs-act="/aksi-bersama/` + data.id + `"
                                                        data-bs-title="` + data.title + `"> 
                                                        <i class="ri-delete-bin-line"></i>
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

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                }
            } else {
                alert("Only jpg/jpeg and png files are allowed!");
            }
        }

        function editImage() {
            const image = document.querySelector('#edit_images');
            const imgPreview = document.querySelector('.edit-preview');

            var fileName = document.getElementById("edit_images").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                }
            } else {
                alert("Only jpg/jpeg and png files are allowed!");
            }
        }

        function itemImage() {
            const image = document.querySelector('#item_images');
            const imgPreview = document.querySelector('.item-preview');

            var fileName = document.getElementById("item_images").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                }
            } else {
                alert("Only jpg/jpeg and png files are allowed!");
            }
        }

        function editItemImage() {
            const image = document.querySelector('#edit_item_images');
            const imgPreview = document.querySelector('.edit-item-preview');

            var fileName = document.getElementById("edit_item_images").value;
            var idxDot = fileName.lastIndexOf(".") + 1;
            var extFile = fileName.substr(idxDot, fileName.length).toLowerCase();

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    imgPreview.src = event.target.result;
                }
            } else {
                alert("Only jpg/jpeg and png files are allowed!");
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
            updateForm.find('#desc').val(updateButton.attr('data-bs-desc'));
            updateForm.find('#img-edit').attr("src", path);
        }).bind('hide.bs.modal', e => {
            const updateForm = $('form#update-form');
            updateForm.attr('action', '/');
            updateForm[0].reset();
        });

        // edit item modal
        $('#editItemModal').bind('show.bs.modal', event => {
            const updateForm = $('form#update-form');
            const updateButton = $(event.relatedTarget);
            const path = 'storage/' + updateButton.attr('data-bs-image');

            updateForm.attr('action', updateButton.attr('data-bs-act'));
            updateForm.find('#title').val(updateButton.attr('data-bs-title'));
            updateForm.find('#link').val(updateButton.attr('data-bs-link'));
            updateForm.find('#img-edit-item').attr("src", path);
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

        // add item modal
        $('#itemModal').bind('show.bs.modal', event => {
            const updateForm = $('form#item-form');
            const updateButton = $(event.relatedTarget);

            updateForm.attr('action', updateButton.attr('data-bs-act'));
        }).bind('hide.bs.modal', e => {
            const updateForm = $('form#item-form');
            updateForm.attr('action', '/');
            updateForm[0].reset();
        });
    </script>

    <script>
        $(function() {
            $('a.detaildata').click(function() {
                var detailModal = bootstrap.Modal.getOrCreateInstance('#itemDetailModal');

                var id = $(this).data('id');
                var no = 1;

                var path = 'storage/';

                $.get('/getDetail/' + id, function(data) {
                    detailModal.show();
                    $('#body-detail').append(
                        '<table class="table datatable" id="table-item-detail">' +
                        '<thead>' +
                        '<tr>' +
                        '<td> No </td>' +
                        '<td>Judul</td>' +
                        '<td>Pranala</td>' +
                        '<td>Gambar</td>' +
                        '<td>Aksi</td>' +
                        '</tr>' +
                        '</thead>'
                    );
                    data.forEach(val => {
                        $('#body-detail').append(
                            '<table class="table datatable" id="table-item-detail">' +
                            '<tbody>' +
                            '<tr>' +
                            '<td>' + no++ + '</td>' +
                            '<td>' + val.title + '</td>' +
                            '<td>' + val.link + '</td>' +
                            '<td>' + '<img src="' + path + val.image +
                            '" class="img-thumbnail" width="60px" height = "40px">' +
                            '</td>' +
                            '<td>' +
                            '<button type="button" class="btn btn-light rounded-pill" title="Ubah" id="edit" name="edit" data-bs-toggle="modal" data-bs-target="#editItemModal" data-bs-act="' +
                            '/update-item/' + val.id + '" data-bs-title="' +
                            val.title + '"  data-bs-link="' + val.link +
                            '" data-bs-image="' + val.image + '">' +
                            '<i class="ri-edit-2-line"></i></button>' +
                            '<button type="button" class="btn btn-light rounded-pill" title="Hapus" id="hapus" name="hapus" data-bs-toggle="modal" data-bs-target="#deleteModal" data-bs-act="' +
                            '/delete-item/' + val.id +
                            '" data-bs-title="' +
                            val.title + '">' +
                            '<i class="ri-delete-bin-line"></i></button>' +
                            '</td>' +
                            '</tr>' +
                            '</tbody>' +
                            '</table>'
                        )
                    })
                });
            });

            $("#itemDetailModal").on("hidden.bs.modal", function() {
                $("#body-detail").html("");
            });
        });
    </script>
@endsection
