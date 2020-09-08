<!DOCTYPE html>
<html>
<head>
	<title>PDF Target SKP</title>
	<style type="text/css">
		body{
			font-family: Arial Narrow;
			font-size: 11px;
		}

		thead{
			font-weight: bold;
			text-align: center;
		}
		.border td{
			border: 1px solid;
		}
		.center{
			text-align: center;
		}
		.lebar{
			width: 100%;
		}

		.ttd td{
			padding: 0;
			margin: 0;
		}
		.putih{
			color: white;
		}
		.kanan{
			text-align: right;
		}
	</style>
</head>
<body>

	<h3 class="center">
		<img src="{{ asset('img/garuda.png') }}" height="50" ><br>
		PENILAIAN PRESTASI KERJA PEGAWAI NEGERI SIPIL
	</h3> 

	<div>
		<div style="float: left; margin-left: 5em;">
		INSTANSI: FAKULTAS EKONOMI DAN BISNIS ULM
		</div>

		<div style="float: right; margin-right: 5em;">
			JANGKA WAKTU PENILAIAN <br>
			{{$tgl_start}} {{ $blnList[$bln_start] }} s.d. {{$tgl_end}} {{ $blnList[$bln_end] }} {{$thn_end}}
		</div>	
	</div><br><br>
	
	
	<table class="lebar border" cellspacing="0" border="1">
<!--1 -->
<!--1 -->
		<tr>
			<td rowspan="6" style="vertical-align: top;">1</td>
			<td colspan="7">YANG DINILAI</td>
		</tr>
		<tr>
			<td>a.</td>
			<td>Nama</td>
			<td colspan="5">{{ $skp->user->name }}</td>
		</tr>
		<tr>
			<td>b.</td>
			<td>NIP</td>
			<td colspan="5">{{ $skp->user->nip }}</td>
		</tr>
		<tr>
			<td>c.</td>
			<td>Pangkat Golongan Ruang, TMT</td>
			<td colspan="5">{{ $skp->user->pangkat->pangkat }} / {{ $skp->user->pangkat->golongan }}</td>
		</tr>
		<tr>
			<td>d.</td>
			<td>Jabatan Pekerjaan</td>
			<td colspan="5">{{ $skp->user->jabatan }}</td>
		</tr>
		<tr>
			<td>e.</td>
			<td>Unit Organisasi</td>
			<td colspan="5">Fakultas Ekonomi dan Bisnis ULM</td>
		</tr>

<!-- 2 -->
<!-- 2 -->
		<tr>
			<td rowspan="6" style="vertical-align: top;">2</td>
			<td colspan="7">PEJABAT PENILAI</td>
		</tr>
		<tr>
			<td>a.</td>
			<td>Nama</td>
			<td colspan="5">{{ $skp->user->atasan->name }}</td>
		</tr>
		<tr>
			<td>b.</td>
			<td>NIP</td>
			<td colspan="5">{{ $skp->user->atasan->nip }}</td>
		</tr>
		<tr>
			<td>c.</td>
			<td>Pangkat Golongan Ruang, TMT</td>
			<td colspan="5">{{ $skp->user->atasan->pangkat->pangkat }} / {{ $skp->user->atasan->pangkat->golongan }}</td>
		</tr>
		<tr>
			<td>d.</td>
			<td>Jabatan Pekerjaan</td>
			<td colspan="5">{{ $skp->user->atasan->jabatan }}</td>
		</tr>
		<tr>
			<td>e.</td>
			<td>Unit Organisasi</td>
			<td colspan="5">Fakultas Ekonomi dan Bisnis ULM</td>
		</tr>

<!-- 3 -->
<!-- 3 -->
		<tr>
			<td rowspan="6" style="vertical-align: top;">3</td>
			<td colspan="7">ATASAN PEJABAT PENILAI</td>
		</tr>
		<tr>
			<td>a.</td>
			<td>Nama</td>
			<td colspan="5">{{ $skp->user->atasan->atasan->name }}</td>
		</tr>
		<tr>
			<td>b.</td>
			<td>NIP</td>
			<td colspan="5">{{ $skp->user->atasan->atasan->nip }}</td>
		</tr>
		<tr>
			<td>c.</td>
			<td>Pangkat Golongan Ruang, TMT</td>
			<td colspan="5">{{ $skp->user->atasan->atasan->pangkat->pangkat }} / {{ $skp->user->atasan->atasan->pangkat->golongan }}</td>
		</tr>
		<tr>
			<td>d.</td>
			<td>Jabatan Pekerjaan</td>
			<td colspan="5">{{ $skp->user->atasan->atasan->jabatan }}</td>
		</tr>
		<tr>
			<td>e.</td>
			<td>Unit Organisasi</td>
			<td colspan="5">Fakultas Ekonomi dan Bisnis ULM</td>
		</tr>

<!-- 4 -->
<!-- 4 -->
		<tr>
			<td rowspan="12" style="vertical-align: top;">4</td>
			<td colspan="6">UNSUR YANG DINILAI</td>
			<td class="center">JUMLAH</td>
		</tr>
		<tr>
			<td>a.</td>
			<td colspan="2">Sasaran Kerja PNS (SKP)</td>
			<td style="text-align: right; border-right: none;">{{number_format((float)$nilai_capaian, 2, '.', '')}}</td>
			<td style="text-align: right; border-right: none; border-left: none;">X</td>
			<td class="center" style="border-left: none;">60%</td>
			<td class="center">{{number_format((float)$p_skp, 2, '.', '')}}</td>
		</tr>

		<tr>
			<td rowspan="10" style="vertical-align: top;">b.</td>
			<td rowspan="10" style="vertical-align: top;">Perilaku Kerja</td>
			<td colspan="4"></td>
			<td rowspan="9"></td>
		</tr>
		
		<?php $no = 0; ?>
		@foreach($penilaian_list as $penilaian)
			<?php $no++; ?>
			<tr>
				<td>{{$no}} {{ $penilaian->perilaku->nama }}</td>
				<td style="text-align: right;">{{ $penilaian->nilai }}</td>
				<td colspan="2" class="center">{{ $penilaian->kategori->nama }}</td>
			</tr>
		@endforeach

		<tr>
			<td>7. Jumlah</td>
			<td style="text-align: right;">{{$j_nilai}}</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>8. Nilai Rata-rata</td>
			<td style="text-align: right;">{{number_format((float)$r_nilai, 2, '.', '')}}</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td>9. Nilai Perilaku Kerja</td>
			<td style="border-right: none; text-align: right;">{{number_format((float)$r_nilai, 2, '.', '')}}</td>
			<td style="border-left: none; border-right: none; text-align: right;">X</td>
			<td class="center" style="border-left: none;">40%</td>
			<td class="center">{{number_format((float)$n_perilaku, 2, '.', '')}}</td>
		</tr>
		<tr>
			<td rowspan="2" colspan="7" class="center">NILAI PRESTASI KERJA</td>
			<td class="center">{{number_format((float)$n_prestasi, 2, '.', '')}}</td>
		</tr>
		<tr>
			<td class="center">({{$kat}})</td>
		</tr>

<!-- 5 -->
<!-- 5 -->
		<tr>
			<td style="vertical-align: top;">5 <br><br><br><br><br></td>
			<td style="vertical-align: top;" colspan="5">KEBERATAN DARI PEGAWAI NEGERI SIPIL</td>
			<td style="vertical-align: top;" colspan="2">Tanggal, ................</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">6 <br><br><br><br><br></td>
			<td style="vertical-align: top;" colspan="5">TANGGAPAN PEJABAT PENILAI ATAS KEBERATAN</td>
			<td style="vertical-align: top;" colspan="2">Tanggal, ................</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">6 <br><br><br><br><br></td>
			<td style="vertical-align: top;" colspan="5">KEPUTUSAN ATASAN PEJABAT PENILAI ATAS KEBERATAN</td>
			<td style="vertical-align: top;" colspan="2">Tanggal, ................</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">6 <br><br><br><br><br></td>
			<td style="vertical-align: top;" colspan="5">REKOMENDASI</td>
			<td style="vertical-align: top;" colspan="2">Tanggal, ................</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="5"></td>
			<td style="vertical-align: top;font-size: 9px;" colspan="2">
				9. DIBUAT PADA TANGGAL, {{$tgl_ttd1}} {{ $blnList[$bln_ttd1] }} {{$thn_ttd1}}<br>
				PEJABAT PENILAI <br><br><br><br>
				{{ $skp->user->atasan->name }} <br>
				{{ $skp->user->atasan->nip }}
			</td>
		</tr>
		<tr>
			<td style="vertical-align: top;">10</td>
			<td style="vertical-align: top;font-size: 9px;" colspan="5"> 
				DITERIMA TANGGAL, {{$tgl_ttd2}} {{ $blnList[$bln_ttd2] }} {{$thn_ttd2}}<br>
				PEGAWAI NEGERI SIPIL YANG DINILAI <br><br><br><br>
				{{ $skp->user->name }} <br>
				{{ $skp->user->nip }}</td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td></td>
			<td colspan="5"></td>
			<td style="vertical-align: top;font-size: 9px;" colspan="2">
				11. DITERIMA TANGGAL, {{$tgl_ttd3}} {{ $blnList[$bln_ttd3] }} {{$thn_ttd3}}<br>
				ATASAN PEJABAT PENILAI <br><br><br><br>
				{{ $skp->user->atasan->atasan->name }} <br>
				{{ $skp->user->atasan->atasan->nip }}
			</td>
		</tr>

	</table>
	

</body>
</html>