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
    </style>
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Pengaturan Situs</h1>
        </div><!-- End Page Title -->

        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                            <img src="{{ $up->image == null ? asset('build/assets/img/profile-img.jpg') : 'storage/' . $up->image }}"
                                class=" img-thumbnail img-preview">
                            <label class="btn btn-primary mt-2">
                                Upload Images
                                <input type="file" name="image" class="upload__inputfile" id="up_images"
                                    onchange="previewImage()" accept="image/*">
                            </label>
                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Gambaran</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Situs</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                    @foreach ($data as $item)
                                        <h5 class="card-title">Deskripsi</h5>
                                        <p class="small fst">{{ $item->desc }}</p>

                                        <h5 class="card-title">Detail Situs</h5>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label ">Nama Situs</div>
                                            <div class="col-lg-9 col-md-8">{{ $item->nama_situs }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Alamat</div>
                                            <div class="col-lg-9 col-md-8">{{ $item->alamat }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Whatsapp</div>
                                            <div class="col-lg-9 col-md-8">{{ $item['kontak']['whatsapp'] }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Surel</div>
                                            <div class="col-lg-9 col-md-8">{{ $item['kontak']['email'] }}</div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-3 col-md-4 label">Instagram Profile</div>
                                            <div class="col-lg-9 col-md-8">{{ $item['kontak']['instagram'] }}</div>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form
                                        action="{{ $data == null ? route('setting.store') : route('setting.update', $up->id) }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        @if ($data != null)
                                            @method('put')
                                        @endif
                                        <div class="row mb-3">
                                            <label for="nama_situs" class="col-md-4 col-lg-3 col-form-label">Nama
                                                Situs</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama_situs" type="text" class="form-control" id="nama_situs"
                                                    value="{{ $data != null ? $up->nama_situs : '' }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="desc" class="col-md-4 col-lg-3 col-form-label">Deskripsi</label>
                                            <div class="col-md-8 col-lg-9">
                                                <textarea class="form-control" name="desc" id="desc" style="height: 250px">{{ $data != null ? $up->desc : '' }}
                                                </textarea>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="alamat" name="alamat"
                                                    value="{{ $data != null ? $up->alamat : '' }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="whatsapp" class="col-md-4 col-lg-3 col-form-label">Whatsapp</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="number" class="form-control" id="whatsapp" name="whatsapp"
                                                    value="{{ $data != null ? $up['kontak']['whatsapp'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Surel</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    value="{{ $data != null ? $up['kontak']['email'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="instagram" class="col-md-4 col-lg-3 col-form-label">Instagram
                                                Profile</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input type="text" class="form-control" id="instagram"
                                                    name="instagram"
                                                    value="{{ $data != null ? $up['kontak']['instagram'] : '' }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form><!-- End Profile Edit Form -->
                                </div>
                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->
@endsection

@section('page-script')
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

            if (extFile == "jpg" || extFile == "jpeg" || extFile == "png") {
                const reader = new FileReader();
                reader.readAsDataURL(image.files[0]);

                reader.onload = function(event) {
                    if (fileSize < 2) {
                        upImages();
                        imgPreview.src = event.target.result;
                    } else {
                        toastr.options = {
                            "closeButton": true,
                            "progressBar": true,
                            "positionClass": "toast-top-right"
                        };
                        toastr.error("Ukuran gambar terlalu besar!");
                    }
                }
            } else {
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right"
                };
                toastr.warning("Hanya boleh mengunggah berkas gambar!");
            }
        }

        function upImages() {
            var formData = new FormData();
            var image = $('#up_images')[0].files;
            formData.append('image', image[0])

            $.ajax({
                type: 'POST',
                url: "{{ route('setting.upImages') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    toastr.options = {
                        "closeButton": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right"
                    };
                    toastr.success(data.message);
                },
                error: function(data) {
                    toastr.error(data.message);
                    console.log(data)
                }
            });
        }
    </script>
@endsection
