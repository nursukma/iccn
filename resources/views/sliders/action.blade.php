@extends('layouts.default')

@section('page-style')
    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        #previewMap {
            width: 100%;
            min-height: 340px;
            overflow: hidden;
            position: relative;
        }

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
                <form class="row g-3 needs-validation" action="#" method="post" novalidate>
                    @csrf
                    <div class="card-body">
                        <div class="row mx-auto mt-1">
                            <div class="col-12">
                                <div class="col-6 mb-2" id="form-sliders" name="form-sliders">
                                    <label for="link" class="form-label">Pranala Pendukukng</label>
                                    <input type="text" class="form-control" id="link" name="link[]" required>
                                </div>
                                <div class="col-6">
                                    <div class="upload__box">
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
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 mt-3 ml-2">
                                <button type="submit" class="btn btn-success">Simpan</button>
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
    </script>
@endsection
