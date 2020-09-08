@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" rel="stylesheet">
@stop

@section('content')
	<h2>
		<i class="icon-user"></i> Manajemen User
		&ensp;&emsp;
		<a href="{{ route('user_add') }}" class="btn btn-primary"><i class="icon-plus"></i>  Tambah User Baru</a>
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
		            <th>Pangkat/Gol. R.</th>
		            <th>Bagian</th>
		            <th>Jabatan</th>
		            <th>Atasan</th>
		            <th>Email</th>		            
		            <th>Opsi</th>
		        </tr>
		    </thead>
		    <tbody>
		    	<?php $no = 0; ?>
			    @foreach($user_list as $user)
				    <?php $no++; ?>
			        <tr>
			        	<td>{{ $no }}</td>
			            <td>{{ $user->name }}</td>
			            <td>{{ $user->nip }}</td>
			            <td>{{ $user->pangkat->pangkat }} / {{ $user->pangkat->golongan }}</td>
			            <td>{{ $user->bagian->bagian }}</td>
			            <td>{{ $user->jabatan }}</td>			         
			            <td>{{ $user->atasan->name }}</td>
			            <td>{{ $user->email }}</td>
			            <td>
			            	<table border="0">
			            	<tr>
			            		<td>
			            			<a href="{{ route('user_edit', $user->id) }}" class="btn btn-success btn-small" title="Edit data user"><i class="icon-edit"></i></a>
			            		</td>			            		
			            		@if($user->id > 5)
			            		<td>
			            			<form method="POST" action="{{ route('user_delete', $user->id) }}">
				                    	<input name="_method" type="hidden" value="DELETE">
				                      	<input name="_token" type="hidden" value="{{ csrf_token() }}">
				                      	<button type="submit" class="btn btn-small btn-danger "  title="Hapus LKH" onclick="return confirm('Anda yakin akan menghapus User ?')">
				                          	<i class="icon-trash"></i>
				                      	</button>
				                    </form>    		
			            		</td>
			            		@endif
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
