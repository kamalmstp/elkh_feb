<div id="editModal_{{$no}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="editModalLabel_{{$no}}">Edit LKH</h3>
 	</div>
	<form action="{{ route('lkh_update', $lkh->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
	  	<div class="modal-body">
	    	<div class="control-group">											
				<label class="control-label" for="firstname">Tanggal LKH</label>
				<div class="controls">
					<input name="tanggal" type="text" class="span4" value="{{$lkh->tanggal}}" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Simpan</button>
	  	</div>
  	</form>
</div>
