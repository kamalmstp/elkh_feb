@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('content')
	<a href="{{ route('bawahan_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-list"></i> Daftar Laporan Kerja Harian (LKH) 
		&ensp;&emsp;
	</h2>
	<h3>
		<i class="icon-user"></i>
		{{$user->name}} - {{$user->jabatan}} &ensp;&emsp;

		<button data-toggle="modal" data-target="#inputModal2" class="btn btn-default">
			<i class="icon-file"></i>  Rekap LKH 1 Bulan
		</button>		
	</h3>


	<hr>

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
			            <td>{{ $dayList[$hari] }} {{ $tanggal }}</td>
			            <td>
			            	<a href="{{ route('lkhb_detail', $lkh->id) }}" class="btn btn-success btn-small" title="Lihat Kegiatan"><i class="icon-eye-open"> Lihat</i></a>
			            </td>	            
			        </tr>
		        @endforeach	        
		    </tbody>
		</table>
	</div>

	<div id="inputModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			<h3 id="inputModalLabel">Rekap LKH 1 Bulan</h3>
	 	</div>
		<form action="{{ route('lkh_pdf2') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="user" value="atasan">
		<input type="hidden" name="user_id" value="{{$user->id}}">
		  	<div class="modal-body">
		    	<div class="control-group">											
					<label class="control-label">Pilih Bulan dan Tahun LKH</label>
					<div class="controls">
						<input id="month" type="month" class="span5" name="bulan" required>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->
		    	<div class="control-group">											
					<label class="control-label">Tanggal TTD</label>
					<div class="controls">
						<input id="month" type="date" class="span5" name="ttd" required>
					</div> <!-- /controls -->				
				</div> <!-- /control-group -->			
			</div>
		  	<div class="modal-footer">
		    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
		    	<button type="submit" class="btn btn-primary">Download PDF</button>
		  	</div>
	  	</form>
	</div>
@stop

@section('js')
  @parent
   <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
  <script src="{{ asset('js/sb-admin-datatables.min.js') }}"></script>  
 
@stop
