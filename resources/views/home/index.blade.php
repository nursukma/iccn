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
                <a href="#"><img src="..\img\rakornas-2022.jpg" class="d-block w-100" alt="banner1"></a>
            </div>
            <div class="carousel-item">
                <a href="#"><img src="..\img\banner2.jpg" class="d-block w-100" alt="banner2"></a>
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
                <div id="ilustration" class="text-center">
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
                <div id="ilustration" class="text-center">
                    <img src="..\img\prinsip.png" alt="Ilustration">
                </div>
            </div>
            <div class="col-lg-6">
                <h2 id="title">10 Prinsip Kota Kreatif</h2>
                <p>10 Prinsip ini merupakan hasil dari Konferensi Kota Kreatif pada tanggal 27 April 2015 di Kota
                    Bandung</p>
                <ol>
                    <li>
                        Kota yang welas asih
                    </li>
                    <li>
                        Kota yang inklusif
                    </li>
                    <li>
                        Kota yang melindungi hak asasi manusia
                    </li>
                    <li>
                        Kota yang memuliakan kreativitas masyarakatnya
                    </li>
                    <li>
                        Kota yang tumbuh bersama lingkungan yang lestari
                    </li>
                    <li>
                        Kota yang memelihara kearifan sejarah sekaligus membangun semangat pembaharuan
                    </li>
                    <li>
                        Kota yang dikelola secara transparan, adil dan jujur
                    </li>
                    <li>
                        Kota yang memenuhi kebutuhan dasar masyarakat
                    </li>
                    <li>
                        Kota yang memanfaatkan energi terbarukan
                    </li>
                    <li>
                        Kota yang mampu menyediakan fasilitas umum yang layak untuk masyarakat
                    </li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section id="materi">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 id="title" class="mt-4">11 Jurus Catcha Ekadasa</h2>
                <p>Setiap kota memiliki potensi dan masalah yang unik, serta membutuhkan solusi yang tepat guna, ICCN
                    telah memetakan formula yang dapat diaplikasikan sebagai solusi untuk pembangunan kota yang
                    berorientasi pada kreativitas lokal berdasarkan pengalaman dan kisab baik dari inisiatif kota
                    kreatif di Indonesia dan negara lain. Formula Catha Ekadasa terdiri dari 11 jurus yang solutif.</p>
                <ol>
                    <li>
                        Forum Lintas Ekonomi Kreatif
                    </li>
                    <li>
                        Komite Ekonomi Kreatif Pemerintah Daerah
                    </li>
                    <li>
                        Ekosistem Kreatif Kota/Kabupaten (Iterasatari)
                    </li>
                    <li>
                        Navigasi Pembangunan Kota
                    </li>
                    <li>
                        Indeks Kota Kreatif
                    </li>
                    <li>
                        Strategi Komunikasi & Narasi
                    </li>
                    <li>
                        Creative City Branding Management
                    </li>
                    <li>
                        Festival Kreatif
                    </li>
                    <li>
                        Design Action / Musrenbang Kreatif
                    </li>
                    <li>
                        Wirausaha Kreatif Desa X Kota
                    </li>
                    <li>
                        Command Centre
                    </li>
                </ol>
            </div>
            <div class="col-lg-6">
                <div id="ilustration" class="text-center">
                    <img src="..\img\jurus.png" alt="Ilustration">
                </div>
            </div>
        </div>
    </div>
</section>

<section id="linimasa">
    <div class="container text-center">

        <h2 id="title">Linimasa ICCN</h2>
        <img src="..\img\linimasa.png" alt="Linimasa" id="timeline">

        <div id="modal" class="modal">
            <span class="close">&times;</span>
            <img class="modal-content" id="tl">
            <div id="caption"></div>
        </div>
    </div>
</section>

<section id="program_iccn">
    <div class="container">
        <h2 id="title" class="text-center">Program Tahunan ICCN</h2>

        <h4 id="title" class="mt-4">1. Rapat Koordinasi Nasional (Rakernas) ICCN</h4>
        <div class="row mt-2">
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC1)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Surakarta, 22-25 Oktober 2015</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC2)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Malang, 30 Maret 2016</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC3)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Makasar, 6-10 September 2017</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC3)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Makasar, 6-10 September 2017</p>
                    </div>
                </div>
            </div>
        </div>

        <h4 id="title" class="mt-4">2. Indonesia Creative Cities Festival (ICCF)</h4>
        <div class="row mt-2">
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC1)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Surakarta, 22-25 Oktober 2015</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC2)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Malang, 30 Maret 2016</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC3)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Makasar, 6-10 September 2017</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Indonesia Creative Cities Conference (ICCC3)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Makasar, 6-10 September 2017</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="program_mitra">
    <div class="container">
        <h2 id="title" class="text-center mt-4">Program Kemitraan ICCF</h2>
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Jenama Lokal (JELO)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer">Bekerja sama dengan Kementrian Koperasi dan UKM</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Hyundai Start-Up Challange</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer"></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <img src="..\img\rakornas.png" alt="" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-text">Bootcamp Accelerator for Mayir Office (BAMO)</h5>
                    </div>
                    <div class="card-footer">
                        <p class="footer"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="program_human">
    <div class="container">
        <h2 id="title" class="text-center">Program Kemanusiaan ICCN</h2>
        <div class="row">
            <div class="col-lg-6">
                <img src="..\img\bantu.png" alt="Ilustration" id="ilustration">
            </div>
            <div class="col-lg-6">
                <h4 id="title" class="mb-2" style="margin-top: 100px">Bantu Sesama, Maju Bersama!</h4>
                <p>Menghadapi wabah COVID-19, semangat dan nilai kebersamaan bangsa harus tetap terjaga. Bergotong
                    royong menyiapkan diri, kampung, komunitas dan lingkungan untuk bekerja sama tanpa kepanikan. Tetap
                    tenang, kita gotong royong melakukan Aksi Bersama Bantu Sesama untuk Indonesia Raya!</p>
                <div class="d-flex mt-4">
                    <a href="#" class="text-black">Selengkapnya</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="ajar">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h2 id="title" class="mb-2">Akademi Belajar ICCN</h2>
                <p>ICCN berupaya untuk terus menginisiasi lahir dan bertumbuhnya kota serta kabupaten kreatif di
                    Indonesia. Dengan program AJAR ini semua aktor terkait mulai dari akademisi, pelaku usaha,
                    komunitas, pemerintah dan juga media bisa belajar bersama. Platform AJAR dijalankan secara online
                    melalui kelas dan modul dan juga diselenggarakan secara khusus di kota Anda.</p>
                <img src="..\img\ajar.png" alt="" style="width: 200px!important; height:100px" class="mt-4">
            </div>
            <div class="col-lg-6">
                <div id="ilustration" class="text-center">
                    <img src="..\img\bukuputih.png" alt="Ilustrasi">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <h5>Video</h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <h5>Video</h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <h5>Video</h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <h5>Video</h5>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <h5>Video</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="media">
    <div class="container">
        <div class="row">
            <div class="text-center col-lg-6">
                <h4 id="title">Belanja Barang Indonesia</h4>
                <a href="#"><img src="..\img\ics.png" alt="Logo"
                        style="width: 100px!important; height:130px; margin-top:40px"></a>
            </div>
            <div class="col-lg-6">
                <h4 id="title" class="text-center">ICCN Media</h4>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-4">
                        <button type="button" class="btn-icon btn btn-facebook">
                            <span class="btn-inner--icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="btn-inner--text">Press Release</span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button type="button" class="btn-icon btn btn-facebook">
                            <span class="btn-inner--icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="btn-inner--text">ICCN Media</span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button type="button" class="btn-icon btn btn-facebook">
                            <span class="btn-inner--icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="btn-inner--text">ICCN Media</span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button type="button" class="btn-icon btn btn-facebook">
                            <span class="btn-inner--icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="btn-inner--text">Kabar Jejaring</span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button type="button" class="btn-icon btn btn-facebook">
                            <span class="btn-inner--icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="btn-inner--text">ICCN Media</span>
                        </button>
                    </div>
                    <div class="col-lg-4 col-md-4 col-4">
                        <button type="button" class="btn-icon btn btn-facebook">
                            <span class="btn-inner--icon"><i class="fa-brands fa-facebook"></i></span>
                            <span class="btn-inner--text">ICCN Media</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="news">
    <div class="container">
        <h2 id="title" class="text-center">Berita Terbaru</h2>
        <p class="text-center">Berita dan Blog ICCN</p>
        <div class="row mt-2">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header p-0 mx-3 mt-n4">
                        <a class="d-block blur-shadow-image">
                            <img src="../img/news/avpn.jpg" alt="AVPN" class="img-fluid border-radius-lg">
                        </a>
                    </div>
                    <div class="card-body pt-3">
                        <p class="text-dark mb-2 text-sm">Senin, 20 Juni 2022</p>
                        <a href="javascript:;">
                            <h5>
                                AVPN 2022
                            </h5>
                        </a>
                        <p>
                            Dwinita (Tita) Larasati studied product design at Institut Teknologi Bandung (ITB), where
                            she currently works as a lecturer and researcher, and pursued her study at Design Academy
                            Eindhoven and Delft University of Technology, The Netherlands.
                        </p>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">Selengkapnya</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header p-0 mx-3 mt-n4">
                        <a class="d-block blur-shadow-image">
                            <img src="../img/news/iccn_news.jpg" alt="ITB" class="img-fluid border-radius-lg">
                        </a>
                    </div>
                    <div class="card-body pt-3">
                        <p class="text-dark mb-2 text-sm">Senin, 25 Januari 2021</p>
                        <a href="javascript:;">
                            <h5>
                                ICCN Berkolaborasi dengan ITB Menggunakan Teknologi untuk Membantu Korban Sulawesi Barat
                            </h5>
                        </a>
                        <p>
                            Dalam misi membantu tanggap darurat gempa di Majene ini, Tim ITB berkoordinasi dengan Tim
                            Rumah Sakit Terapung Ksatria Airlangga (RSTKA Unair) yang dipimpin oleh dr. Agus Harianto,
                            Sp.B. dan Tim Unhas, serta perwakilan dari Indonesia Creative Cities Network (ICCN), juga
                            sukarelawan Bulan Sabit Merah Indonesia (BSMI).
                        </p>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">Selengkapnya</button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header p-0 mx-3 mt-n4">
                        <a class="d-block blur-shadow-image">
                            <img src="../img/news/iccf_bali.jpg" alt="ICCF Bali" class="img-fluid border-radius-lg">
                        </a>
                    </div>
                    <div class="card-body pt-3">
                        <p class="text-dark mb-2 text-sm">Rabu, 25 November 2020</p>
                        <a href="javascript:;">
                            <h5>
                                ICCF 2020: Refleksi Potensi Daya Cipta Demi Kepulihan yang Harmonis
                            </h5>
                        </a>
                        <p>
                            ICCF 2020 mengambil tema "Siwam, Satyam, Sundharam", frasa Bali yang berarti Kesucian,
                            Kebenaran/Kemuliaan, Keindahan/Kreativitas, yang mengandung pesan inti memaknai momentum
                            pandemi untuk meraih kembali kemuliaan spiritual, kemanusiaan, dan alam, melalui
                            kreativitas.
                        </p>
                        <button type="button" class="btn btn-outline-primary btn-sm mb-0">Selengkapnya</button>
                    </div>
                </div>
            </div>
        </div>
</section>

<section id="vid_collab">
    <div class="container">
        <h2 id="title" class="text-center">Kolaborasi</h2>
        <div class="row">
            <div class="col-lg-8">
                <div class="card" style="background-color: black; height: 200px">
                    <div class="card-header text-center text-white">
                        <h5>Play Video</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4" style="background-color: brown; height: 200px">
                <div class="card-header text-center text-white">
                    <h5 class="mt-2">List Video</h5>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="hub">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h3 id="title">ICCN Newslatter</h3>
            </div>
            <div class="col-lg-6">
                <div class="card shadow">
                    <div class="card-header">
                        <h2 id="title" class="text-center">Hubungi Kami</h2>
                    </div>
                    <div class="card-body">
                        <p>Untuk pertanyaan lebih lanjut, termasuk peluang kemitraan, silakan hubungi menggunakan
                            formulir kontak kami.</p>
                            <div class="input-group">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Nama Lengkap" style="border-radius: 1px; height: 50px">
                                    </div>
                                    <div class="col-lg-6">
                                        <input type="text" placeholder="Email" style="border-radius: 1px; height: 50px">
                                    </div>
                                </div>
                                <input type="text" placeholder="Pesan" class="mt-4" style="width: 100%; height: 100px">
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('page-script')
<script>
    var modal = document.getElementById('modal')

        var img = document.getElementById('timeline')
        var modalImg = document.getElementById('tl')
        var captionText = document.getElementById('caption')

        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = this.src;
            captionText.innerHTML = this.alt;
        }

        var span = document.getElementById('close')[0];

        span.onclick = function(){
            modal.style.display = "none";
        }
</script>
@endsection