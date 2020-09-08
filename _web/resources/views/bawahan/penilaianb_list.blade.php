@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('realisasib_jangka', $skp->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	
	<h2>
		<i class="icon-star"></i> Penilaian Perilaku Kerja 				
	</h2>
	<h3>
		<i class="icon-calendar"></i> Tahun {{ $skp->tahun->tahun }} Jangka Waktu {{ $jangka->jangka }}
	</h3>
	<h3>
		<i class="icon-user"></i>
		{{$skp->user->name}} - {{$skp->user->jabatan}}
		&ensp;&emsp;
		@if(count($penilaian_list) != 0)
			<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default">
				<i class="icon-file"></i> Download PDF
			</button>
			@include('skp.penilaian_pdf_tgl')
		@endif
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


	@if($skp->user->atasan->id == Auth::user()->id)
	@if(count($penilaian_list) != 0)
	<form action="{{ route('penilaianb_status', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}		    				    	
		<input type="hidden" name="_method" value="PATCH">	
		@if($penilaian_list[0]->status == 1)
			<input type="hidden" name="status" value="0">
			<button type="submit" class="btn btn-primary" style="margin-bottom: 1em;" title="Tutup penilaian untuk bawahan?">
				<i class="icon-key"></i> Penilaian dibuka
			</button>
		@else
			<input type="hidden" name="status" value="1">
			<button type="submit" class="btn btn-warning" style="margin-bottom: 1em;" title="Buka penilaian untuk bawahan?">
				<i class="icon-key"></i> Penilaian ditutup
			</button>
		@endif
	</form>
	@endif
	@endif

	<table border="1" cellpadding="5" width="45%" style="float: left;">
	    <thead>
	        <tr>
	        	<th>Perilaku Kerja</th>
	            <th>Nilai Angka</th>
	            <th>Kategori</th>
	        </tr>
	    </thead>
	    @if(count($penilaian_list) != 0)
	    <tbody>
	    	<form action="{{ route('penilaian_update', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST" enctype="multipart/form-data">
			{{ csrf_field() }}		    				    	
			<input type="hidden" name="_method" value="PATCH">
			<input type="hidden" name="form" value="penilaian">
	    	@foreach($penilaian_list as $penilaian)
	    	<tr>
	    		<td>{{ $penilaian->perilaku->nama }}</td>
	    		<td style="text-align: center;">	    			
	    			<input type="text" class="span1" name="nilai[]" value="{{$penilaian->nilai}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" 
	    			@if($skp->user->atasan->id != Auth::user()->id)
	    				disabled
	    			@endif
	    			/>
	    			<input type="hidden" name="penilaian_id[]" value="{{$penilaian->id}}">
	    		</td>
	    		<td>
	    			{{ $penilaian->kategori->nama }}
	    		</td>
	    	</tr>
	    	@endforeach
	    </tbody>
	    <tfoot>
	    	<tr>
	    		<td colspan="3" style="text-align: center;">
	    				<button type="submit" class=" btn btn-primary"
	    					@if($skp->user->atasan->id != Auth::user()->id)
			    				disabled
			    			@endif>
							<i class="icon-save"></i> Simpan
						</button>	    					    		
					</form>		
					<form></form>
					@else						
	    				<tfoot>
	    				<tr><td colspan="3" style="text-align: center;">
		    			<button class="btn btn-primary" onclick="window.location.reload()"
		    				@if($skp->user->atasan->id != Auth::user()->id)
			    				disabled
			    			@endif>
	    					<i class="icon-refresh"></i> Refresh dan Input Nilai
	    				</button>
					@endif
	    		</td>
	    	</tr>	    	
	    </tfoot>
	</table>

	@if(count($penilaian_list) != 0)
		
		<form action="{{ route('penilaian_update', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST" enctype="multipart/form-data">
				{{ csrf_field() }}		    				    	
				<input type="hidden" name="_method" value="PATCH">
				<input type="hidden" name="form" value="riwayat">
			<div style="float: right;">
				<select class="span2" name="rwtahun_id" required>
					<option value="">-- Tahun --</option>
					@foreach($thn_list as $thn)
						<option value="{{ $thn->id }}">{{$thn->tahun}}</option>
					@endforeach
				</select>
				<select class="span2" name="rwjangka_id" required>
					<option value="">-- Semester --</option>
					@foreach($jangka_list as $jangka)
						<option value="{{ $jangka->id }}">{{$jangka->jangka}}</option>
					@endforeach
				</select>
				<input class="btn btn-primary btn-small" type="submit" value="Tampilkan Riwayat Penilaian">
				
			</div><br><br>
		</form>
		@if($rw_penilaian != '')
		<table border="1" cellpadding="5" width="45%" style="float: right;">
		    <thead>
		    	<tr>
		    		<th colspan="3">
		    			Riwayat Penilaian Tahun {{$rw_skp->tahun->tahun}} 
		    			{{$rw_jangka->jangka}}
		    		</th>
		    	</tr>
		        <tr>
		        	<th>Perilaku Kerja</th>
		            <th>Nilai Angka</th>
		            <th>Kategori</th>
		        </tr>
		    </thead>
		    <tbody>		    	
		    	@if(count($rw_penilaian) == 0)
					<tr>
						<th colspan="3">Tidak ada Riwayat Penilaian</th>
					</tr>
				@else
					@foreach($rw_penilaian as $penilaian2)
			    	<tr>
			    		<td>{{ $penilaian2->perilaku->nama }}</td>
			    		<td style="text-align: center;">
			    			{{$penilaian2->nilai}}
			    		</td>
			    		<td>
			    			{{ $penilaian2->kategori->nama }}
			    		</td>
			    	</tr>
			    	@endforeach
				@endif
		    </tbody>
		</table>
		@endif
	@endif

@stop

@section('js')
 	@parent	
@stop
