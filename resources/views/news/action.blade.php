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
            <h1>Form Berita dan Blog</h1>
        </div>

        <div class="row">
            <!--  -->
            <div class="col-xl-12 col-lg-10 mx-auto">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <form class="form-add row g-2 needs-validation"
                        action="{{ $action == 'add' ? route('news.store') : route('news.update', $news->id) }}" method="post"
                        novalidate enctype="multipart/form-data">
                        @csrf
                        @if ($action == 'edit')
                            @method('put')
                        @endif
                        <div class="card-body">
                            {{-- <div class="row g-3"> --}}
                            <div class="col-md-12">
                                <label for="title">Judul</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ $action == 'edit' ? $news->title : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="penulis">Penulis</label>
                                <input type="text" class="form-control" id="penulis" name="penulis"
                                    value="{{ $action == 'edit' ? $news->penulis : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label for="tanggal">Tanggal</label>
                                <input type="text" class="form-control" id="tanggal" name="tanggal"
                                    value="{{ $action == 'edit' ? $news->penulis : '' }}">
                            </div>
                            <label for="penulis">Thumbnail</label>
                            <div class="col-md-6 mt-2">
                                <label class="btn btn-primary mt-2">
                                    Upload Images
                                    <input type="file" name="image" class="upload__inputfile" id="up_images"
                                        onchange="previewImage()">
                                </label>
                                <img class="img-preview img-fluid col-sm-5 mt-2"
                                    src="{{ $action == 'edit' ? asset('storage/' . $news->image) : '' }}"
                                    style="display:block; object-fit:cover" />
                            </div>
                            <div class="col-12 mt-2">
                                <label for="floatingEmail">Deskripsi</label>

                                <input type="hidden" name="desc" value="{{ $action == 'edit' ? $news->desc : '' }}">
                                <input type="hidden" name="action" value="{{ $action == 'edit' ? 'edit' : 'add' }}">

                                <div id="editor" class="form-control" style="height: 200px">

                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="/news" class="btn btn-secondary">Kembali</a>
                            </div>
                            {{-- </div> --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
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

        var news = document.querySelector('input[name=desc]');
        var action = document.querySelector('input[name=action]');

        // var action = {!! json_encode($action) !!};
        if (action.value === 'edit') {
            quill.root.innerHTML = news.value
        }

        var form = document.querySelector('.form-add');
        form.onsubmit = function() {
            news.value = quill.root.innerHTML;
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
    </script>
@endsection
