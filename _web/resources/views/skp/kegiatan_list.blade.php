@extends('_layout.base')

@section('css')
    @parent   
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet"> 
@stop

@section('content')
	<a href="{{ route('skp_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-table"></i> Kegiatan SKP Tahun {{ $skp->tahun->tahun }}
		&ensp;&emsp;
		
	</h2>
	<br>

	@if( count($skpkeg_list) > 0 )		
		@foreach($jangka_list as $jangka)
			<a href="{{ route('target_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-warning" title="Lihat/Input Target" style="font-weight: bold;">
				Target {{$jangka->jangka}}
			</a>
		@endforeach			
	@endif
	
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

	<button data-toggle="modal" data-target="#inputModal" class="btn btn-primary">
		<i class="icon-plus"></i>  Tambah Kegiatan Baru
	</button>
	@include('skp.kegiatan_add')
	<br><br>
	
	<div class="table-responsive">
		<table class="table table-bordered table-small" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Kegiatan</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	@if(count($skpkeg_list) > 0)
			    	<?php $no = 1; ?>
				    @foreach($skpkeg_list as $skpkeg)
				        <tr>
				        	<td>{{ $no++ }}</td>
				            <td>{{ $skpkeg->kegiatan->kegiatan }}</td>
				            <td class="btn-group" style="width: 15%;">
		            			<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-info" title="Edit Kegiatan SKP"><i class="icon-edit"></i>
								</button>
								@include('skp.kegiatan_edit')

		            			<form method="POST" action="{{ route('skpkegiatan_delete', $skpkeg->id) }}">
			                    	<input name="_method" type="hidden" value="DELETE">
			                      	<input name="_token" type="hidden" value="{{ csrf_token() }}">
			                      	<button type="submit" class="btn btn-danger "  title="Hapus data satuan" onclick="return confirm('Anda yakin akan menghapus data kegiatan SKP?')">
			                          	<i class="icon-trash"></i>
			                      	</button>
			                    </form>    		
				            </td>	            
				        </tr>
			        @endforeach	        
			    @else
			    	<tr>
			    		<td style="text-align: center;" colspan="3">
			    			<h3>Tidak ada data yang ditampilkan</h3>
			    		</td>
			    	</tr>
			    @endif
		    </tbody>
		</table>
	</div>


@stop

@section('js')
 	@parent	
 	<script src="{{ asset('js/select2.min.js') }}"></script> 
	<script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-placeholder-single').select2({
	    	placeholder: "Pilih Kegiatan",
	    	allowClear: true
	    });
	});
	</script>
@stop
