 
  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php echo $keluar['id_luar_kel'] ?>">
    <i class="fa fa-trash"></i>
  </button>
  <!-- Modal -->
  <div class="modal fade" id="Delete<?php echo $keluar['id_luar_kel'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
          <h4 class="modal-title text-center" id="myModalLabel"><?php echo $keluar['nama_barang']?></h4>
        </div>
        <div class="modal-body">
          
          <p class="alert alert-error">Yakin ingin menghapus data keluar ini?</p>
          
          <table width="100%" border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
            <tr>
              <td width="34%">Nama Barang</td>
              <td width="66%">: <?php echo $keluar['nama_barang'] ?></td>
            </tr>
            <tr>
              <td>Pegawai Yang Minta</td>
              <td>: <?php echo $keluar['nama_lengkap'] ?></td>
            </tr>
            <tr>
              <td>keluar</td>
              <td>: <?php echo $keluar['jumlah_keluar'] ?></td>
            </tr>
            <tr>
              <td>tanggal keluar</td>
              <td>: <?php echo $keluar['tanggal_minta'] ?></td>
            </tr>
          </table>

          
        </div>
        <div class="modal-footer">
         <a href="<?php echo base_url('admin/brg_keluar_kel/delete/'.$keluar['id_luar_kel'].'/'.$keluar['id_barang'].'/'.$keluar['id_satker']) ?>" class="btn btn-warning"><i class="fa fa-trash"></i> Ya, hapus data ini</a>
         <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
       </div>
     </div>
   </div>
 </div>
