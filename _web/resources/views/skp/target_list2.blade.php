<tbody>		    	
	<?php $no = 0; ?>
    @foreach($tgt_list as $key => $tgt)
	    <?php $no++; ?>
        <tr>
        	<td>{{ $no }}</td>
            <td>{{ $tgt->skpkegiatan->kegiatan->kegiatan }}</td>
            <td>
            	<input type="text" class="span1" name="ak[]" value="{{$tgt->ak}}" oninput="angka(this);">
            </td>
            <td>
            	<input type="text" class="span1" name="kuantitas[]" value="{{ $tgt->kuantitas }}" oninput="angka(this);" required>
            </td>
            <td>
            	<input type="text" class="span1" value="{{ $tgt->output->nama }}" disabled>			
            </td>
            <td>
            	<input type="text" class="span1" value="100" disabled>
            	<input type="hidden" class="span1" name="mutu[]" 
			            	value="100" >			            		
            </td>
            <td>
            	<input type="text" class="span1" name="waktu[]" value="{{ $tgt->waktu }}" required>
            </td>
            <td>
            	<input type="text" class="span1" value="{{ $tgt->swaktu->nama }}" disabled>	
            </td>
            <td>
            	<input type="text" class="span1" name="biaya[]" value="{{ $tgt->biaya }}" oninput="angka(this);">
            </td>			                       
        </tr>        
        <input type="hidden" name="output_id[]" value="{{ $tgt->output_id }}">
        <input type="hidden" name="waktu_id[]" value="{{ $tgt->waktu_id }}">
        <input type="hidden" name="target_id[]" value="{{$tgt_list[$key]->id}}">
    @endforeach	        			    
</tbody>
<tfoot>
	<tr>
		<td colspan="9" style="text-align: center;">		    			
			<button type="submit" class=" btn btn-primary">
				<i class="icon-save"></i> Simpan
			</button>						
		</td>
	</tr>
</tfoot>