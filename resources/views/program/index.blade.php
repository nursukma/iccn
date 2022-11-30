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
            <h1>Data Program</h1>
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
                                <table class="table datatable" id="table-program">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Judul</th>
                                            <th scope="col">Subjudul</th>
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
                                                    {{ $item->sub_title }}
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-light rounded-pill"
                                                        title="Tambah Item" id='itemAdd' name='itemAdd'
                                                        data-bs-toggle="modal" data-bs-target="#itemModal"
                                                        data-bs-act="{{ route('program.itemStore', $item->id) }}">
                                                        <i class="ri-add-circle-line"></i></button>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Ubah"
                                                        id='edit' name='edit' data-bs-toggle="modal"
                                                        data-bs-target="#editModal"
                                                        data-bs-act="{{ route('program.update', $item->id) }}"
                                                        data-bs-title="{{ $item->title }}"
                                                        data-bs-subtitle=" {{ $item->sub_title }}">
                                                        <i class="ri-edit-2-line"></i></button>
                                                    <button type="button" class="btn btn-light rounded-pill" title="Hapus"
                                                        id="hapus" name="hapus" data-bs-toggle="modal"
                                                        data-bs-target="#deleteModal"
                                                        data-bs-act="{{ route('program.destroy', $item->id) }}"
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
                                <h5 class="modal-title" id="staticBackdropLabel">Form Program Item</h5>
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
                                <h5 class="modal-title" id="staticBackdropLabel">Data Program Item</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body" id="body-detail">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Tambah -->
                <div class="modal fade" id="addModal" data-bs-backdrop="static" tabindex="-1" role="dialog"
                    aria-labelledby="addModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Form Program</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation" action="{{ route('program.store') }}" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label for="title" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="sub_title" class="form-label">Subjudul</label>
                                        <input type="text" class="form-control" id="sub_title" name="sub_title">
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
                                <h5 class="modal-title">Ubah Data Program</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form class="row g-2 needs-validation" id="update-form" action="/" method="post"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('put')
                                <div class="modal-body">
                                    <div class="col-12">
                                        <label for="edit_title" class="form-label">Judul</label>
                                        <input type="text" class="form-control" id="edit_title" name="edit_title"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="edit_sub_title" class="form-label">Subjudul</label>
                                        <input type="text" class="form-control" id="edit_sub_title"
                                            name="edit_sub_title">
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

                {{-- Modal item hapus --}}
                <div class="modal fade" id="deleteItemModal" tabindex="-1" data-bs-backdrop="static">
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
                                <h5 class="modal-title">Ubah Data Program Item</h5>
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
    <script>
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

            updateForm.attr('action', updateButton.attr('data-bs-act'));
            updateForm.find('#edit_title').val(updateButton.attr('data-bs-title'));
            updateForm.find('#edit_sub_title').val(updateButton.attr('data-bs-subtitle'));
        }).bind('hide.bs.modal', e => {
            const updateForm = $('form#update-form');
            updateForm.attr('action', '/');
            updateForm[0].reset();
        });

        // edit item modal
        $('#editItemModal').bind('show.bs.modal', event => {
            const updateForm = $('form#update-form');
            const updateButton = $(event.relatedTarget);

            var id = updateButton.attr('data-bs-id');
            $.get('/programItem/' + id, function(data) {
                const path = 'storage/' + data.image;

                updateForm.attr('action', updateButton.attr('data-bs-act'));
                updateForm.find('#title').val(data.title);
                updateForm.find('#link').val(data.link);
                updateForm.find('#img-edit-item').attr("src", path);
            })
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

        // delete item modal
        $('#deleteItemModal').bind('show.bs.modal', event => {
            const delButton = $(event.relatedTarget);
            const delForm = $('form#delete-form');

            var id = delButton.attr('data-bs-id')

            $.get('/programItem/' + id, function(data) {
                delForm.attr('action', delButton.attr('data-bs-act'));
                delForm.find('#title').text('"' + data.title + '"')
            })
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
            var editItemlModal = bootstrap.Modal.getOrCreateInstance('#editItemModal');

            var detailModal = bootstrap.Modal.getOrCreateInstance('#itemDetailModal');

            $('a.detaildata').click(function() {

                var id = $(this).data('id');
                var no = 1;

                var path = 'storage/';

                detailModal.show();
                $('#body-detail').append(
                    '<table class="table datatable" id="table-item-detail">');

                fetch("/programDetail/" + id).then(
                    response => response.json()
                ).then(data => {
                    let table = new simpleDatatables.DataTable("#table-item-detail", {
                        data: {
                            headings: ['No', 'ID', 'Judul', 'Pranala', 'Gambar', 'Aksi'],
                            data: data.map(item => Object.values(item)),
                        },
                        perPage: 5,
                        columns: [{
                            select: 1,
                            hidden: true
                        }, {
                            select: 4,
                            render: function(data) {
                                return `<img src="` + path + data +
                                    `" width='40px'; height:30px>`;
                            }
                        }, {
                            select: 5,
                            render: function(data) {
                                return `
                        <button class="btn btn-light rounded-pill" title="Ubah" type="button" data-bs-toggle="modal"
                                                        data-bs-target="#editItemModal" data-bs-id='${data}' data-bs-act='/programUpdate/${data}'>
                            <i class="ri-edit-2-line"></i>
                        </button>
                        <button class="btn btn-light rounded-pill" title="Hapus" type="button" data-bs-act='/programDelete/${data}' data-bs-toggle="modal"
                                                        data-bs-target="#deleteItemModal" data-bs-id='${data}'">
                            <i class="ri-delete-bin-line"></i>
                        </button>
                    `;
                            }
                        }]
                    })
                })
            });

            $("#itemDetailModal").on("hidden.bs.modal", function() {
                $("#body-detail").html("");
            });
        });
    </script>
@endsection
