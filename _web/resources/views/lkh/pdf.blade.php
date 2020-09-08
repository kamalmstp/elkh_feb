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

	<h3 class="center">LAPORAN KERJA HARIAN</h3> <br>	
	
	<table border="0">
		<tr>
			<td>NAMA</td>
			<td>:</td>
			<td>{{ $lkh->user->name }}</td>
		</tr>
		<tr>
			<td>NIP / NIPK</td>
			<td>:</td>
			<td>{{ $lkh->user->nip }}</td>
		</tr>
		<tr>
			<td>JABATAN</td>
			<td>:</td>
			<td>{{ $lkh->user->jabatan }}</td>
		</tr>
		<tr>
			<td>HARI / TANGGAL</td>
			<td>:</td>
			<td>{{ $dayList[$hari] }} / {{ $tanggal }}</td>
		</tr>
	</table><br>

	<table border="1" cellspacing="0" class="lebar border">
		<thead>
			<tr>
				<td rowspan="2">No.</td>
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
			<?php $no = 0; ?>
		    @foreach($kegiatan_list as $kegiatan)
			    <?php $no++; ?>
		        <tr>
		        	<td class="center">{{ $no }}</td>
		            <td>{{ $kegiatan->kegiatan }}</td>
		            <td class="center">{{ $kegiatan->waktua }}</td>
	            	<td class="center">{{ $kegiatan->waktub }}</td>
		            <td class="center">{{ $kegiatan->keterangan }}</td>
		        </tr>
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
			<td>{{ $lkh->user->atasan->name }}</td>
		</tr>
		<tr>
			<td>NIP. {{ $lkh->user->atasan->nip }}</td>
		</tr>
	</table>
	

	<table border="0" style="float: right; margin-right: 5em; page-break-inside: avoid;">
		<tr>
			<td>Banjarmasin, {{$tgl_ttd}} {{ $blnList[$bln_ttd] }} {{$thn_ttd}}</td>			
		</tr>
		<tr>
			<td>{{ $lkh->user->jabatan }}</td>
		</tr>
		<tr >
			<td style="line-height: 6em;" class="putih">A</td>
		</tr>
		<tr>
			<td>{{ $lkh->user->name }} </td>
		</tr>
		<tr>
			<td>NIP. {{ $lkh->user->nip }}</td>
		</tr>
	</table><br>

</body>
</html>