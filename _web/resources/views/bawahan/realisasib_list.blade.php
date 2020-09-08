@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('realisasib_jangka', $skp->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-tasks"></i> 
		Realisasi SKP {{ $skp->tahun->tahun }} Jangka Waktu {{ $jangka->jangka }}

		<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default">
			<i class="icon-file"></i> Download PDF
		</button>
		@include('skp.realisasi_pdf_tgl')
	</h2>
	<h3>
		<i class="icon-user"></i>
		{{$skp->user->name}} - {{$skp->user->jabatan}}
	</h3>	
	<hr>

	@if(Session::has('sukses'))
	  <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	@endif

	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	@if($skp->user->atasan->id == Auth::user()->id)
	@if($tgt_list[0]->waktu_id != 0)
	<form action="{{ route('realisasib_status', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}		    				    	
		<input type="hidden" name="_method" value="PATCH">	
		@if($tgt_list[0]->status == 1)
			<input type="hidden" name="status" value="0">
			<button type="submit" class="btn btn-primary" style="margin-bottom: 1em;" title="Tutup penilaian untuk bawahan?">
				<i class="icon-key"></i> Pengeditan Nilai Mutu dibuka
			</button>
		@else
			<input type="hidden" name="status" value="1">
			<button type="submit" class="btn btn-warning" style="margin-bottom: 1em;" title="Buka penilaian untuk bawahan?">
				<i class="icon-key"></i> Pengeditan Nilai Mutu ditutup
			</button>
		@endif
	</form>
	@endif
	@endif

	<div class="table-responsive">
		<form action="{{ route('realisasi_update', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}		    				    	
			<input type="hidden" name="_method" value="PATCH">
		<table class="table table-bordered table-small">
		    <thead>
		        <tr>
		        	<th rowspan="2">No.</th>
		            <th rowspan="2">Kegiatan</th>		            
		            <th colspan="7">Target</th>
		            <th colspan="7">Realisasi</th>
		            <th rowspan="2">Perhitungan</th>
		            <th rowspan="2">Nilai SKP</th>		            
		        </tr>
		        <tr>
		            <th>AK</th>
		            <th colspan="2" class="sorting" tabindex="0" aria-controls="dataTable">Kuantitas</th>
		            <th>Mutu</th>
		            <th colspan="2" class="sorting" tabindex="0" aria-controls="dataTable">Waktu</th>
		            <th>Biaya</th>
		            <th>AK</th>
		            <th colspan="2" class="sorting" tabindex="0" aria-controls="dataTable">Kuantitas</th>
		            <th>Mutu</th>
		            <th colspan="2" class="sorting" tabindex="0" aria-controls="dataTable">Waktu</th>
		            <th>Biaya</th>
		        </tr>
		    </thead>		    
		    <tbody>
		    	@if($tgt_list[0]->waktu_id != 0)
			    	<?php $no = 1; ?>
				    @foreach($tgt_list as $tgt)
				        <tr>
				        	<td>{{ $no++ }}</td>
				            <td>{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>  
				            <td>{{ $tgt->ak }}</td>
				            <td>{{ $tgt->kuantitas }}</td>
				            <td>{{ $tgt->output->nama }}</td>
				            <td>{{ $tgt->mutu }}</td>
				            <td>{{ $tgt->waktu }}</td>
				            <td>{{ $tgt->swaktu->nama }}</td>
				            <td>{{ $tgt->biaya }}</td>
				            <td>{{ $tgt->r_ak }}</td>
				            <td>{{ $tgt->r_kuantitas }}</td>
				            <td>{{ $tgt->output->nama }}</td>
				            <td>
				            	<input type="text" class="span1" name="r_mutu[]" value="{{ $tgt->r_mutu }}" oninput="angka(this);" required>	
			            	</td>
				            <td>{{ $tgt->r_waktu }}</td>
				            <td>{{ $tgt->swaktu->nama }}</td>
				            <td>{{ $tgt->r_biaya }}	</td>			            
				            <td>{{ $tgt->perhitungan }}</td>
				            <td>{{ $tgt->capaian }}</td>
				        </tr>
				        <input type="hidden" name="r_ak[]" value="{{ $tgt->ak }}">	   			
				        <input type="hidden" name="r_kuantitas[]" value="{{ $tgt->r_kuantitas }}">
	   					<input type="hidden" name="r_waktu[]" value="{{ $tgt->r_waktu }}">	
	   							
	   					<input type="hidden" name="r_biaya[]" value="{{ $tgt->r_biaya }}">
	   					<input type="hidden" name="t_kuantitas[]" value="{{ $tgt->kuantitas }}">
				        <input type="hidden" name="t_mutu[]" value="{{ $tgt->mutu }}">
				        <input type="hidden" name="t_waktu[]" value="{{ $tgt->waktu }}">
				        <input type="hidden" name="t_biaya[]" value="{{ $tgt->biaya }}">
	   					<input type="hidden" name="target_id[]" value="{{$tgt->id}}">
			        @endforeach	        
			        </tbody>
				    <tfoot>
				    	<tr>
				    		<td colspan="18" style="text-align: center;">		    			
				    			<button type="submit" class=" btn btn-primary">
				    				<i class="icon-save"></i> Simpan
				    			</button>						
				    		</td>
				    	</tr>
				    </tfoot>
			    @else
			    	<tr>
			    		<td style="text-align: center;" colspan="18">
			    			<h3>Tidak ada data yang ditampilkan</h3>
			    		</td>
			    	</tr>
			    </tbody>
			    @endif		    
		    </form>	
		</table>		
	</div>
	<hr>

	<h2>
		<i class="icon-briefcase"></i> Tugas Tambahan dan Kreativitas / Unsur Penunjang 				
	</h2><br>

	<div class="table-responsive">
		<table class="table table-bordered table-small" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Tugas Tambahan dan Kreativitas / Unsur Penunjang</th>		
		        </tr>
		    </thead>
		    @if(count($tambahan_list) > 0)
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($tambahan_list as $tambahan)
				    <?php 
				    	$no++;				    	
				     ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $tambahan->tugas }}</td>			            
			        </tr>
		        @endforeach	        
		    </tbody>
		    @else
		    <tbody>
		    	<tr><td colspan="2" style="text-align: center;">
		    		<h3>Data Tugas Tambahan belum ditambahkan.</h3>
		    	</td></tr>
		    </tbody>
		    @endif
		</table>
	</div>

@stop

@section('js')
 	@parent	
@stop
