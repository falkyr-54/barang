 	<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#Approve<?php echo $klast['id_barang_keluar'] ?>">
 		<?php if ($klast['status_validasi']=="belum"){ ?>
 			<i class="fa  fa-calendar-minus-o btn btn-warning btn-md"> <?php echo $klast['status_validasi'] ?></i>
 		<?php }elseif($klast['status_validasi']=="tolak_pj"){ ?>
 			<i class="fa fa-calendar-times-o btn btn-danger btn-md"> <?php echo $klast['status_validasi'] ?></i>
 		<?php }elseif($klast['status_validasi']=="acc_pj"){ ?>
 			<i class="fa fa-calendar-check-o btn btn-success btn-md"> <?php echo $klast['status_validasi'] ?></i>
 			
 		<?php } ?>
 	</button>

 	<!-- MODAL -->
 	<div class="modal fade" id="Approve<?php echo $klast['id_barang_keluar'] ?>" tabindex="-1" role="dialog"
 		aria-labelledby="myModalLabel" aria-hidden="true">

 		<div class="modal-dialog modal-md">

 			<div class="modal-content">

 				<div class="modal-header">
 					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
 					<h4 class="modal-title" id="myModalLabel">Approve permintaan unit <?php echo $klast['unit'] ?>?</h4>
 				</div>

 				<div class="modal-body">
 					
 					<label>Permintaan barang : </label>
 					<input type="text" name="jumlah_keluar" class="form-control" value="<?php echo $klast['jumlah_keluar'] ?>" placeholder="isi" readonly> 
 					<?php echo $klast['satuan'] ?>

 					
 				</div>

 				<div class="modal-footer">
 					<a href="<?php echo base_url('admin/pj_klaster/approve/'.$klast['id_barang_keluar'].'/'.$tmt.'/'.$sampai) ?>" class="btn btn-success"><i class="fa fa-check"></i> Setujui</a>
 					<a href="<?php echo base_url('admin/pj_klaster/tolak/'.$klast['id_barang_keluar'].'/'.$tmt.'/'.$sampai) ?>" class="btn btn-danger"><i class="fa fa-check"></i> Tolak</a>
 				</div>

 			</div>
 		</div>
 	</div>