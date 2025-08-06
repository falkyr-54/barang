<div class="box-header with-border">
  <a href="<?php echo base_url('admin/data_aset/tambah') ?>" class="btn btn-sm btn-primary pull-left">
    <i class="fa fa-plus"></i> Tambah Data</a> 
  </div>

  <br>
  <div class="box-body">
    <table  id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th width="17">#</th>
          <th width="27">Foto</th>
          <th width="27">Merk/Type</th>
          <th width="40">Kode Barang</th>
          <th width="112">Tahun</th>
          <th width="74">Penempatan</th>
          <th width="174">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <?php $i=1; foreach($list as $list) { ?>
         <tr>
          <td><?php echo $i ?></td>
          <td>

            <?php if($list['gambar']=="") { echo "No photo"; }else{ ?>
              <img src="<?php echo base_url('assets/upload/image/thumbs/'.$list['gambar']) ?>" style="max-width: 50px; height:auto;">
            <?php } ?>

          </td>

          <td><?php echo $list['merk'].' '.$list['type'] ?></td>
          <td><?php echo $list['kd_barang'] ?></td>
          <td><?php echo $list['tahun'] ?></td>
          <td><?php echo $list['nama_satker']  ?>/<?php echo $list['unit']?></td>
          <td>  

           <script>
             $(function () {
               $('[data-toggle="tooltip"]').tooltip()
             })
           </script>

          <!--  <a href="<?php echo base_url('admin/detil_barang/cetak/'.$list['id_detil']) ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Cetak Biodata" target="_blank">
            <i class="fa fa-print"></i></a> -->

            <a href="<?php echo base_url('admin/detil_barang/edit/'.$list['id_detil']) ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="edit">
              <i class="fa fa-pencil"></i></a>

              <a href="<?php echo base_url('admin/detil_barang/riwayat/'.$list['id_detil']) ?>" class="btn btn-success btn-xs" data-toggle="tooltip" data-placement="top" title="Riwayat Barang" target="_blank">
                <i class="fa fa-folder-o"></i></a>


              <!--   <?php
                  // Delete
                include('delete.php');
                ?>   -->


               <!--  <?php
              // detail
                include('detail.php');
                ?> -->

              </td>
            </tr>
            <?php $i++; } ?> 
          </tbody>
        </table>
      </div>
