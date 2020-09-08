<div id="pdfModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="pdfModalLabel">Realisasi SKP PDF</h3>
 	</div>
	<form action="{{ route('penilaian_pdf', ['id'=>$skp->id, 'jangka_id'=>$jangka->id]) }}" method="POST">
	{{ csrf_field() }}
	  	<div class="modal-body">	    	
	  		<div class="control-group">											
				<label class="control-label">Jangka Waktu Penilaian</label>
				<div class="controls">
					<input type="date" class="span2" name="start" required> -
					<input type="date" class="span2" name="end" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->			
	    	<div class="control-group">											
				<label class="control-label">Tanggal Dibuat</label>
				<div class="controls">
					<input type="date" class="span5" name="ttd1" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->		
			<div class="control-group">											
				<label class="control-label">Tanggal Diterima Pejabat Penilai</label>
				<div class="controls">
					<input type="date" class="span5" name="ttd2" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->			
			<div class="control-group">											
				<label class="control-label">Tanggal Diterima Atasan Pejabat Penilai</label>
				<div class="controls">
					<input type="date" class="span5" name="ttd3" required>
				</div> <!-- /controls -->				
			</div> <!-- /control-group -->				
		</div>
	  	<div class="modal-footer">
	    	<button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
	    	<button type="submit" class="btn btn-primary">Download PDF</button>
	  	</div>
  	</form>
</div>