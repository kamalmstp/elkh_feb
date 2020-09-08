@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('content')
	<a href="{{ route('lkh_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-list"></i> Detail LKH  		
	</h2>
	<h4>
		<i class="icon-calendar"></i> Hari/Tanggal: {{ $dayList[$hari] }} {{ $tanggal }}
		&ensp;&emsp;
		
		<button data-toggle="modal" data-target="#inputModal" class="btn btn-primary ">
			<i class="icon-plus"></i>  Tambah Kegiatan Baru
		</button>
		@include('lkh.detail_input')
		
		<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default" title="LKH PDF">
			<i class="icon-file"></i>  Download PDF
		</button>
		@include('lkh.rekap1')
	</h4>

	@if(Session::has('sukses'))
	  <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	@endif

	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Uraian Kegiatan</th>
		            <th>Waktu</th>
		            <th>Keterangan</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($kegiatan_list as $kegiatan)
				    <?php $no++; ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $kegiatan->kegiatan }}</td>
			            <td>{{ $kegiatan->waktua }} - {{ $kegiatan->waktub }}</td>
			            <td>{{ $kegiatan->keterangan }}</td>
			            <td class="btn-group">    		            			
	            			<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-info btn-small" title="Edit LKH">
	            				<i class="icon-edit"></i> Edit
							</button>
							@include('lkh.detail_edit')
	            	
	            			<form method="POST" action="{{ route('lkh_detaildelete', $kegiatan->id) }}">
		                    	<input name="_method" type="hidden" value="DELETE">
		                      	<input name="_token" type="hidden" value="{{ csrf_token() }}">
		                      	<button type="submit" class="btn btn-small btn-danger "  title="Hapus LKH" onclick="return confirm('Anda yakin akan menghapus data kegiatan?')">
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
   <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>  
 
@stop
