<div id="inputModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Rekap LKH 1 Bulan</h3>
 	</div>
	<form action="{{ route('lkh_pdf2') }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
	  	<div class="modal-body">
	    	<div class="control-group">											
				<label class="control-label">Pilih Bulan dan Tahun LKH</label>
				<div class="controls">
					<input id="month" type="month" class="span5" name="bulan" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->
	    	<div class="control-group">											
				<label class="control-label">Tanggal TTD</label>
				<div class="controls">
					<input id="month" type="date" class="span5" name="ttd" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->			
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Download PDF</button>
	  	</div>
  	</form>
</div>