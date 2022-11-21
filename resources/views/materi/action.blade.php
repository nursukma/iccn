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
    <div class="row">
        <!--  -->
        <div class="col-xl-12 col-lg-10 mx-auto">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Materi</h6>
                </div>
                <!-- Card Body -->
                <form class="form-add row g-3 needs-validation"
                    action="{{ $action == 'add' ? route('materi.store') : route('materi.update', $materi->id) }}"
                    method="post" novalidate enctype="multipart/form-data">
                    @csrf
                    @if ($action == 'edit')
                        @method('put')
                    @endif
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 ">
                                <div class="col-md-6">
                                    <label for="floatingName">Judul</label>
                                    <input type="text" class="form-control" id="floatingName" placeholder="Judul"
                                        name="title" value="{{ $action == 'edit' ? $materi->title : '' }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="btn btn-primary mt-4">
                                        Upload Images
                                        <input type="file" name="image" class="upload__inputfile" id="up_images"
                                            onchange="previewImage()">
                                    </label>
                                    <img class="img-preview img-fluid col-sm-2"
                                        src="{{ $action == 'edit' ? asset('storage/' . $materi->image) : '' }}"
                                        style="display:block; object-fit:cover; margin: 0 -15px" />
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="btn btn-primary mt-4">
                                        Upload Berkas Materi
                                        <input type="file" name="materi" class="upload__inputfile" id="up_images"
                                            onchange="previewFile()">
                                    </label>
                                    @if ($action == 'edit')
                                        @if ($materi->file != '')
                                            <img class="file-preview img-fluid col-sm-2"
                                                src="{{ asset('build/assets/img/file-ada.svg') }}"
                                                style="display:block; object-fit:cover; margin: 0 -15px"
                                                title="Sudah ada materi" />
                                        @else
                                            <img class="file-preview img-fluid col-sm-2"
                                                src="{{ asset('build/assets/img/file-kosong.svg') }}"
                                                style="display:block; object-fit:cover; margin: 0 -15px"
                                                title="Belum ada materi" />
                                        @endif
                                    @else
                                        <img class="file-preview img-fluid col-sm-2"
                                            style="display:block; object-fit:cover; margin: 0 -15px" />
                                    @endif
                                </div>
                                <div class="col-12">
                                    <label for="floatingEmail">Deskripsi</label>

                                    <input type="hidden" name="desc"
                                        value="{{ $action == 'edit' ? $materi->desc : '' }}">
                                    <input type="hidden" name="action" value="{{ $action == 'edit' ? 'edit' : 'add' }}">

                                    <div id="editor" class="form-control" style="height: 200px">

                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="/materi" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        var quill =
            new Quill("#editor", {
                modules: {
                    toolbar: [
                        [{
                            font: []
                        }, {
                            size: []
                        }],
                        ["bold", "italic", "underline", "strike"],
                        [{
                                color: []
                            },
                            {
                                background: []
                            }
                        ],
                        [{
                                script: "super"
                            },
                            {
                                script: "sub"
                            }
                        ],
                        [{
                                list: "ordered"
                            },
                            {
                                list: "bullet"
                            },
                            {
                                indent: "-1"
                            },
                            {
                                indent: "+1"
                            }
                        ],
                        ["direction", {
                            align: []
                        }],
                        ["link"],
                        ["clean"]
                    ]
                },
                theme: "snow",
                scrollingContainer: '#scrolling-container',
            });

        var about = document.querySelector('input[name=desc]');
        var action = document.querySelector('input[name=action]');

        // var action = {!! json_encode($action) !!};
        if (action.value === 'edit') {
            quill.root.innerHTML = about.value
        }

        var form = document.querySelector('.form-add');
        form.onsubmit = function() {
            about.value = quill.root.innerHTML;
        }
    </script>

    <script>
        function previewImage() {
            const image = document.querySelector('#up_images');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            imgPreview.style.objectFit = 'cover';

            const reader = new FileReader();
            reader.readAsDataURL(image.files[0]);

            reader.onload = function(event) {
                imgPreview.src = event.target.result;
            }
        }

        function previewFile() {
            const image = document.querySelector('#up_images');
            const imgPreview = document.querySelector('.file-preview');

            imgPreview.style.display = 'block';
            imgPreview.style.objectFit = 'cover';

            imgPreview.src = '/build/assets/img/file-ada.svg';

        }
    </script>
@endsection
