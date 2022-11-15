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
                    <h6 class="m-0 font-weight-bold text-primary">Form About</h6>
                </div>
                <!-- Card Body -->
                <form class="row g-3 needs-validation" action="#" method="post" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 ">
                                <div class="col-md-6 mb-2">
                                    <label for="floatingName">Judul</label>
                                    <input type="text" class="form-control" id="floatingName" placeholder="Judul">
                                </div>
                                <div class="col-md-6">
                                    <label for="floatingEmail">Deskripsi</label>
                                    <input type="email" class="form-control" id="floatingEmail" placeholder="Deskripsi">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="btn btn-primary mt-4">
                                        Upload Images
                                        <input type="file" name="up_images" class="upload__inputfile" id="up_images"
                                            onchange="previewImage()">
                                    </label>
                                    <img class="img-preview img-fluid col-sm-5" />
                                </div>
                                <div class="col-12">
                                    <div id="editor" class="form-control" style="height: 200px">
                                        <p>Hello World!</p>
                                        <p>This is Quill <strong>full</strong> editor</p>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success">Simpan</button>
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
                        ["link", "image", "video"],
                        ["clean"]
                    ]
                },
                theme: "snow"
            });
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
