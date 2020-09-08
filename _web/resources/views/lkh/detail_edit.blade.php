<div id="editModal_{{$no}}" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel_{{$no}}" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="editModalLabel_{{$no}}">Edit Kegiatan </h3>
 	</div>
	<form action="{{ route('lkh_detailupdate', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
		<input type="hidden" name="_method" value="PATCH">
	  	<div class="modal-body">
	    	<div class="control-group">											
				<label class="control-label">Uraian Kegiatan</label>
				<div class="controls">
					<input name="kegiatan" type="text" class="span6" value="{{$kegiatan->kegiatan}}" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">											
				<label class="control-label">Waktu</label>
				<div class="controls">
					<input name="waktua" type="time" class="span3" value="{{$kegiatan->waktua}}" required> - 
					<input name="waktub" type="time" class="span3" value="{{$kegiatan->waktub}}" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
			<div class="control-group">											
				<label class="control-label">Keterangan (Kualitas/Kuantitas)</label>
				<div class="controls">
					<input name="keterangan" type="text" class="span6" value="{{$kegiatan->keterangan}}" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Simpan</button>
	  	</div>
  	</form>
</div>