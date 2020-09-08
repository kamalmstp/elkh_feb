<div id="editModal_{{$no}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="editModalLabel_{{$no}}">Edit Pangkat & Golongan</h3>
 	</div>
	<form action="{{ route('pangkat_update', $pkt->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
	  	<div class="modal-body">
		  	<div class="row">
				<div class="span6">											
					<label class="control-label">Pangkat</label>
					<div class="controls">
						<input type="text" class="span4" name="pangkat" value="{{ $pkt->pangkat }}" required autofocus>
					</div> 
				</div> 
				<div class="span6">											
					<label class="control-label">Golongan</label>
					<div class="controls">
						<input type="text" class="span4" name="golongan" value="{{ $pkt->golongan }}" required>
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