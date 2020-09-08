@extends('_layout.base')

@section('css')
    @parent
    
@stop

@section('content')
	<a href="{{ route('bawahan_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-table"></i> Sasaran Kerja Pegawai (SKP)		
	</h2>
	<h3>
		<i class="icon-user"></i>
		@if(count($skp_list) > 0)
		{{$skp_list[0]->user->name}} - {{$skp_list[0]->user->jabatan}}
		@endif
	</h3>
	<hr>


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
		    	@if(count($skp_list) > 0)
			    	<?php $no = 1; ?>
				    @foreach($skp_list as $skp)
				        <tr>
				        	<td>{{ $no++ }}</td>
				            <td>{{ $skp->tahun->tahun }}</td>
				            <td>
		            			<a href="{{ route('targetb_jangka', $skp->id) }}" class="btn btn-success " title="Lihat Target Kegiatan SKP"><i class=" icon-screenshot"></i> Target</a>

		            			<a href="{{ route('realisasib_jangka', $skp->id) }}" class="btn btn-warning" title="Lihat Realisasi & Penilaian SKP"><i class=" icon-tasks"></i> Realisasi & Penilaian Kerja</a>	
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
@stop
