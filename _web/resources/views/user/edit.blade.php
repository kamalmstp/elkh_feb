@extends('_layout.base')

@section('css')
    @parent
   <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@stop

@section('content')
	<a href="{{ route('user_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-user"></i> Edit User
	</h2>
	<hr>
	
	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	<form method="POST" action="{{ route('user_update', $user->id) }}" enctype="multipart/form-data">
    	{{ csrf_field() }}		
    	<input type="hidden" name="_method" value="PATCH">
		<div class="row">
			<div class="span6">											
				<label class="control-label">Nama</label>
				<div class="controls">
					<input type="text" class="span6" name="name" value="{{ $user->name }}" required autofocus>
				</div> 
			</div> 
			<div class="span6">											
				<label class="control-label">NIP</label>
				<div class="controls">
					<input type="text" class="span6" name="nip" value="{{ $user->nip }}" required>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="span6">											
				<label class="control-label">Pangkat/Golongan Ruang</label>
				<div class="controls">
					<select class="span6" name="pangkat_id" required>						
						@foreach($pkt_list as $pkt)
							<option value="{{ $pkt->id }}" @if($user->pangkat->id == $pkt->id)			selected @endif>
								{{$pkt->pangkat}} / {{$pkt->golongan}}
							</option>
						@endforeach
					</select>					
				</div>
			</div>
			<div class="span6">											
				<label class="control-label">Bagian</label>
				<div class="controls">
					<select class="span6" name="bagian_id" required>						
						@foreach($bgn_list as $bgn)
							<option value="{{ $bgn->id }}" @if($user->bagian->id == $bgn->id)			selected @endif>
								{{ $bgn->bagian }}
							</option>
						@endforeach
					</select>					
				</div>
			</div>
		</div>

		<div class="row">
			<div class="span4">											
				<label class="control-label">Jabatan</label>
				<div class="controls">
					<input type="text" class="span4" name="jabatan" value="{{ $user->jabatan }}" required>
				</div> 
			</div> 
			<div class="span4">											
				<label class="control-label">Atasan</label>
				<div class="controls">
					<select class="js-example-placeholder-single span4" name="atasan_id" required>
						@foreach($user_list as $atasan)
						<option value="{{$atasan->id}}" @if($user->atasan->id == $atasan->id)			selected @endif>
							{{ $atasan->name }}
						</option>
						@endforeach
					</select>
					
				</div>
			</div> 
			<div class="span4">											
				<label class="control-label">Email</label>
				<div class="controls">
					<input type="email" class="span4" name="email" value="{{ $user->email }}" required>
				</div> 
			</div> 
		</div>

		<div class="row">
			<div class="span6">
				<input type="button" class="btn btn-warning" onClick="show()" value="Ganti Password">
			</div>
		</div><br>

		<div class="row" id="password" style="display: none;">
			<div class="span6">											
				<label class="control-label">Password Baru</label>
				<div class="controls">
					<input type="password" class="span6" name="password">
				</div> 
			</div> 
			<div class="span6">											
				<label class="control-label">Konfirmasi Password</label>
				<div class="controls">
					<input type="password" class="span6" name="password_confirmation">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="span6">
				<button type="submit" class="btn btn-primary">
					<i class="icon-save"></i> Simpan Perubahan
				</button>
			</div>
		</div>
	</form>
@stop

@section('js')
  @parent

  <script src="{{ asset('js/select2.min.js') }}"></script> 
  <script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-placeholder-single').select2({
	    	placeholder: "Pilih Atasan",
	    	allowClear: true
	    });
	});
  </script>
  
  <script type="text/javascript">
    function show(){
      
      document.getElementById('password').style.display="block" ;
    }
  </script>

@stop
