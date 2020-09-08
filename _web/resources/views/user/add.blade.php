@extends('_layout.base')

@section('css')
    @parent
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
@stop

@section('content')
	<a href="{{ route('user_list') }}" class="btn btn-success"><i class="icon-arrow-left"></i> Kembali</a>
	<h2>
		<i class="icon-user"></i> Tambah User Baru		
	</h2>
	<hr>
	
	@if ($errors)
	  @foreach($errors->all() as $error)
	    <div class="alert alert-warning" role="alert"> {{ $error }}</div>
	  @endforeach
	@endif

	<form method="POST" action="{{ route('user_save') }}" enctype="multipart/form-data">
    	{{ csrf_field() }}		
		<div class="row">
			<div class="span6">											
				<label class="control-label">Nama</label>
				<div class="controls">
					<input type="text" class="span6" name="name" value="{{ old('name') }}" required autofocus>
				</div> 
			</div> 
			<div class="span6">											
				<label class="control-label">NIP</label>
				<div class="controls">
					<input type="text" class="span6" name="nip" value="{{ old('nip') }}" required>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span6">											
				<label class="control-label">Pangkat/Golongan Ruang</label>
				<div class="controls">
					<select class="span6" name="pangkat_id" required>
						@if( old('pangkat_id') )
                            <option value="{{old('pangkat_id')}}">
                        		@foreach($pkt_list as $pkt)
									@if( old('pangkat_id') == $pkt->id)
										{{$pkt->pangkat}} / {{$pkt->golongan}}
									@endif
								@endforeach    	
                            </option>
                        @else
                        	<option value="">-- pilih --</option>
                        @endif
						@foreach($pkt_list as $pkt)
							<option value="{{ $pkt->id }}">{{$pkt->pangkat}} / {{$pkt->golongan}}</option>
						@endforeach
					</select>					
				</div>
			</div>
			<div class="span6">											
				<label class="control-label">Bagian</label>
				<div class="controls">
					<select class="span6" name="bagian_id" required>
						@if( old('bagian_id') )
                            <option value="{{old('bagian_id')}}">
                        		@foreach($bgn_list as $bgn)
									@if( old('bagian_id') == $bgn->id)
										{{$bgn->bagian}}
									@endif
								@endforeach    	
                            </option>
                        @else
                        	<option value="">-- pilih --</option>
                        @endif
						@foreach($bgn_list as $bgn)
							<option value="{{ $bgn->id }}">{{ $bgn->bagian }}</option>
						@endforeach
					</select>					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span4">											
				<label class="control-label">Jabatan</label>
				<div class="controls">
					<input type="text" class="span4" name="jabatan" value="{{ old('jabatan') }}" required>
				</div> 
			</div> 
			<div class="span4">											
				<label class="control-label">Atasan</label>
				<div class="controls">
					<select class="js-example-placeholder-single span4" name="atasan_id" required>
						@if( old('atasan_id') )
                            <option value="{{old('atasan_id')}}">
                        		@foreach($user_list as $atasan)
									@if( old('atasan_id') == $atasan->id)
										{{$atasan->name}}
									@endif
								@endforeach    	
                            </option>
                        @else
                        	<option></option>
                        @endif
						@foreach($user_list as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
						@endforeach
					</select>					
				</div>
			</div> 
			<div class="span4">											
				<label class="control-label">Email</label>
				<div class="controls">
					<input type="email" class="span4" name="email" value="{{ old('email') }}" required>
				</div> 
			</div> 
		</div>

		<div class="row">
			<div class="span6">											
				<label class="control-label">Password</label>
				<div class="controls">
					<input type="password" class="span6" name="password" required >
				</div> 
			</div> 
			<div class="span6">											
				<label class="control-label">Konfirmasi Password</label>
				<div class="controls">
					<input type="password" class="span6" name="password_confirmation" required>
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
  <script src="{{ asset('js/select2.min.js') }}"></script> 
  <script type="text/javascript">
	$(document).ready(function() {
	    $('.js-example-placeholder-single').select2({
	    	placeholder: "Pilih Atasan",
	    	allowClear: true
	    });
	});
  </script>
@stop
