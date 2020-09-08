<div id="editModal_{{$no}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="editModalLabel_{{$no}}">Edit Tugas Tambahan</h3>
 	</div>
	<form action="{{ route('tambahan_update', $tambahan->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
	  	<div class="modal-body">
		  	<div class="row">				
				<div class="span6">											
					<label class="control-label">Tugas Tambahan dan Kreativitas</label>
					<div class="controls">
						<input type="text" class="span5" name="tugas" value="{{$tambahan->tugas}}" autofocus required>
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