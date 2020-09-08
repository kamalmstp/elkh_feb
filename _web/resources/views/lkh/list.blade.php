@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link href="{{ asset('css/daterangepicker.css') }}" rel="stylesheet" type="text/css" media="all"  />
@stop

@section('content')
	<h2>
		<i class="icon-list"></i> Daftar Laporan Kerja Harian (LKH)
		&ensp;&emsp;
		<button data-toggle="modal" data-target="#inputModal" class="btn btn-primary">
			<i class="icon-plus"></i>  Tambah LKH  Baru
		</button>
		@include('lkh.add')
		<button data-toggle="modal" data-target="#inputModal2" class="btn btn-default">
			<i class="icon-file"></i>  Rekap LKH 1 Bulan
		</button>
		@include('lkh.rekap')
	</h2>
	<hr>

	@if(Session::has('sukses'))
	  <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	@endif

	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-danger" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	<div class="table-responsive">
		<table class="table table-bordered table-small" id="dataTable" width="100%" cellspacing="0">
		    <thead>
		        <tr>
		        	<th>No.</th>
		            <th>Hari/Tanggal</th>
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($list_lkh as $lkh)
				    <?php 
				    	$no++;
				    	$tanggal = date_format(date_create($lkh->tanggal), "d/m/Y");
				    	$hari = date_format(date_create($lkh->tanggal), "N");
				     ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $dayList[$hari] }} {{ $tanggal }} </td>
			            <td class="btn-group">
	            			<a href="{{ route('lkh_detail', $lkh->id) }}" class="btn btn-success " title="Lihat/Tambah Kegiatan"><i class="icon-plus"></i> Kegiatan</a>

	            			<button data-toggle="modal" data-target="#editModal_{{$no}}" class="btn btn-info" title="Edit LKH"><i class="icon-edit"></i> Edit
							</button>
							@include('lkh.edit')
	            			
	            			<form method="POST" action="{{ route('lkh_delete', $lkh->id) }}">
		                    	{{ csrf_field() }}
		                    	<input name="_method" type="hidden" value="DELETE">
		                      	<button type="submit" class="btn btn-danger "  title="Hapus LKH" onclick="return confirm('Anda yakin akan menghapus data LKH?')">
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
	<script src="{{ asset('js/moment.js') }}"></script>
	<script src="{{ asset('js/daterangepicker.js') }}"></script> 
	<script src="{{ asset('js/format_angka.js') }}"></script> 
	
	<script type="text/javascript">
    $(function() {
        $('input[name="tanggal"]').daterangepicker({
          singleDatePicker: true,
          showDropdowns: true,
          locale: {
            format: 'DD-MM-YYYY'
          }
        });
    });
  </script>	
@stop
