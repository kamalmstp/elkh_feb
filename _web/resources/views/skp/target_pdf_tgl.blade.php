<div id="pdfModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="pdfModalLabel">Target SKP PDF</h3>
 	</div>
	<form action="{{ route('target_pdf', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST">
	{{ csrf_field() }}
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