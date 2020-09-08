<!DOCTYPE html>
<html>
<head>
	<title>PDF LKH</title>
	<style type="text/css">
		body{
			font-family: Times New Roman;
			font-size: 12px;
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
	</style>
</head>
<body>

	<h3 class="center">REKAP LAPORAN KERJA HARIAN</h3> <br>	
	
	<table border="0">
		<tr>
			<td>NAMA</td>
			<td>:</td>
			<td>{{ $lkh_list[0]->user->name }}</td>
		</tr>
		<tr>
			<td>NIP / NIPK</td>
			<td>:</td>
			<td>{{ $lkh_list[0]->user->nip }}</td>
		</tr>
		<tr>
			<td>JABATAN</td>
			<td>:</td>
			<td>{{ $lkh_list[0]->user->jabatan }}</td>
		</tr>
		<tr>
			<td>BULAN / TAHUN</td>
			<td>:</td>
			<td>{{ $blnList[$bulan] }} / {{ $tahun }}</td>
		</tr>
	</table><br>

	<table border="1" cellspacing="0" class="lebar border" style="font-size: 9px;">
		<thead>
			<tr>
				<td rowspan="2">No.</td>
				<td rowspan="2">Hari / Tanggal</td>
				<td rowspan="2">Uraian Kegiatan</td>
				<td colspan="2">Waktu</td>
				<td>Keterangan Hasil Kerja</td>
			</tr>				
			<tr>
				<td>Mulai</td>
				<td>Selesai</td>
				<td>(Kualitas/Kuantitas)</td>
			</tr>			
		</thead>
		<tbody>
			<?php $no = 1; ?>
			    @foreach($lkh_list as $lkh)
			    	@foreach($lkh->kegiatan as $kegiatan)
			        <tr>
			        	<td class="center">{{ $no++ }}</td>
			        	<td class="center">
			        		{{ $dayList[date_format(date_create($lkh->tanggal), "N")] }} /
			        		{{ date_format(date_create($lkh->tanggal), "d/m/Y") }}
			        	</td>
			            <td>{{ $kegiatan->kegiatan }}</td>
			            <td class="center">{{ $kegiatan->waktua }}</td>
		            	<td class="center">{{ $kegiatan->waktub }}</td>
			            <td class="center">{{ $kegiatan->keterangan }}</td>
			        </tr>
			        @endforeach
		        @endforeach
		</tbody>
	</table><br>

	<table class="ttd" style="float: left; margin-left: 5em; page-break-inside: avoid;">
		<tr>
			<td>Mengetahui</td>			
		</tr>
		<tr>
			<td>Atasan Langsung</td>
		</tr>
		<tr >
			<td style="line-height: 6em;" class="putih">A</td>
		</tr>
		<tr>
			<td>{{ $lkh_list[0]->user->atasan->name }}</td>
		</tr>
		<tr>
			<td>NIP. {{ $lkh_list[0]->user->atasan->nip }}</td>
		</tr>
	</table>
	

	<table border="0" style="float: right; margin-right: 5em; page-break-inside: avoid;">
		<tr>
			<td>Banjarmasin, {{$tgl_ttd}} {{ $blnList[$bln_ttd] }} {{$thn_ttd}}</td>			
		</tr>
		<tr>
			<td>{{ $lkh_list[0]->user->jabatan }}</td>
		</tr>
		<tr >
			<td style="line-height: 6em;" class="putih">A</td>
		</tr>
		<tr>
			<td>{{ $lkh_list[0]->user->name }} </td>
		</tr>
		<tr>
			<td>NIP. {{ $lkh_list[0]->user->nip }}</td>
		</tr>
	</table><br>

</body>
</html>