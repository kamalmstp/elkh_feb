<div id="inputModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="inputModalLabel" aria-hidden="true">
		<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="inputModalLabel">Tambah Kegiatan SKP Baru</h3>
 	</div>
	<form action="{{ route('skpkegiatan_save', $skp->id) }}" method="POST" enctype="multipart/form-data">
		{{ csrf_field() }}
	  	<div class="modal-body">
		  	<div class="row">				
				<div class="span6">											
					<label class="control-label">Kegiatan</label>
					<div class="controls">
						<select class="js-example-placeholder-single span5" name="kegiatan_id" required autofocus>							
	                        <option></option>	                        
							@foreach($keg_list as $keg)
								<option value="{{ $keg->id }}">{{$keg->kegiatan}}</option>
							@endforeach
						</select>					
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