<div id="inputModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Tambah Kegiatan Baru</h3>
 	</div>
	<form action="{{ route('lkh_detailsave', $lkh->id) }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	  	<div class="modal-body">
	    	<div class="control-group">											
				<label class="control-label">Uraian Kegiatan</label>
				<div class="controls">
					<input name="kegiatan" type="text" class="span5" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">											
				<label class="control-label">Waktu</label>
				<div class="controls">
					<input name="waktua" type="time" class="span2" required> - 
					<input name="waktub" type="time" class="span2" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">											
				<label class="control-label">Keterangan (Kualitas/Kuantitas)</label>
				<div class="controls">
					<input name="keterangan" type="text" class="span5" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Tambah</button>
	  	</div>
  	</form>
</div>