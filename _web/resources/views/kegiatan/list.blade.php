@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('content')
	<a href="{{ route('skp_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>

	<h2>
		<i class="icon-table"></i> Manajemen Kegiatan SKP
		&ensp;&emsp;
		<button data-toggle="modal" data-target="#inputModal" class="btn btn-primary">
			<i class="icon-plus"></i>  Tambah Kegiatan  Baru
		</button>
		@include('kegiatan.add')
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
		<table class="table table-bordered table-small" id="dataTable" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Kegiatan</th>		            
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($keg_list as $keg)
				    <?php 
				    	$no++;				    	
				     ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $keg->kegiatan }}</td>			            
			            <td>
			            	<table border="0">
			            	<tr>			            		
			            		<td>		            			
			            			<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-info btn-small" title="Edit Pangkat"><i class="icon-edit"></i>
									</button>
									@include('kegiatan.edit')
			            		</td>
			            		<td>
			            			<form method="POST" action="{{ route('kegiatan_delete', $keg->id) }}">
				                    	<input name="_method" type="hidden" value="DELETE">
				                      	<input name="_token" type="hidden" value="{{ csrf_token() }}">
				                      	<button type="submit" class="btn btn-small btn-danger "  title="Hapus data pangkat" onclick="return confirm('Anda yakin akan menghapus data kegiatan?')">
				                          	<i class="icon-trash"></i>
				                      	</button>
				                    </form>    		
			            		</td>
			            	</tr>
			            	</table>		            		
			            </td>	            
			        </tr>
		        @endforeach	        
		    </tbody>
		</table>
	</div>


@stop

@section('js')
 	@parent
	<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
	<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
	<script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>    
@stop
