@extends('_layout.base')

@section('css')
    @parent
@stop

@section('content')
    <h2>
		<i class="icon-key"></i> Ganti Password		
	</h2>
	<hr>

    @if(Session::has('sukses'))
	  <div class="alert alert-success" role="alert">{{ Session::get('sukses') }}</div>
	@endif
	@if(Session::has('gagal'))
	  <div class="alert alert-danger" role="alert">{{ Session::get('gagal') }}</div>
	@endif

    @if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-danger" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	<form method="POST" action="{{ route('password_save') }}" enctype="multipart/form-data">
    	{{ csrf_field() }}		
		
		<div class="row">
			
			<div class="span4">											
				<label class="control-label">Password Baru</label>
				<div class="controls">
					<input type="password" class="span4" name="password" required autofocus>
				</div> 
			</div> 
			<div class="span4">											
				<label class="control-label">Konfirmasi Password</label>
				<div class="controls">
					<input type="password" class="span4" name="password_confirmation" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="span6">
				<button type="submit" class="btn btn-primary">
					<i class="icon-save"></i> Simpan
				</button>
			</div>
		</div>
	</form>

@stop

@section('js')
  @parent
@stop
