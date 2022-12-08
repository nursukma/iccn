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
                            <div class="row g-3 mt-1">
                                <div class="col-md-12">
                                    <label for="title">Judul</label>
                                    <div class="input-group has-validation">
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ $action == 'edit' ? $news->title : '' }}" required>
                                        <div class="invalid-feedback">Harap isi bidang ini!</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="penulis">Penulis</label>
                                    <input type="text" class="form-control" id="penulis" name="penulis"
                                        value="{{ $action == 'edit' ? $news->penulis : '' }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="tanggal">Tanggal</label>
                                    <input type="text" class="form-control" id="tanggal" name="tanggal"
                                        value="{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}" readonly>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <div class="col-md-6">
                                        <label for="penulis" class="mb-0">Thumbnail</label>
                                    </div>
                                    <label class="btn btn-primary mt-2">
                                        Upload Images
                                        <input type="file" name="image" class="upload__inputfile" id="up_images"
                                            onchange="previewImage()" accept="image/*">
                                    </label>
                                    <img class="img-preview img-fluid col-sm-5 mt-2"
                                        src="{{ $action == 'edit' ? asset('storage/' . $news->thumbnail) : '' }}"
                                        style="display:block; object-fit:cover" />
                                </div>
                                <div class="col-12 mt-2">
                                    <label for="floatingEmail">Konten</label>

                                    <input type="hidden" name="desc" value="{{ $action == 'edit' ? $news->desc : '' }}">
                                    <input type="hidden" name="action" value="{{ $action == 'edit' ? 'edit' : 'add' }}">

                                    <div id="editor" class="form-control" style="height: 300px">

                                    </div>
                                    {{-- <div class="custom-file d-none">
                                        <input ref="image" type="file" name="quill_image[]" class="custom-file-input"
                                            id="imageUpload" aria-describedby="imageUploadAddon">
                                        <label class="custom-file-label" for="imageUpload">Choose file</label>
                                    </div> --}}
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="/news" class="btn btn-secondary">Kembali</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@section('page-script')
    <script>
        var toolbarOption = [
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
            ["clean"],
        ];
        var quill =
            new Quill("#editor", {
                modules: {
                    toolbar: {
                        container: toolbarOption,
                    }
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

            // saveImages();
        }

        // function selectLocalImage() {
        //     const image = document.querySelector('#imageUpload');
        //     image.click();

        //     const range = quill.getSelection();

        //     // Listen upload local image and save to server
        //     image.onchange = () => {
        //         const file = image.files[0];

        //         // file type is only image.
        //         if (/^image\//.test(file.type)) {
        //             upimage(file)
        //         } else {
        //             console.warn('You could only upload images.');
        //         }
        //     };
        // }

        // function upimage(file) {
        //     let reader = new FileReader();
        //     reader.readAsDataURL(file);
        //     let self = this;
        //     reader.onloadend = function() {
        //         let base64data = reader.result;

        //         //  Get cursor location
        //         let length = quill.getSelection().index;

        //         // Insert image at cursor location
        //         quill.insertEmbed(length, 'image', base64data);

        //         // Set cursor to the end
        //         quill.setSelection(length + 1);
        //     }
        // }

        // // quill editor add image handler
        // var toolbar = quill.getModule('toolbar');
        // toolbar.addHandler('image', selectLocalImage);

        // function saveImages() {
        //     var formData = new FormData();
        //     var imgQuill = document.getElementById('#imageUpload').files;
        //     let files = $('#imageUpload').prop('quill_image');
        //     for (let i = 0; i < imgQuill.length; i++) {
        //         formData.append('quill_image[]', imgQuill[i]);
        //     }
        //     $.ajax({
        //         type: 'POST',
        //         url: "{{ route('news.upImages') }}",
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         data: formData,
        //         cache: false,
        //         contentType: false,
        //         processData: false,
        //         success: (data) => {

        //         },
        //         error: function(data) {
        //             console.log(data);
        //         }
        //     });
        // }
    </script>

    <script>
        function previewImage() {
            const image = document.querySelector('#up_images');
            const imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';
            imgPreview.style.objectFit = 'cover';

            const reader = new FileReader();
            reader.readAsDataURL(image.files[0]);

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
                    if (fileSize < 3) {
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
@endsection
