<html>
	<head>
		<title>Form Pendaftaran Santri Baru</title>
		<!-- Web Fonts  -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="{!! asset($pathp.'assets/backend/porto-admin/vendor/bootstrap/css/bootstrap.css') !!}" />

		<!-- Invoice Print Style -->
		<link rel="stylesheet" href="{{ asset($pathp.'assets/backend/porto-admin/stylesheets/invoice-print.css') }}" />
		<style type="text/css">
			.font-times h4, .font-times p, .font-times table tr td{
				font-family: "Times New Roman", Times, serif;
			}
		</style>
	</head>
	<body>
		<div class="invoice">
			<header class="clearfix">
				<div class="row">
					<div class="col-sm-3 mt-md">
						<img src="{{asset($pathp.'assets/logo_almamater.jpg')}}" style="margin-left: 30px; height: 100px;width: 100px">
					</div>
					<div class="col-sm-9 center mt-md mb-md">
						<address class="ib mr-xlg font-times">
							<h4><strong>FORMULIR PENDAFTARAN SANTRI BARU</strong></h4>
							<h4>PONDOK PESANTREN AL-IHSAN</h4>
							<h4><strong>CIBIRU HILIR CILEUNYI BANDUNG</strong></h4>
						</address>
					</div>
				</div>
			</header>
			<div class="bill-info">
				<div class="row">
					<div class="col-md-12">
						<div class="bill-to font-times">
							<p class="h4 mb-xs text-dark text-weight-semibold">Yang betanda tangan dibawah ini, saya:</p>
							<table>
								<tr>
									<td>Nama Lengkap</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
									<td>&nbsp; {{ $data['nama'] }}</td>
								</tr>
								<tr>
									<td>Nama Panggilan </td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
									<td>&nbsp; {{ $data['nama_panggilan'] }}</td>
								</tr>
							</table>
							<table>
								<tr>
									<td>Tempat/Tanggal Lahir</td>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td>
									<td>&nbsp; {{ $data['tempat_lahir'] }}/{{ $data['tanggal_lahir'] }}</td>
								</tr>
							</table>
							<table>
								<tr>
									<td>Alamat Asal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>&nbsp;: {{ $data['alamat'] }}</td>
									<td>&nbsp; RT : {{ $data['rt'] }} RW : {{ $data['rw'] }}</td>
								</tr>
							</table>
							<table>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
									<td>Desa/Kelurahan</td>
									<td>&nbsp;: {{ $data['desa'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>Kecamatan</td>
									<td>&nbsp;: {{ $data['kecamatan'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>Kabupaten/Kota</td>
									<td>&nbsp;: {{ $data['kota'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>Provinsi</td>
									<td>&nbsp;: {{ $data['provinsi'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>Kode Pos</td>
									<td>&nbsp;: {{ $data['kode_pos'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>No. Telp/Hp</td>
									<td>&nbsp;: {{ $data['telepon'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>Email</td>
									<td>&nbsp;: {{ $data['email'] }}</td>
								</tr>
							</table>
							<table>
								<tr>
									<td><strong>Pengalaman Pendidikan</strong></td>
								</tr>
								<tr>
									<td>SD/MI</td>
									<td>&nbsp;: {{ $data['sd'] }}</td>
									<td>&nbsp;Lulus tahun</td>
									<td>&nbsp;: {{ $data['tahun_lulus_sd'] }}</td>
								</tr>
								<tr>
									<td>SMP/M.Ts</td>
									<td>&nbsp;: {{ $data['smp'] }}</td>
									<td>&nbsp;Lulus tahun</td>
									<td>&nbsp;: {{ $data['tahun_lulus_smp'] }}</td>
								</tr>
								<tr>
									<td>SMA/MA/SMK</td>
									<td>&nbsp;: {{ $data['tahun_lulus_sma'] }}</td>
									<td>&nbsp;Lulus tahun</td>
									<td>&nbsp;: {{ $data['tahun_lulus_sma'] }}</td>
								</tr>
								<tr>
									<td>Pondok Pesantren</td>
									<td>&nbsp;: {{ $data['ponpes'] }}</td>
								</tr>
								<tr>
									<td>Perguruan Tinggi</td>
									<td>&nbsp;: Universitas/Institut</td>
									<td>&nbsp; : {{ $data['univ'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>&nbsp;&nbsp; Fakultas</td>
									<td>&nbsp; : {{ $data['fakultas'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>&nbsp;&nbsp; Jurusan</td>
									<td>&nbsp; : {{ $data['jurusan'] }}</td>
								</tr>
								<tr>
									<td></td>
									<td>&nbsp;&nbsp; Semester</td>
									<td>&nbsp; : {{ $data['semester'] }}</td>
								</tr>
								<tr>
									<td><strong>Orang Tua</strong></td>
								</tr>
								<tr>
									<td>Ayah</td>
									<td> : {{ $data['ayah'] }}</td>
								</tr>
								<tr>
									<td>Umur</td>
									<td> : {{ $data['umur_ayah'] }} Tahun</td>
								</tr>
								<tr>
									<td>Pendidikan Terakhir</td>
									<td> : {{ $data['pendidikan_terakhir_ayah'] }}</td>
								</tr>
								<tr>
									<td>Pekerjaan</td>
									<td> : {{ $data['pekerjaan_ayah'] }}</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
									<td>Ibu</td>
									<td> : {{ $data['ibu'] }}</td>
								</tr>
								<tr>
									<td>Umur</td>
									<td> : {{ $data['umur_ibu'] }} Tahun</td>
								</tr>
								<tr>
									<td>Pendidikan Terakhir</td>
									<td> : {{ $data['pendidikan_terakhir_ibu'] }}</td>
								</tr>
								<tr>
									<td>Pekerjaan</td>
									<td> : {{ $data['pekerjaan_ibu'] }}</td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>
							</table>
							<p class="h4 mb-xs text-dark text-weight-semibold">Mohon dengan hormat untuk diterima menjadi SANTRI PESANTREN AL IHSAN, dengan kesanggupan melaksanakan kewajiban.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			window.print();
		</script>
	</body>
</html>