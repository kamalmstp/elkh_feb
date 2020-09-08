@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('realisasi_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	
	<h2>
		<i class="icon-briefcase"></i> Tugas Tambahan dan Kreativitas / Unsur Penunjang 		
		&ensp;&emsp;
		<button data-toggle="modal" data-target="#inputModal" class="btn btn-primary">
			<i class="icon-plus"></i>  Tambah Tugas Baru
		</button>
		@include('skp.tambahan_add')	
	</h2>
	<h3>
		<i class="icon-calendar"></i> SKP {{ $skp->tahun->tahun }} Jangka Waktu {{ $jangka->jangka }}
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

	<div class="table-responsive">
		<table class="table table-bordered table-small" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Tugas Tambahan dan Kreativitas / Unsur Penunjang</th>
		            <th>Opsi</th>		            
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
			            <td class="btn-group" >
			            	<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-info" title="Edit Tugas Tambahan"><i class="icon-edit"></i> Edit
							</button>
							@include('skp.tambahan_edit')
							<form method="POST" action="{{ route('tambahan_delete', $tambahan->id) }}">
		                    	<input name="_method" type="hidden" value="DELETE">
		                      	<input name="_token" type="hidden" value="{{ csrf_token() }}">
		                      	<button type="submit" class="btn btn-danger "  title="Hapus data satuan" onclick="return confirm('Anda yakin akan menghapus data Tugas Tambahan?')">
		                          	<i class="icon-trash"></i> Hapus
		                      	</button>
		                    </form> 
			            </td>
			        </tr>
		        @endforeach	        
		    </tbody>
		    @else
		    <tbody>
		    	<tr><td colspan="3" style="text-align: center;">
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
