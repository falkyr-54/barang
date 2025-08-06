  

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >Cari tanggal : </h3>
  </div>
  <div class="panel-body">


    <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/laporan/tampil_luar/'.$tmt.'/'.$tmtdua.'/'.$id_jenis) ?>" enctype="multipart/form-data">

     <div class="box-body">

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>
        <div class="col-sm-4">
         <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmt" autocomplete="off">
       </div>
     </div>

     <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Akhir</label>
      <div class="col-sm-4">
       <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmtdua" autocomplete="off">
     </div>
   </div>

   
   <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Jenis Barang</label>
    <div class="col-sm-4">
     <select class="form-control" name="id_jenis">
      <option value="">Pilih Jenis Barang</option>
      <?php foreach ($barang as $barang) { ?>
        <option value="<?php echo $barang['id_jenis'] ?>"
          <?php if(isset($_POST['id_jenis']) && $_POST['id_jenis']==$barang['id_jenis']) { 
            echo "selected"; } ?>><?php echo $barang['nama_jenis'] ?>
          </option>
        <?php } ?>
      </select>
    </div>
  </div>

</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <!-- <button type="submit"  name="submit" class="btn btn-info">Cari</button> -->
    <input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
    <a href="<?php echo base_url('admin/laporan/excel_keluar/'.$tmt.'/'.$tmtdua.'/'.$id_jenis) ?>" class="btn btn-danger btn-md" target="_blank"><i class="fa fa-file-excel-o"></i> Export Excel</a>
  </div>
</div>

</div><!-- /.box-body -->
<div class="box-footer">
</div><!-- /.box-footer -->
</form>


<div class="row">
  <div class="col-md-12">
    <h2 class="page-header">Laporan Barang <?php echo date('d-m-Y',strtotime($tmt)) ?> Sampai <?php echo date('d-m-Y',strtotime($tmtdua)) ?>  </h2>
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">


      <div class="box-body table-responsive no-padding">
        <div class="box" style="width:99%;">
          <a class="btn btn-block btn-social btn-flickr">
            <i class="fa fa-linkedin"></i> Laporan Stok
          </a>
          <br>

          <table id="example1" class="table table-bordered table-striped">
            <thead>

             <tr class="bg-primary">
               <th width="37">No</th>
               <th width="138">Nama Barang</th>
               <th width="138">Jenis Barang</th>
               <th width="138">Satuan</th>
               <th width="138">Tanggal</th>
               <th width="138">Harga</th>
               <th width="375">Stok tersedia</th>
               <th width="138">Barang masuk</th>
               <th width="138">Pemakaian barang</th>
               <th width="375">harga sisa stok</th>
               <!-- <th width="138">Stok <?php echo $this->tanggal->romawi($bulan).' '.$tahun ?></th> -->
             </tr>
           </thead>

           <tbody>
            <?php 
            $i=1; foreach ($brg as $brg) {

              $id_barang   = $brg['id_barang_masuk'];
              $jml_masuk   = $this->Brg_masuk_model->get_jumlah_stok($id_barang,$tmt,$tmtdua);
              $jml_keluar  = $this->Brg_keluar_model->get_jumlah_stok($id_barang,$tmt,$tmtdua);
              
              $masuk  = $jml_masuk['total'];
              $keluar = $jml_keluar['total'];
              $hasil  = $jml_masuk['total'] - $jml_keluar['total'];


              $total_masuk   = $this->Brg_masuk_model->get_jumlah_msk($id_barang);
              $total_keluar  = $this->Brg_keluar_model->get_jumlah_klr($id_barang);
              $update  = $total_masuk['total'] - $total_keluar['total'];

              ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $brg['nama_barang'] ?></td>
                <td><?php echo $brg['nama_jenis'] ?></td>
                <td><?php echo $brg['satuan'] ?></td>
                <td><?php echo $brg['tanggal_minta'] ?></td>
                <td><?php echo 'Rp'.number_format($brg['harga'],0,',','.') ?></td>
                <td><?php echo $update ?></td>
                <!-- <td>
                  <?php if ($hasil<0) {
                    echo "0";
                  }else{ 
                    echo $hasil;
                  }
                  ?></td> -->
                  
                  <td> <?php if ($masuk==null) {
                    echo "0";
                  }else{ 
                    echo $masuk;
                  }
                  ?></td>
                  
                  <td><?php echo $keluar ?></td>
                  <td><?php echo 'Rp'.number_format($brg['harga']*$update,0,',','.') ?> </td>
                </tr>
                <?php $i++; } ?> 
              </tbody>
            </table>
          </div>
        </div>

        <script>
          $(function() {
            $( ".datepicker" ).datepicker({
              changeYear: true,
              changeMonth: true,
              yearRange: "2023:<?php echo date('Y') ?>",
              dateFormat: "yy-mm-dd"
            });
          });
        </script>




