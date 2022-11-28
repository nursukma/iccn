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
    {{-- Title dan Deskripsi --}}
    <div class="col-lg-12 col-md-10 mx auto">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Form Organisasi</h6>
            </div>
            <form class="form-add row g-3 needs-validation"
                action="{{ $action == 'add' ? route('organisasi.store') : route('organisasi.update', $organisasi->id) }}"
                method="post" novalidate enctype="multipart/form-data">
                {{-- @csrf --}}
                @if ($action == 'edit')
                @method('put')
                @endif
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="col-md-6 mb-2">
                                <label for="floatingName">Judul</label>
                                <input type="text" class="form-control" id="floatingName" placeholder="Judul"
                                    name="title" value="{{ $action == 'edit' ? $organisasi->title : '' }}">
                            </div>
                            <div class="col-md-6">
                                <label class="btn btn-primary">
                                    Upload Images
                                    <input type="file" name="image" class="upload__inputfile" id="up_images"
                                        onchange="previewImage()">
                                </label>
                                <img src="{{ $action == 'edit' ? asset('storage/' . $organisasi->image) : '' }}"
                                    alt="Foto" class="img-preview img-fluid col-sm-5"
                                    style="display: block; object-fit: cover; margin: 0 -15px" />
                            </div>
                            <div class="col-12">
                                <label for="floatingEmail">Deskripsi</label>
                                <input type="hidden" name="desc"
                                    value="{{ $action == 'edit' ? $organisasi->desc : '' }}">
                                <input type="hidden" name="action" value="{{ $action == 'edit' ? 'edit' : 'add' }}">

                                <div id="editor" class="form-control" style="height: 200px">
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button type="submit" class="btn btn-success">Simpan</button>
                                <a href="#" class="btn btn-secondary">Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{--  --}}
</div>
@endsection

@section('page-script')
<script>
    function previewImage() {
        const image = document.querySelector('#up_images');
        const imgPreview = document.querySelector('.img-preview')

        imgPreview.style.display = 'block';
        imgPreview.style.objectFit = 'cover';

        const reader = new FileReader();
        reader.readAsDataURL(img.files[0]);

        reader.onload = function(event) {
            imgPreview.src = event.target.result;
        }
    }
</script>

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

    var organisasi = document.querySelector('input[name=desc]');
    var action = document.querySelector('input[name=action]');

    // var action = {!! json_encode($action) !!};
    if (action.value === 'edit') {
        quill.root.innerHTML = organisasi.value
    }

    var form = document.querySelector('.form-add');
    form.onsubmit = function() {
        organisasi.value = quill.root.innerHTML;
    }
</script>
@endsection