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

        .upload__img-close {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background-color: rgba(0, 0, 0, 0.5);
            position: absolute;
            top: 10px;
            right: 10px;
            text-align: center;
            line-height: 24px;
            z-index: 1;
            cursor: pointer;
        }

        .upload__img-close:after {
            content: '\2716';
            font-size: 14px;
            color: white;
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

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-10">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Sliders</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form class="row g-3 needs-validation"
                        action="{{ $action == 'add' ? route('sliders.store') : route('sliders.update', $slider->id) }}"
                        method="post" novalidate enctype="multipart/form-data">
                        @csrf
                        @if ($action == 'edit')
                            @method('put')
                        @endif
                        {{-- <div class="row mx-auto mt-1"> --}}
                        <div class="col-6 mb-2" id="form-sliders" name="form-sliders">
                            <label for="link" class="form-label">Judul</label>
                            <input type="text" class="form-control" id="title" name="title"
                                value="{{ $action == 'edit' ? $slider->title : '' }}" required>

                            <label for="link" class="form-label">Pranala Pendukukng</label>
                            <input type="text" class="form-control" id="link" name="link"
                                value="{{ $action == 'edit' ? $slider->link : '' }}" required>
                        </div>
                        {{-- <div class="upload__box">
                                        <div class="upload__btn-box">
                                            <label class="btn upload__btn">
                                                <p>Upload images</p>
                                                <input type="file" multiple="" data-max_length="20"
                                                    class="upload__inputfile" name="file_url[]" id="file_url" multiple>
                                            </label>
                                        </div>
                                        <div class="upload__img-wrap" id="imgwrap">
                                            <div class="upload__img-box">
                                                <div class="img-bg"
                                                    style="background-image: url('{{ url('build/assets/img/user.png') }}')">
                                                    <input type="hidden" name="old_photo_remains[]" value="">
                                                    <div class="upload__img-close"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                        <div class="col-md-6 mb-2 mt-2">
                            <label class="btn btn-primary mt-4" style="{{ $action == 'edit' ? 'position:relative' : '' }}">
                                Upload Images
                                <input type="file" name="image" class="upload__inputfile" id="up_images"
                                    onchange="previewImage()" accept="image/*">
                            </label>
                            <img src="{{ $action == 'edit' ? asset('storage/' . $slider->image) : '' }}"
                                class="img-preview img-fluid col-sm-5"
                                style="display:block; object-fit:cover; margin: 0 -25px" />
                        </div>
                        <div class="col-12 mt-3 ml-2">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="/sliders" class="btn btn-secondary">Kembali</a>
                        </div>
                        {{-- </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    {{-- <script>
        jQuery(document).ready(function() {
            ImgUpload();
        });

        function createPetField() {
            var input = document.createElement('input');
            input.type = 'text';
            input.name = 'link[]';
            return input;
        }

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];

            $('.upload__inputfile').each(function() {
                $(this).on('change', function(e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var form = document.getElementById('form-sliders');

                    var maxLength = $(this).attr('data-max_length');

                    var files = e.target.files;

                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function(f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                var reader = new FileReader();

                                reader.onload = function(e) {
                                    // console.log(reader);
                                    var html =
                                        "<div class='upload__img-box'><div style='background-image: url(" +
                                        e.target.result + ")' data-number='" + $(
                                            ".upload__img-close").length + "' data-file='" + f
                                        .name +
                                        "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;

                                    if (imgArray.length > 1) {
                                        form.appendChild(createPetField());
                                    }
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function(e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }
    </script> --}}

    <script>
        function previewImage() {
            const image = document.querySelector('#up_images');
            const imgPreview = document.querySelector('.img-preview');

            // imgPreview.style.display = 'block';
            // imgPreview.style.objectFit = 'cover';

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
    </script>
@endsection
