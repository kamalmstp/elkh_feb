@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('content')
	<a href="{{ route('lkhb_list', $lkh->user->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-list"></i> Detail LKH  		
	</h2>
	<h3>
		<i class="icon-user"></i>
		{{$user->name}} - {{$user->jabatan}}
	</h3>
	<h4>
		<i class="icon-calendar"></i> Hari/Tanggal: {{ $dayList[$hari] }} {{ $tanggal }}
		&ensp;&emsp;		
		
		<button data-toggle="modal" data-target="#pdfModal" class="btn btn-default" title="LKH PDF">
			<i class="icon-file"></i>  Download PDF
		</button>
		@include('lkh.rekap1')
	</h4>

	<div class="table-responsive">
		<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Uraian Kegiatan</th>
		            <th>Waktu</th>
		            <th>Keterangan</th>		            
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
