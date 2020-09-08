<!DOCTYPE html>
<html>
<head>
	<title>PDF Realisasi SKP</title>
	<style type="text/css">
		body{
			font-family: Arial Narrow;
			font-size: 8px;
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
		PENILAIAN CAPAIAN SASARAN KERJA <br>
		PEGAWAI NEGERI SIPIL	
	</h3> 

	<p>
		Jangka Waktu Penilaian {{$tgl_start}} {{ $blnList[$bln_start] }} s.d. {{$tgl_end}} {{ $blnList[$bln_end] }} {{$thn_end}}
	</p>
	
	<table border="1" cellspacing="0" class="lebar border">
		<thead>
			<tr>
				<th rowspan="2">NO.</th>
				<th rowspan="2" >III. KEGIATAN TUGAS JABATAN</th>
				<th rowspan="2">AK</th>
				<th colspan="6" class="center">TARGET</th>
				<th rowspan="2">AK</th>
				<th colspan="6" class="center">REALISASI</th>
				<th rowspan="2">PERHITUNGAN</th>
				<th rowspan="2">NILAI CAPAIAN SKP</th>
			</tr>
			<tr class="center">
				<th colspan="2">KUANT/OUTPUT</th>
				<th>KUAL/MUTU</th>
				<th colspan="2">WAKTU</th>
				<th>BIAYA</th>
				<th colspan="2">KUANT/OUTPUT</th>
				<th>KUAL/MUTU</th>
				<th colspan="2">WAKTU</th>
				<th>BIAYA</th>
				
			</tr>
		</thead>
		<tbody>
			<?php $no = 0; ?>
		    @foreach($tgt_list as $tgt)
			    <?php $no++; ?>	
				<tr>
					<td class="center">{{$no}}</td>
					<td >{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>
					<td class="center">{{ $tgt->ak }}</td>
					<td class="center">{{ $tgt->kuantitas }}</td>
					<td class="center">{{ $tgt->output->nama }}</td>
					<td class="center">{{ $tgt->mutu }}</td>
					<td class="center">{{ $tgt->waktu }}</td>
					<td class="center">{{ $tgt->swaktu->nama }}</td>
					<td class="center">{{ $tgt->biaya}}</td>
					<td class="center">{{ $tgt->r_ak }}</td>
					<td class="center">{{ $tgt->r_kuantitas }}</td>
					<td class="center">{{ $tgt->output->nama }}</td>
					<td class="center">{{ $tgt->r_mutu }}</td>
					<td class="center">{{ $tgt->r_waktu }}</td>
					<td class="center">{{ $tgt->swaktu->nama }}</td>
					<td class="center">{{ $tgt->r_biaya }}</td>	
					<td class="center">{{ $tgt->perhitungan }}</td>	
					<td class="kanan">
						{{number_format((float)$tgt->capaian, 2, '.', '')}}
					</td>	
				</tr>
			@endforeach
			<tr>
				<th></th>
				<th style="text-align: left;">II. TUGAS TAMBAHAN DAN KREATIVITAS/UNSUR PENUNJANG :</th>
				<th></th>
				<th colspan="6"></th>
				<th></th>
				<th colspan="6"></th>
				<th></th>
				<th></th>
			</tr>
			<tr>
				<td></td><td></td><td></td>
				<td colspan="6"></td><td></td>
				<td colspan="6"></td><td></td>
				<td rowspan="{{ count($tambahan_list)+1 }}" class="center">
					{{ $n_tambahan }}
				</td>
			</tr>
			<?php $no2 = 0; ?>
		    @foreach($tambahan_list as $tambahan)
			    <?php $no2++; ?>	
				<tr>
					<td class="center">{{$no2}}</td>
					<td>{{ $tambahan->tugas }}</td>
					<td></td>
					<td colspan="6"></td>
					<td></td>
					<td colspan="6"></td>
					<td></td>
				</tr>				
			@endforeach	

			<tr>
				<td></td><td></td><td></td>
				<td colspan="6">&nbsp;</td><td></td>
				<td colspan="6"></td><td></td>
				<td ></td>
			</tr>
			<tr>
				<td rowspan="2" colspan="17" class="center">Nilai Capaian SKP</td>
				<td class="kanan">{{number_format((float)$nilai_capaian, 2, '.', '')}}</td>
			</tr>
			<tr>
				<td class="center">({{ $kat }})</td>
			</tr>
		</tbody>
	</table><br>	

	<table class="ttd" style="float: right; margin-right: 5em; page-break-inside: avoid;">
		<tr>
			<td>Banjarmasin,  {{$tgl_ttd}} {{ $blnList[$bln_ttd] }} {{$thn_ttd}}</td>
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


</body>
</html>