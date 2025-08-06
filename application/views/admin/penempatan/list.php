
<!-- <div class="box-header with-border">
  <a href="<?php echo base_url('admin/penempatan/tambah_baru') ?>" class="btn btn-sm btn-primary pull-left">
    <i class="fa fa-plus"></i> Tambah Data</a> 
  </div> -->


  <div class="box-body">
    <table  id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
          <th>Satuan kerja</th>
          <th>Jumlah Printer</th>
          <th>Jumlah Komputer</th>
        </tr>
      </thead>

      <tbody>
        <?php $i=1;foreach ($list as $list) { ?>
         <tr>
          <td><?php echo $i ?></td>
          <td><a href="<?php echo base_url('admin/penempatan/list_unit/'.$list['id_satker']) ?>" class="btn btn-info btn-xs"><?php echo $list['nama_satker'] ?></a></td>
          <td>
            <?php
            $id_jenis    = $list['id_satker'];
            $hitungpc   = $this->penempatan_model->hitungprinter_satker($id_jenis);
            echo count($hitungpc).' Buah<br>'
            ?>
          </td>
          <td> <?php
            $id_jenis    = $list['id_satker'];
            $hitungpc   = $this->penempatan_model->hitungpc_satker($id_jenis);
            echo count($hitungpc).' Buah<br>'
            ?></td>
        </tr>
        <?php $i++; } ?>
      </tbody>
    </table>
  </div>
