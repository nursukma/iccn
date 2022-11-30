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
            <h1>Form Struktur Organisasi</h1>
        </div>

        <div class="row">
            <!--  -->
            <div class="col-xl-12 col-lg-10 mx-auto">
                <div class="card shadow mb-4">
                    <!-- Card Body -->
                    <form class="form-add row g-3 needs-validation"
                        action="{{ $action == 'add' ? route('struktur.store') : route('struktur.update', $struktur->id) }}"
                        method="post" novalidate enctype="multipart/form-data">
                        @csrf
                        @if ($action == 'edit')
                            @method('put')
                        @endif
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div class="col-md-6 mt-2">
                                        <label for="nama">Nama</label>
                                        <input type="text" class="form-control" id="nama" name="nama"
                                            value="{{ $action == 'edit' ? $struktur->nama : '' }}" required>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="jabatan">Jabatan</label>
                                        <input type="text" class="form-control" id="jabatan" name="jabatan"
                                            value="{{ $action == 'edit' ? $struktur->jabatan : '' }}" required>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label for="periode">Periode</label>
                                        <input type="text" class="form-control" id="periode" name="periode"
                                            value="{{ $action == 'edit' ? $struktur->periode : '' }}" required>
                                    </div>
                                    <div class="col-md-6 mt-2">
                                        <label class="btn btn-primary">
                                            Upload Images
                                            <input type="file" name="image" class="upload__inputfile" id="up_images"
                                                onchange="previewImage()">
                                        </label>
                                        <img class="img-preview img-fluid col-sm-5 mt-2"
                                            src="{{ $action == 'edit' ? asset('storage/' . $struktur->image) : '' }}"
                                            style="display:block; object-fit:cover" />
                                    </div>
                                    <div class="col-12 mt-3">
                                        <button type="submit" class="btn btn-success">Simpan</button>
                                        <a href="/struktur" class="btn btn-secondary">Kembali</a>
                                    </div>
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
        function previewImage() {
            const image = document.querySelector('#up_images');
            const imgPreview = document.querySelector('.img-preview')

            imgPreview.style.display = 'block';
            imgPreview.style.objectFit = 'cover';

            const reader = new FileReader();
            reader.readAsDataURL(image.files[0]);

            reader.onload = function(event) {
                imgPreview.src = event.target.result;
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            $.get('/getStruktur', function(data) {
                if (data != null) {
                    var periode = document.querySelector('#periode');
                    data.forEach(val => {
                        periode.value = val.periode
                    });
                }
            })
        })
    </script>
@endsection
