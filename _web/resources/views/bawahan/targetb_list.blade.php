@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('targetb_jangka', $skp->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-screenshot"></i> 
		Target SKP {{ $skp->tahun->tahun }} Jangka Waktu {{ $jangka->jangka }}

		<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default">
			<i class="icon-file"></i> Download PDF
		</button>
		@include('skp.target_pdf_tgl')
	</h2>	
	<h3>
		<i class="icon-user"></i>
		{{$skp->user->name}} - {{$skp->user->jabatan}}
	</h3>
	<hr>

	@if(Session::has('sukses'))
	  <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	@endif
	
	@if(Session::has('gagal'))
	  <div class="alert alert-danger" role="alert">{{ Session::get('gagal') }}</div>
	@endif

	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	@if($jangka->id == 3)	
		<div class="alert alert-info" role="alert">
			Untuk Target SKP Semester 2, Nilai Kuantitas dan Waktu otomatis didapat dari Nilai Target 1 Tahun dikurang Nilai Realisasi Semester 1.
		</div>	    
	@endif
	
	<div class="table-responsive" style="overflow-x: auto;">		
		<table class="table table-bordered table-small">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Kegiatan</th>
		            <th>AK</th>
		            <th colspan="2" class="sorting" tabindex="0" aria-controls="dataTable">Kuantitas</th>
		            <th>Mutu</th>
		            <th colspan="2" class="sorting" tabindex="0" aria-controls="dataTable">Waktu</th>
		            <th>Biaya</th>		            
		        </tr>
		    </thead>
		    
		    <tbody>		    	
				<?php $no = 0; ?>
				@foreach($tgt_list as $key => $tgt)
				    <?php $no++; ?>
				    <tr>
				    	<td>{{ $no }}</td>
				        <td>{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>
				        <td>
				        	<input type="number" class="span1" value="{{$tgt->ak}}" disabled>
				        </td>
				        <td>
				        	<input type="number" class="span1" value="{{ $tgt->kuantitas }}" disabled>
				        </td>
				        <td>
				        	<input type="text" class="span1" value="{{ $tgt->output->nama }}" disabled>			
				        </td>
				        <td>
				        	<input type="number" class="span1" value="{{ $tgt->mutu }}" disabled>	
				        </td>
				        <td>
				        	<input type="number" class="span1" value="{{ $tgt->waktu }}" disabled>
				        </td>
				        <td>
				        	<input type="text" class="span1" value="{{ $tgt->swaktu->nama }}" disabled>	
				        </td>
				        <td>
				        	<input type="number" class="span1" value="{{ $tgt->biaya }}" disabled>
				        </td>			                       
				    </tr>        				    
				@endforeach	        			    
			</tbody>		    
		</table>
	</div>	

@stop

@section('js')
 	@parent	
@stop
