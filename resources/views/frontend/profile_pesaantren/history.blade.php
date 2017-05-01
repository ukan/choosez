@extends('layout.frontend.general.layout')

@section('title', 'History')

@section('css')
<style type="text/css">
.justify{
	text-align: justify;
	font-size: 16px;
	color: #000;
}
.box h3{
	text-align:center;
	position:relative;
	top:80px;
}
.box {
	width:100%;
	background:#FFF;
}

/*==================================================
 * Effect 1
 * ===============================================*/
.effect1{
     box-shadow: -10px 10px 10px -6px #777;
}
.effect1 h4{
     padding-left: 10px;
     padding-top: 10px;
}
label.line{
	background-color:#0088cc;
	display:block;
	width: 100px;
    height: 2px;
	margin-left: 10px;
}
.events{
	background-color:black;
}
.events h3{
	color:#fff;
	text-align:center;
    font-size:30px;
}
.events h6{
    color: #797979;
    padding-bottom: 30px;
    width: 45%;
    margin: 0 auto;
    font-size: 15px;
    text-align: center;
    line-height: 25px;

}
/*#2243e8 2807ff buru ungu
#32ddff 09cff7 tosca
#0011ff biru*/
#rcorners2 {
    border-radius: 25px;
    border: 2px solid #73AD21;
    padding: 20px;
    width: 200px;
    height: 150px;
}
.post-content h2{
	color: #0088cc;
}
.post-by{
	color: #0088cc;
}

/*post-custom*/
article.post-large-custom {
	margin-left: 0px;
}

article.post-large-custom h2 {
	margin-bottom: 5px;
}

article.post-large-custom .post-image-custom, article.post-large-custom .post-date-custom {
	margin-left: -60px;
}

article.post-large-custom .post-image-custom {
	margin-bottom: 15px;
}

article.post-large-custom .post-image.single-custom {
	margin-bottom: 30px;
}

article.post-large-custom .post-video-custom {
	margin-left: -60px;
}

article.post-large-custom .post-audio-custom {
	margin-left: -60px;
}
.history-place{width: 100%;box-shadow: 0 10px 8px 0 rgba(0,0,0,0.2), 0 6px 40px 0 rgba(0,0,0,0.19);}
</style>
<link rel="stylesheet" href="{!! asset($pathp.'assets/frontend/general/css/style.css') !!}">
@endsection

@section('content')
<div role="main" class="main">

	<section class="page-top">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="breadcrumb">
						<li><a href="{{ route('home') }}">@lang('general.menu.home')</a></li>
						<li class="active">@lang('general.menu.profile')</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<h1>@lang('general.menu.history')</h1>
				</div>
			</div>
		</div>
	</section>

	<div class="container">

		<div class="row">
			<div class="col-md-9">
				<div class="blog-posts single-post">

					<article class="post post-large-custom blog-single-post">
						<div class="post-image">
							<div class="owl-carousel" data-plugin-options='{"items":1, "dots": false, "autoplay": true, "autoplayTimeout": 9000}'>
								@foreach($slider as $key => $value)
								<div>
									<div class="img-thumbnail">
										<img style="height: 400px;width: 1280px" class="img-responsive" src="{{ asset($pathp.'storage/slider/'.$value->image) }}" alt="">
									</div>
								</div>
								@endforeach
							</div>
						</div>

						<div class="post-content back-content history-place">
							<h2>Sejarah Singkat Pondok Pesantren Al Ihsan</h2>
							<div class="post-meta">
								<i class="fa fa-user"></i><span class="post-by">@lang('general.public.by') K.H. Tantan Taqiyudin Lc. (Pimpinan Pondok Pesantren Al Ihsan) </span>
							</div>
							<p class="justify">K.H. Sulaeman Abdul Majid (1883-1955)  atau yang lebih dikenal dengan sebutan Mama Ule, merupakan keturunan asli Banten. Beliau merupakan seorang tokoh masyarakat di Cibiruhilir. K.H. Sulaeman Abdul Majid memiliki seorang istri yang bernama Siti Khodizah (1903-1981). K.H. Sulaeman Abdul Majid menjadi tokoh masyarakat dikarenakan kekayaan dan kepeloporannya dalam bidang agama Islam.</p>
							<p class="justify">K.H. Sulaeman Abdul Majid memang tokoh masyarakat yang kaya namun sangat mencintai ilmu. Beliau memiliki tekad yang kuat untuk memajukan Islam, khususnya di Cibiruhilir. Tak heran, jika banyak anak-anak Cibiruhilir yang beliau pesantrenkan. Dengan harapan, kelak mereka mampu menjadi penerus dakwah di masyarakat. Hampir semua tokoh agama Cibiruhilir dikirim belajar ke berbagai pesantren atas biaya beliau.</p>
							<p class="justify">Selain itu, Beliau juga aktif memperhatikan dan membantu kehidupan fakir miskin. Sudah menjadi legenda bahwa beliau sering berkeliling pada petang hari untuk memeriksa "dapur" fakir miskin. Kegiatan ini merupakan salah satu kiat dakwah beliau.</p>
							<p class="justify">Keinginan untuk memajukan Islam pun beliau buktikan dengan memasukkan kelima putrinya ke Pesantren Sukamiskin dan Cintawana, Tasikmalaya. Sebagai bagian dari strategi dakwahnya, Beliau menikahkan putri-putrinya dengan para santri berprestasi yang kebanyakan merupakan lulusan dari Pesantren AI-Jawami. Sehingga tak heran jika kelima suami putrinya menjadi tokoh masyarakat. Ke-empat putrinya berdomisili di Cibiruhilir dan satu orang putrinya berdomisili di Cikalang, yang  kini menjadi sesepuh Pesantren Miftahul Falah Cikalang.</p>
							<p class="justify">Beliau bersama keempat menantunya yang tinggal di Cibiruhilir mengelola Masjid Al-Mubarok yang terletak di depan rumahnya sebagai pusat pendidikan yang dikenal dengan Madrasah Miftah As Shibyan. Di masjid inilah generasi muda Cibiruhilir dan desa-desa sekitarnya dibina dengan sungguh-sungguh. Murid-murid madrasah ini tidak menetap dalam komplek madrasah, dikarenakan tempat yang kurang memungkinkan dan tempat tinggal tidak terlalu jauh dari madrasah.</p>
							<p class="justify">Pada awalnya Madrasah Miftah Ash-Shibyan dikelola secara langsung oleh K.H. Sulaeman Abdul Majid yang dibantu oleh tiga orang menantunya, K.A. Ruhiyat, H. Muchtar, dan H. Muhyidin serta di bantu oleh seorang putera cibiruhilir yakni H. Syamsudin.</p>
							<p class="justify">Pada tahun 1955, K.H. Sulaeman Abdul Majid wafat, yang bertepatan dengan saat-saat Pemilu pertama di Indonesia. Setelah wafatnya beliau, pendidikan di Madrasah Miftah Ash-Shibyan kemudian dilanjutkan oleh empat orang pengelola di atas. Baru pada tahun 1963, K.H. O.Z. Muttaqien, menantu kelima beliau yang menikahi putri bungsunya turut bergabung mukim di Cibiruhilir. Bersama tiga menantu yang lain, K.H. O.Z. Muttaqien menjadi pilar penyangga pendidikan keagamaan di Madrasah Miftah Ash-Shibyan, sekaligus menjadi pembina agama masyarakat Cibiruhilir.</p>
							<p class="justify">Pada perkembangan berikutnya, banyak sekali calon santri yang ingin mesantren kepada menantu beliau. Apalagi setelah berdirinya IAIN Sunan Gunung Djati Bandung, pada tahun 1968. Banyak mahasiswa dari berbagai daerah yang ingin menetap dan belajar disana.</p>
							<p class="justify">Kedua menantu beliau yakni, K.A. Ruhiyat dan K.H. O.Z. Muttaqien merasa senang atas kedatangan tamu yang ingin menitipkan anaknya sebagai santri. Namun sering pula calon santri pulang dengan kecewa karena saat itu belum tersedianya ruang untuk menampung mereka. Sehingga tak sedikit diantara mereka yang kemudian mencari tempat kost atau kamar sewaan di sekitar masjid Al-Mubarok sehingga mereka tetap dapat mengaji.</p>
							<p class="justify">Tercatat pula pada tahun 1970-an pengurus DKM dan para kyai meyediakan tempat tinggal bagi beberapa orang di menara masjid dan di ruang bedug. Kondisi ini jelas tidak tuma'ninah dan terkesan sangat darurat. Pelajaran terpenting dari kenyataan ini adalah bahwa animo pendirian pesantren di Cibiruhilir sangatlah besar.</p>
							<p class="justify">Terdapat dua faktor pendorong sehingga berdirilah pesantren di Cibiruhilir. Pertama, secara internal Mama Ule sendiri telah lama memendam cita-cita untuk mendirikan pesantren. Upaya beliau mengambil menantu santri berprestasi adalah salah satu cara untuk merintis cita-cita tersebut. Kedua, secara eksternal karena adanya dorongan kuat dari orang-orang luar daerah yang ingin mesantren di Cibiruhilir. Kedua faktor inilah alasan berdirinya pesantren di Cibiruhilir.</p>
							<p class="justify">Mewarisi cita-cita dan semangat dakwah K.H. Sulaeman Abdul Majid serta didorong oleh rasa terpanggil, menyahuti mereka yang betul-betul ingin mencari ilmu. Maka K.H. O.Z. Muttaqien bertekad untuk mendirikan pesantren. Tekad beliau direalisasikan pada tahun 1993 dengan peletakan batu pertama dilakukan oleh Bapak Camat Kecamatan Cileunyi.</p>
							<p class="justify">Pesantren tersebut diberi nama Mohammad Thoha dengan alasan kedua kata tersebut merupakan sebutan bagi Nabi Muhammad Saw. Ada harapan terbersit bahwa dengan nama tersebut, pesantren ini dapat mengikuti jejak Nabi Muhammad Saw dalam menyiarkan Islam. Mohammad Thoha juga merupakan nama tokoh pejuang dari Bandung Selatan yang senantiasa gigih tanpa mengenal lelah dalam memperjuangkan dan membela kebenaran. Dengan demikian, nama pesantren tersebut mengandung dua unsur; ke-lslaman dan ke-Indonesiaan. Di satu sisi, pesantren ini hendak mengibarkan panji-panji universal Islam. Di sisi lain pesantren ini juga tak ingin lepas dari nilai-nilai budaya lokal.</p>
							<p class="justify">Kelangsungan pembangunan Pesantren Mohammad Thoha cukup lancar namun tidak secepat yang diharapkan, mengingat dana yang diperlukan cukup besar. Untuk lebih memperlancar pembangunannya, maka KH. Tantan Taqiyudin, Lc. Putra sulung K.H. O.Z Muttaqien yang sekarang menjabat sebagai Pimpinan Pesantren, mencoba membuat proposal untuk mengajak para dermawan agar sudi kiranya bekerjasama mewujudkan cita-cita yang suci ini. Proposal tersebut dikirm ke berbagai lembaga yang berada di dalam dan luar negeri, antara lain ke Kedutaan Brunai Darussalam, Rabithah Alam Al-Islamy, Haiatul lgatsah Al-Islamiyah Al-'AIamiyah, Kuwait, dll. Dari proposal yang dikirimkan ternyata ada sambutan yang baik dari Haiatul Igotsah Al-Islamiyah Al-'Alamiyah Kuwait yang mengirimkan infaq sebesar $.1,000 atau sekitar Rp.2.000.000,-. Dengan uang tersebut, ditambah sumbangan swadaya masyarakat, beliau berhasil menyelesaikan pekerjaan berupa persiapan tanah, fondasi (beton) dan pekerjaan pemasangan dinding bata merah lantai satu.</p>
							<p class="justify">Sekitar tahun 1994 KH. Tantan Taqiyuddin bertemu dengan Drs. H. Ukman Sutaryan yang menjabat sebagai Ketua Yayasan Al-lhsan. Kesempatan itu beliau gunakan dengan sebaik-baiknya untuk menceritakan pembangunan pesantren. Setelah menyimak cerita tersebut, Drs. H. Ukman Sutaryan akhirnya menawarkan agar pesantren Mohammad Thoha bergabung saja dengan Yayasan Al-Ihsan dan diganti namanya dengan Pesantren Al-Ihsan. Tawaran tersebut, diterima dengan senang hati oleh KH. Tantan Taqiyudin, Lc. karena prinsip beliau nama itu tidak prinsipil yang penting isi dan misinya.</p>
							<p class="justify">Dengan dikelola oleh Yayasan Al-Ihsan tersebut. akhirnya pembangunan pesantren dapat diselesaikan dengan lancar seperti terlihat sekarang hasilnya. dan sejak saat itu telah resmi pula Pesantren Mohammad Thoha menjadi milik Yayasan Al-Ihsan.</p>

						</div>
					</article>

				</div>
			</div>

			@include('frontend.right_bar')
		</div>

	</div>

</div>
@endsection
