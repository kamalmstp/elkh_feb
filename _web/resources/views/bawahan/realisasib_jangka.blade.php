@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('skpb_list', $skp->user->id) }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a><hr>

	<h3>
		<i class="icon-user"></i>
		{{$skp->user->name}} - {{$skp->user->jabatan}}
	</h3><hr>

	@if(Session::has('gagal'))
	  <div class="alert alert-danger" role="alert">{{ Session::get('gagal') }}</div>
	@endif

	<h2>
		<i class="icon-tasks"></i> Realisasi SKP Tahun: {{ $skp->tahun->tahun }}
	</h2>
		
	@foreach($jangka_list as $jangka)
		<a href="{{ route('realisasib_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-warning btn-large" title="Lihat/Input Target">
			Realisasi {{$jangka->jangka}}
		</a>
	@endforeach
	<hr>

	<h2>
		<i class="icon-star"></i> Penilaian Perilaku Kerja Tahun: {{ $skp->tahun->tahun }}
	</h2>
		
	@foreach($jangka_list as $jangka)
		<a href="{{ route('penilaianb_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-info btn-large" title="Lihat/Input Target">
			Penilaian {{$jangka->jangka}}
		</a>
	@endforeach
	
@stop

@section('js')
 	@parent	
@stop
