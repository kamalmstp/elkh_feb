<div id="editModal_{{$no}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="editModalLabel_{{$no}}">Edit Pangkat & Golongan</h3>
 	</div>
	<form action="{{ route('kegiatan_update', $keg->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
	  	<div class="modal-body">
		  	<div class="row">
				<div class="span6">											
					<label class="control-label">Kegiatan</label>
					<div class="controls">
						<textarea name="kegiatan" class="span4" required autofocus>{{$keg->kegiatan}}</textarea>
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