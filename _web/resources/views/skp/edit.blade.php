<div id="editModal_{{$no}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="editModalLabel_{{$no}}">Edit SKP</h3>
 	</div>
	<form action="{{ route('skp_update', $skp->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
	  	<div class="modal-body">
		  	<div class="row">				
				<div class="span6">	
					<label class="control-label">Tahun</label>
					<div class="controls">
						<select class="span5" name="tahun_id" autofocus required>
							@foreach($thn_list as $thn)
								<option value="{{ $thn->id }}"
									@if($skp->tahun_id == $thn->id)
										selected
									@endif>
									{{$thn->tahun}}
								</option>
							@endforeach
						</select>											
					</div>
				</div>
			</div>
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Simpan</button>
	  	</div>
  	</form>
</div>