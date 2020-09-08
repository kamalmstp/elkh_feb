<div id="pdfModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="pdfModalLabel">PDF LKH</h3>
 	</div>
	<form action="{{ route('lkh_pdf') }}" method="POST" enctype="multipart/form-data">
	{{ csrf_field() }}
		<input type="hidden" name="tipe" value="hari">
      	<input type="hidden" name="lkh_id" value="{{ $lkh->id }}"> 	
	  	<div class="modal-body">	    	
	    	<div class="control-group">											
				<label class="control-label">Tanggal TTD</label>
				<div class="controls">
					<input type="date" class="span5" name="ttd" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->			
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Download PDF</button>
	  	</div>
  	</form>
</div>