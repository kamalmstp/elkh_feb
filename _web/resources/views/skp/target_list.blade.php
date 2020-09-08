@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('skpkegiatan_list', $skp->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-screenshot"></i> 
		Target SKP {{ $skp->tahun->tahun }} Jangka Waktu {{ $jangka->jangka }}

		<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default">
			<i class="icon-file"></i> Download PDF
		</button>
		@include('skp.target_pdf_tgl')
	</h2>	
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
		<form action="{{ route('target_update', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}		    				    	
			<input type="hidden" name="_method" value="PATCH">
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
		    @if($status == 'yes' && $jangka->id == 1)		    
		    <tbody>		    	
		    	<?php $no = 0; ?>
			    @foreach($tgt_list as $tgt)
				    <?php $no++; ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>
			            <td>
			            	<input type="text" class="span1" name="ak[]" 
			            	value="{{ $tgt->ak }}" oninput="angka(this);">
			            </td>
			            <td>
			            	<input type="text" class="span1" name="kuantitas[]" 
			            	value="{{ $tgt->kuantitas }}" oninput="angka(this);" required>
			            </td>
			            <td width="8%">
							<select  name="output_id[]" style="width:100%;" required>
								<option value="">--pilih--</option>
								@foreach($output_list as $output)
									<option value="{{ $output->id }}" @if($tgt->output_id == $output->id) selected @endif>
										{{$output->nama}}
									</option>
								@endforeach
							</select>
			            </td>
			            <td>
			            	<input type="text" class="span1" value="100" disabled>	
			            	<input type="hidden" class="span1" name="mutu[]" 
			            	value="100" >
			            </td>
			            <td>
			            	<input type="text" class="span1" name="waktu[]" 
			            	value="{{ $tgt->waktu }}" oninput="angka(this);" required>	
			            </td>
			            <td width="7%">
			            	<select style="width:100%;" name="waktu_id[]" required>	
			            		<option value="">--pilih--</option>
			            		@foreach($waktu_list as $waktu)
									<option value="{{ $waktu->id }}" @if($tgt->waktu_id == $waktu->id) selected @endif>
										{{$waktu->nama}}
									</option>
								@endforeach
							</select>
			            </td>
			            <td>
			            	<input type="text" class="span1" name="biaya[]" 
			            	value="{{ $tgt->biaya }}" oninput="angka(this);">			
			            </td>			                       
			        </tr>
			        <input type="hidden" name="target_id[]" value="{{$tgt->id}}">
		        @endforeach	        			    
		    </tbody>
		    <tfoot>
		    	<tr>
		    		<td colspan="9" style="text-align: center;">		    			
		    			<button type="submit" class=" btn btn-primary">
		    				<i class="icon-save"></i> Simpan
		    			</button>						
		    		</td>
		    	</tr>
		    </tfoot>
		    @elseif($status == 'yes' && $jangka->id != 1)		    
		    	@include('skp.target_list2')
		    @else		    	
		    	<tr>
		    		@foreach($tgt_1 as $key => $tgt)
		    			@if($jangka->id == 3)
			    			<?php
			    				$h_kuan 	= $tgt->kuantitas - $tgt_2[$key]->r_kuantitas;
			    				if ($h_kuan < 0 ) {
			    					$kuantitas = 0;
			    				}else{
			    					$kuantitas = $h_kuan;
			    				}
		   						$waktu 		= $tgt->waktu - $tgt_2[$key]->r_waktu;
			    			?>		    			
		   					<input type="hidden" name="kuantitas[]" value="{{ $kuantitas }}">
		   					<input type="hidden" name="waktu[]" value="{{ $waktu }}">	
	   					@else
	   						<input type="hidden" name="kuantitas[]" value="">	
	   						<input type="hidden" name="waktu[]" value="">	
	   					@endif	   					
	   					<input type="hidden" name="ak[]" value="">	   					
	   					<input type="hidden" name="output_id[]" value="{{ $tgt->output_id }}">
	   					<input type="hidden" name="mutu[]" value="100">	   					
	   					<input type="hidden" name="waktu_id[]" value="{{ $tgt->waktu_id }}">
	   					<input type="hidden" name="biaya[]" value="">
	   					<input type="hidden" name="target_id[]" value="{{$tgt_list[$key]->id}}">	
		    		@endforeach
		    		<td colspan="9" style="text-align: center;">		    			
		    			<button type="submit" class=" btn btn-primary">
		    				<i class="icon-refresh"></i>&nbsp; Refresh dan Tampilkan Data
		    			</button>						
		    		</td>
		    	</tr>		    
		    @endif
		    </form>	
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
