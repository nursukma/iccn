@extends('layouts.default')



@section('content')
    <div class="row">
        <!--  -->
        <div class="col-xl-12 col-lg-10 mx-auto">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Form Linimasa</h6>
                </div>
                <!-- Card Body -->
                <form class="form-add row g-3 needs-validation"
                    action="{{ $action == 'add' ? route('timeline.store') : route('timeline.update', $timeline->id) }}"
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
                                        name="title" value="{{ $action == 'edit' ? $timeline->title : '' }}">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label class="btn btn-primary mt-4">
                                        Upload Images
                                        <input type="file" name="image" class="upload__inputfile" id="up_images"
                                            onchange="previewImage()">
                                    </label>
                                    <img class="img-preview img-fluid col-sm-5"
                                        src="{{ $action == 'edit' ? asset('storage/' . $timeline->image) : '' }}"
                                        style="display:block; object-fit:cover; margin: 0 -15px" />
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-success">Simpan</button>
                                    <a href="/about" class="btn btn-secondary">Kembali</a>
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
                    if (fileSize < 2) {
                        imgPreview.src = event.target.result;
                    } else {
                        toastr.error("Ukuran gambar terlalu besar!");
                    }
                }
            } else {
                toastr.warning("Hanya boleh mengunggah berkas gambar!");
            }
        }
    </script>
@endsection
