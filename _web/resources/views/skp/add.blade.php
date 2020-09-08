<div id="inputModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Tambah SKP Baru</h3>
 	</div>
	<form action="{{ route('skp_save') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
	  	<div class="modal-body">
		  	<div class="row">				
				<div class="span6">											
					<label class="control-label">Tahun</label>
					<div class="controls">
						<select class="span5" name="tahun_id" autofocus required>
							@if( old('tahun_id') )
	                            <option value="{{old('tahun_id')}}">
	                        		@foreach($thn_list as $thn)
										@if( old('tahun_id') == $thn->id)
											{{$thn->tahun}}
										@endif
									@endforeach    	
	                            </option>
	                        @else
	                        	<option value="">-- pilih --</option>
	                        @endif
							@foreach($thn_list as $thn)
								<option value="{{ $thn->id }}">{{$thn->tahun}}</option>
							@endforeach
						</select>											
					</div>
				</div>				
			</div>
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Tambah</button>
	  	</div>
  	</form>
</div>