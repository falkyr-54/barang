<!-- Trigger the modal with a button -->

<button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#Delete<?php echo $cuti->id_pers_cuti_hist ?>">
<i class="fa fa-trash-o"></i>
</button>


<!-- Modal -->
<div id="Delete<?php echo $cuti->id_pers_cuti_hist ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Hapus Data Pangkat</h4>
      </div>
      <div class="modal-body">

	<div class="alert alert-success">Yakin ingin menghapus data cuti ini?</div>

      </div>
      <div class="modal-footer">
      	
        <a href="<?php echo base_url('pers_cuti_hist/delete/'.$cuti->id_pers_cuti_hist) ?>" class="btn btn-primary"><i class="fa fa-trash-o"></i> Hapus data ini</a>
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>