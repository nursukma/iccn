@extends('layouts.app')

@section('content')
{{-- Banner Slide --}}
<section id="banner">
    <div id="carousel-slide" class="carousel slide" data-bs-ride="carousel">
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-slide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="..\img\rakornas-2022.jpg" class="d-block w-100" alt="banner1">
            </div>
            <div class="carousel-item">
                <img src="..\img\banner2.jpg" class="d-block w-100" alt="banner2">
            </div>
        </div>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel-slide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

{{-- About --}}
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div id="ilustration" class="">
                    <img src="..\img\kolaborasi.png" alt="Ilustrasi">
                </div>
            </div>
            <div class="col-lg-6 mt-4">
                <div>
                    <h2 id="title">Padamu Negeri, <br> Kami Berkolaborasi!</h2>
                </div>
                <div class="text mt-4">
                    <p>Indonesia Creative Cities Network (ICCN) adalah simpul jejaring Kota/Kabupaten Kreatif yang
                        terbentuk sejak April 2015, dan dengan didasari oleh komitmen mewujudkan 10 Prinsip Kota
                        Kreatif. Untuk mewujudkan 10 Prinsip Kota Kreatif tersebut, ICCN pun menciptakan jurus 11
                        Jurus
                        Program Catha Ekadasa
                        <br>
                        Jejaring ICCN terdiri dari elemen masyarakat yang menghidupkan Pentahelix Ekonomi Kreatif,
                        yaitu
                        Akademisi, Pengusaha / UMKM, Komunitas, Pemerintah, Media, dan Aggregator. Sampai kini
                        jejaring
                        ICCN merangkul inisiatif sampai 211+ Kota/Kabupaten Kreatif di seluruh Indonesia.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Collab --}}
<section id="collab">
    <div class="container text-center">
        <div id="ilustration">
            <img src="..\img\abbs.png" alt="Ilustration">
        </div>

        <h2 id="title" class="mt-2">Aksi Bersama Bantu Bersama!</h2>
        <p>Program Kolaborasi Jejaring ICCN Tanggap COVID-19</p>


        <div class="row mt-4">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <img class="w-100 opacity-9" src="..\img\ics.png" alt="ICS" width="auto" height="auto">
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <img class="w-100 opacity-9" src="..\img\ajar.png" alt="AJAR" width="auto" height="auto">
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <img class="w-100 opacity-9" src="..\img\damping.png" alt="DAMPING" width="auto" height="auto">
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <img class="w-100 opacity-9" src="..\img\pulih.png" alt="PULIH" width="auto" height="auto">
            </div>
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <img class="w-100 opacity-9" src="..\img\rescue.png" alt="RESCUE" width="auto" height="auto">
            </div>
        </div>
    </div>
</section>

<section id="prinsip">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                
            </div>
            <div class="col-lg-6">
                <h2 id="title">10 Prinsip Kota Kreatif</h2>
            </div>
        </div>
    </div>
</section>

<section id="materi">

</section>

<section id="linimasa">

</section>

<section id="program_iccn">

</section>

<section id="program_iccf">

</section>

<section id="program_mitra">

</section>

<section id="shop">

</section>

<section id="media">

</section>

<section id="ajar">

</section>

<section id="news">

</section>
@endsection