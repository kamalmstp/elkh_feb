@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('realisasi_jangka', $skp->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-tasks"></i> 
		Realisasi SKP {{ $skp->tahun->tahun }} Jangka Waktu {{ $jangka->jangka }}

		<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default">
			<i class="icon-file"></i> Download PDF
		</button>
		@include('skp.realisasi_pdf_tgl')
	</h2>	
	<hr>

	@if(Session::has('sukses'))
	  <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	@endif

	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	@if($tgt_list[0]->status == 0)
		<div class="alert alert-info" role="alert">
			Saat ini Anda tidak bisa mengedit kolom Mutu, silakan menghubungi atasan langsung untuk membuka. 
		</div>
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
		    @if($status == 'yes') 	
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($tgt_list as $tgt)
				    <?php $no++; ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>		            
			            <td>{{ $tgt->ak }}</td>
			            <td>{{ $tgt->kuantitas }}</td>
			            <td>{{ $tgt->output->nama }}</td>
			            <td>{{ $tgt->mutu }}</td>
			            <td>{{ $tgt->waktu }}</td>
			            <td>{{ $tgt->swaktu->nama }}</td>
			            <td>{{ $tgt->biaya }}</td>

			            <td>
			            	<input type="text" class="span1" name="r_ak[]" 
			            	value="{{ $tgt->r_ak }}" oninput="angka(this);">
			            </td>
			            <td>
			            	<input type="text" class="span1" name="r_kuantitas[]" 
			            	value="{{ $tgt->r_kuantitas }}" oninput="angka(this);" required>
			            </td>
			            <td>
			            	<input type="text" class="span1" value="{{ $tgt->output->nama }}" disabled>
			            </td>
			             <td>
			             	@if($tgt->status == 1)
			            		<input type="text" class="span1" name="r_mutu[]" value="{{ $tgt->r_mutu }}" oninput="angka(this);" required>	
			            	@else
			            		<input value="{{ $tgt->r_mutu }}" class="span1" disabled>
			            		<input type="hidden" name="r_mutu[]" value="{{ $tgt->r_mutu }}">
			            	@endif
			            </td>
			            <td>
			            	<input type="text" class="span1" name="r_waktu[]" 
			            	value="{{ $tgt->r_waktu }}" oninput="angka(this);" required>				     
			            </td>
			            <td>
			            	<input type="text" class="span1" value="{{ $tgt->swaktu->nama }}" disabled>			            	
			            </td>
			            <td>
			            	<input type="text" class="span1" name="r_biaya[]" 
			            	value="{{ $tgt->r_biaya }}" oninput="angka(this);">	
			            </td>			            
			            <td>
			            	{{ $tgt->perhitungan }}
			            </td>
			            <td>
			            	{{ $tgt->capaian }}
			            </td>
			        </tr>
			        <input type="hidden" name="target_id[]" value="{{$tgt->id}}">
			        <input type="hidden" name="t_kuantitas[]" value="{{ $tgt->kuantitas }}">
			        <input type="hidden" name="t_mutu[]" value="{{ $tgt->mutu }}">
			        <input type="hidden" name="t_waktu[]" value="{{ $tgt->waktu }}">
			        <input type="hidden" name="t_biaya[]" value="{{ $tgt->biaya }}">
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
		    		@foreach($tgt_2 as $key => $tgt)
		    			<?php
		    				$kuantitas 	= $tgt->r_kuantitas + $tgt_3[$key]->r_kuantitas;
	   						$waktu 		= $tgt->r_waktu + $tgt_3[$key]->r_waktu;
		    			?>		    			
	   					<input type="hidden" name="r_kuantitas[]" value="{{ $kuantitas }}">
	   					<input type="hidden" name="r_waktu[]" value="{{ $waktu }}">	
	   					<input type="hidden" name="r_ak[]" value="">	   					
	   					<input type="hidden" name="r_mutu[]" value="">	   					
	   					<input type="hidden" name="r_biaya[]" value="">
	   					<input type="hidden" name="t_kuantitas[]" value="{{ $tgt_list[$key]->kuantitas }}">
				        <input type="hidden" name="t_mutu[]" value="{{ $tgt_list[$key]->mutu }}">
				        <input type="hidden" name="t_waktu[]" value="{{ $tgt_list[$key]->waktu }}">
				        <input type="hidden" name="t_biaya[]" value="{{ $tgt_list[$key]->biaya }}">
	   					<input type="hidden" name="target_id[]" value="{{$tgt_list[$key]->id}}">	
		    		@endforeach
		    		<td colspan="18" style="text-align: center;">		    			
		    			<button type="submit" class=" btn btn-primary">
		    				<i class="icon-refresh"></i>&nbsp; Refresh dan Tampilkan Data
		    			</button>						
		    		</td>
		    	</tr>
			@endif

		    </form>	
		</table>		
	</div>
	<hr>

	<h2>
		<i class="icon-briefcase"></i> Tugas Tambahan dan Kreativitas / Unsur Penunjang 		
		&ensp;&emsp;
		@if($jangka->id != 1)
			<a href="{{ route('tambahan_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-primary">
				<i class="icon-wrench"></i>  Kelola Tugas Tambahan 
			</a>		
		@endif
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
 	<script type="text/javascript">
 		function angka(that){
 			that.value = that.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
 		}
 	</script>	
@stop
