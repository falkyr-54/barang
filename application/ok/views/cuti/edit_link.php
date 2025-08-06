<a href="<?php echo base_url('cuti/edit/'.$cuti->id_pers_cuti_hist) ?>" class="btn btn-success btn-xs" data-toggle="modal" data-target="#myModal<?php echo $no ?>">
<i class="fa fa-edit"></i></a>


<div id="myModal<?php echo $no ?>" class="modal fade"tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg">
  <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Edit cuti</h4>
      </div>
      <div class="modal-body">
                <!-- Content will be loaded here from "remote.php" file -->
      </div>
      
      <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
</div>
</div>
<!-- End Modals-->