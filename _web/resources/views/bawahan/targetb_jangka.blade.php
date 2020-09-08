@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('skpb_list', $skp->user->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-table"></i> Daftar SKP Tahun {{ $skp->tahun->tahun }}
	</h2>
	<h3>
		<i class="icon-user"></i>
		{{$skp->user->name}} - {{$skp->user->jabatan}}
	</h3>
	@if(Session::has('gagal'))
		<br>
	  <div class="alert alert-danger" role="alert">{{ Session::get('gagal') }}</div>
	@endif
	<hr>

	@if( count($skpkeg_list) > 0 )		
		@foreach($jangka_list as $jangka)
			<a href="{{ route('targetb_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-info btn-large" title="Lihat/Input Target" style="font-weight: bold;">
				Target {{$jangka->jangka}}
			</a>
		@endforeach			
	@else
		<h2>Data Belum Diisi</h2>
	@endif

@stop

@section('js')
 	@parent	
@stop
