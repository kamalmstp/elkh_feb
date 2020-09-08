<!DOCTYPE html>
<html>
<head>
	<title>PDF Target SKP</title>
	<style type="text/css">
		body{
			font-family: Arial Narrow, Arial;
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
	</style>
</head>
<body>

	<h3 class="center">
		FORMULIR SASARAN KERJA <br>
		PEGAWAI NEGERI SIPIL	
	</h3> 
	
	<table border="1" cellspacing="0" class="lebar border">
		<thead>
			<tr>
				<th>NO.</th>
				<th colspan="2">I. PEJABAT PENILAI</th>
				<th>NO.</th>
				<th colspan="6">II. PEGAWAI NEGERI SIPIL YANG DINILAI</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="center">1<br> 2<br>3<br>4<br>5</td>
				<td>Nama <br> NIP <br> Pangkat/Gol.Ruang <br> Jabatan <br> Unit Kerja</td>
				<td>
					{{ $skp->user->atasan->name }} <br>
					{{ $skp->user->atasan->nip }}	<br>
					{{ $skp->user->atasan->pangkat->pangkat }}	/ {{ $skp->user->atasan->pangkat->golongan }} <br>
					{{ $skp->user->atasan->jabatan }} <br>
					Fakultas Ekonomi dan Bisnis Unlam <br>
				</td>
				<td class="center">1<br>2<br>3<br>4<br>5</td>
				<td colspan="2">Nama <br> NIP <br> Pangkat/Gol.Ruang <br> Jabatan <br> Unit Kerja</td>
				<td colspan="4">
					{{ $skp->user->name }} <br>
					{{ $skp->user->nip }} <br>
					{{ $skp->user->pangkat->pangkat }} / {{ $skp->user->pangkat->golongan }}  	 <br>
					{{ $skp->user->jabatan }}  <br>
					Fakultas Ekonomi dan Bisnis Unlam <br>
				</td>
			</tr>
			<tr class="center">
				<th rowspan="2">NO.</th>
				<th rowspan="2" colspan="2">III. KEGIATAN TUGAS JABATAN</th>
				<th rowspan="2">AK</th>
				<th colspan="6" class="center">TARGET</th>
			</tr>
			<tr class="center">
				<th colspan="2">KUANT/OUTPUT</th>
				<th>KUAL/MUTU</th>
				<th colspan="2">WAKTU</th>
				<th>BIAYA</th>
			</tr>

			<?php $no = 0; ?>
		    @foreach($tgt_list as $tgt)
			    <?php $no++; ?>	
				<tr>
					<td class="center">{{$no}}</td>
					<td colspan="2">{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>
					<td class="center">{{ $tgt->ak }}</td>
					<td class="center">{{ $tgt->kuantitas }}</td>
					<td class="center">{{ $tgt->output->nama }}</td>
					<td class="center">{{ $tgt->mutu }}</td>
					<td class="center">{{ $tgt->waktu }}</td>
					<td class="center">{{ $tgt->swaktu->nama }}</td>
					<td class="center">{{ $tgt->biaya}}</td>	
				</tr>
			@endforeach
		</tbody>
	</table><br>	

	<table class="ttd" style="float: left; margin-left: 5em;">
		<tr>
			<td class="putih">A</td>
		</tr>
		<tr>
			<td>Pejabat Penilai,</td>
		</tr>
		<tr>
			<td style="line-height: 6em;" class="putih">A</td>
		</tr>
		<tr>
			<td>{{ $skp->user->atasan->name }}</td>
		</tr>
		<tr>
			<td>NIP. {{ $skp->user->atasan->nip }}</td>
		</tr>
	</table>	

	<table border="0" style="float: right; margin-right: 5em; page-break-inside: avoid;">
		<tr>
			<td>Banjarmasin, {{$tgl_ttd}} {{ $blnList[$bln_ttd] }} {{$thn_ttd}}</td>			
		</tr>
		<tr>
			<td>Pegawai Negeri Sipil Yang Dinilai</td>
		</tr>
		<tr >
			<td style="line-height: 6em;" class="putih">A</td>
		</tr>
		<tr>
			<td>{{ $skp->user->name }} </td>
		</tr>
		<tr>
			<td>NIP. {{ $skp->user->nip }}</td>
		</tr>
	</table><br>

</body>
</html>