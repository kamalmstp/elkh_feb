@extends('_layout.base')

@section('css')
    @parent
    
@stop

@section('content')
	<h2>
		<i class="icon-table"></i> Manajemen Sasaran Kerja Pegawai (SKP)
		&ensp;&emsp;
		<button data-toggle="modal" data-target="#inputModal" class="btn btn-primary">
			<i class="icon-plus"></i>  Tambah SKP Baru
		</button>
		@include('skp.add')		
		<a class="btn btn-default" href="{{ route('kegiatan_list') }}">
			<i class="icon-gear"></i>  Kegiatan SKP
		</a>
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

	<div class="table-responsive">
		<table class="table table-bordered table-small" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Tahun</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($skp_list as $skp)
				    <?php 
				    	$no++;				    	
				     ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $skp->tahun->tahun }}</td>
			            <td class="btn-group">
	            			<a href="{{ route('skpkegiatan_list', $skp->id) }}" class="btn btn-success " title="Lihat/Tambah Target Kegiatan SKP"><i class=" icon-screenshot"></i> Target</a>

	            			<a href="{{ route('realisasi_jangka', $skp->id) }}" class="btn btn-warning" title="Lihat/Input Realisasi & Penilaian SKP"><i class=" icon-tasks"></i> Realisasi & Penilaian Kerja</a>

	            			<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-info" title="Edit SKP"><i class="icon-edit"></i> Edit
							</button>
							@include('skp.edit')

	            			<form method="POST" action="{{ route('skp_delete', $skp->id) }}">
		                    	<input name="_method" type="hidden" value="DELETE">
		                      	<input name="_token" type="hidden" value="{{ csrf_token() }}">
		                      	<button type="submit" class="btn btn-danger "  title="Hapus data satuan" onclick="return confirm('Anda yakin akan menghapus data SKP?')">
		                          	<i class="icon-trash"></i> Hapus
		                      	</button>
		                    </form>    		
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
