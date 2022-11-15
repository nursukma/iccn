@extends('layouts.app')

@section('content')
<section id="banner">
    <div id="banners" class="carousel slide" data-bs-ride="carousel">
        <div id="carousel-inner">
            <div class="carousel-item active" data-bs-interval="1000">
                <img src="..\img\rakornas-2022.jpg" alt="Banner1">
            </div>
            <div class="carousel-item">
                <div class="carousel-item active" data-bs-interval="1000">
                    <img src="..\img\banner1.jpg" alt="Banner2">
                </div>
            </div>
            <div class="carousel-item">
                <div class="carousel-item active" data-bs-interval="1000">
                    <img src="..\img\banner2.jpg" alt="Banner3">
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#banners" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#banners" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<section id="about">

</section>

<section id="collab">

</section>

<section id="prinsip">

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