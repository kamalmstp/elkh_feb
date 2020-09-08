<div id="inputModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Tambah LKH Baru</h3>
 	</div>
	<form action="{{ route('lkh_save') }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	  	<div class="modal-body">
	    	<div class="control-group">											
				<label class="control-label">Tanggal LKH</label>
				<div class="controls">
					<input name="tanggal" type="text" class="span4" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Tambah</button>
	  	</div>
  	</form>
</div>