@extends('_layout.base')

@section('css')
    @parent    
@stop

@section('content')
	<a href="{{ route('skp_list') }}" class="btn btn-success">
		<i class="icon-arrow-left"></i> Kembali
	</a><hr>

	@if(Session::has('gagal'))
	  <div class="alert alert-danger" role="alert">{{ Session::get('gagal') }}</div>
	@endif

	<h2>
		<i class="icon-tasks"></i> Realisasi SKP Tahun: {{ $skp->tahun->tahun }}
	</h2>
		
	@foreach($jangka_list as $jangka)
		<a href="{{ route('realisasi_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-warning btn-large" title="Lihat/Input Target">
			Realisasi {{$jangka->jangka}}
		</a>
	@endforeach
	<hr>

	<h2>
		<i class="icon-star"></i> Penilaian Perilaku Kerja Tahun: {{ $skp->tahun->tahun }}
	</h2>
		
	@foreach($jangka_list as $jangka)
		<a href="{{ route('penilaian_list', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" class="btn btn-info btn-large" title="Lihat/Input Target">
			Penilaian {{$jangka->jangka}}
		</a>
	@endforeach

	


	
@stop

@section('js')
 	@parent	
@stop
