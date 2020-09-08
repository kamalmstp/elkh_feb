<div id="inputModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Tambah Pangkat & Golongan Baru</h3>
 	</div>
	<form action="{{ route('pangkat_save') }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
	  	<div class="modal-body">
		  	<div class="row">
				<div class="span6">											
					<label class="control-label">Pangkat</label>
					<div class="controls">
						<input type="text" class="span4" name="pangkat" value="{{ old('pangkat') }}" required autofocus>
					</div> 
				</div> 
				<div class="span6">											
					<label class="control-label">Golongan</label>
					<div class="controls">
						<input type="text" class="span4" name="golongan" value="{{ old('golongan') }}" required>
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