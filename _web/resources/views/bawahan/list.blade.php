@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('content')
	<h2>
		<i class="icon-group"></i> Daftar Bawahan		
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
		            <th>Nama</th>
		            <th>NIP</th>
		            <th>Jabatan</th>
		            <th>Atasan</th>
		            <th>Email</th>		            
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($bawahan_list as $bawahan)
				    <?php $no++; ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $bawahan->name }}</td>
			            <td>{{ $bawahan->nip }}</td>
			            <td>{{ $bawahan->jabatan }}</td>			         
			            <td>{{ $bawahan->atasan->name }}</td>
			            <td>{{ $bawahan->email }}</td>
			            <td>
			            	<a href="{{ route('lkhb_list', $bawahan->id) }}" class="btn btn-success btn-small" title="Lihat LKH">
			            		<i class="icon-book"> LKH</i>
			            	</a>
			            	<a href="{{ route('skpb_list', $bawahan->id) }}" class="btn btn-info btn-small" title="Lihat SKP">
					        	<i class="icon-briefcase"> SKP</i>
					        </a>
			            </td>	            
			        </tr>
			        @foreach($bawahan->bawahan as $bawahan2)
			        	<?php $no++; ?>
				        <tr>
				        	<td>{{ $no }}</td>
				            <td>{{ $bawahan2->name }}</td>
				            <td>{{ $bawahan2->nip }}</td>
				            <td>{{ $bawahan2->jabatan }}</td>			         
				            <td>{{ $bawahan2->atasan->name }}</td>
				            <td>{{ $bawahan2->email }}</td>
				            <td>
				            	<a href="{{ route('lkhb_list', $bawahan2->id) }}" class="btn btn-success btn-small" title="Lihat LKH">
				            		<i class="icon-book"> LKH</i>
			            		</a>
			            		<a href="{{ route('skpb_list', $bawahan2->id) }}" class="btn btn-info btn-small" title="Lihat SKP">
						        	<i class="icon-briefcase"> SKP</i>
						        </a>
				            </td>	            
				        </tr>
				        @foreach($bawahan2->bawahan as $bawahan3)
				        	<?php $no++; ?>
					        <tr>
					        	<td>{{ $no }}</td>
					            <td>{{ $bawahan3->name }}</td>
					            <td>{{ $bawahan3->nip }}</td>
					            <td>{{ $bawahan3->jabatan }}</td>			         
					            <td>{{ $bawahan3->atasan->name }}</td>
					            <td>{{ $bawahan3->email }}</td>
					            <td>
					            	<a href="{{ route('lkhb_list', $bawahan3->id) }}" class="btn btn-success btn-small" title="Lihat LKH">
					            		<i class="icon-book"> LKH</i>
			            			</a>
			            			<a href="{{ route('skpb_list', $bawahan3->id) }}" class="btn btn-info btn-small" title="Lihat SKP">
							        	<i class="icon-briefcase"> SKP</i>
							        </a>
					            </td>	            
					        </tr>
			        	@endforeach
		        	@endforeach
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
