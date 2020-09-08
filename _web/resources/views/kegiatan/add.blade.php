<div id="inputModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Tambah Kegiatan SKP Baru</h3>
 	</div>
	<form action="{{ route('kegiatan_save') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="user_id" value="{{Auth::user()->id}}">
	  	<div class="modal-body">
		  	<div class="row">
				<div class="span6">											
					<label class="control-label">Kegiatan</label>
					<div class="controls">
						<textarea name="kegiatan" class="span4" required autofocus></textarea>
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