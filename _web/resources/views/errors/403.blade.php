@extends('_layout.base')

@section('css')
    @parent
@stop

@section('content')

<button class="btn btn-success" onclick="window.history.back()"><i class="icon-arrow-left"></i> Kembali</button>
<hr>
    <h1>Anda Tidak Memiliki Hak Akses Ke Halaman Ini</h1>
@stop

@section('js')
  @parent
@stop
