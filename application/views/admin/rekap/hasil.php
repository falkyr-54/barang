  

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >Cari tanggal : </h3>
  </div>
  <div class="panel-body">


    <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/laporan/tampil_sedia/'.$tmt.'/'.$tmtdua) ?>" enctype="multipart/form-data">

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

</div>
<div class="form-group">
  <div class="col-sm-offset-2 col-sm-10">
    <!-- <button type="submit"  name="submit" class="btn btn-info">Cari</button> -->
    <input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
    <a href="<?php echo base_url('admin/laporan/cetak_excel/'.$tmt.'/'.$tmtdua) ?>" class="btn btn-danger btn-md" target="_blank"><i class="fa fa-file-excel-o"></i> Export Excel</a>
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
               <th>No</th>
               <th>Nama Persediaan</th>
               <th>Saldo</th>
               <th>Penerimaan</th>
               <th>Pengeluaran</th>
               <th>Saldo akhir</th>
               <th>Keterangan</th>
             </tr>
           </thead>

           <tbody>
            <?php 
            $i=1; foreach ($brg as $brg) {



              ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $brg['nama_sedia'] ?></td>
                <td>Saldo</td>
                <td>  
                  <?php 
                  $id_sedia  = $brg['id_sedia'];
                  $tmt       = $this->uri->segment(4);
                  $tmtdua    = $this->uri->segment(5);
                  $total_masuk   = $this->Persediaan_model->get_jumlah_sedia($tmt,$tmtdua,$id_sedia);
                  $total_harga   = $this->Persediaan_model->get_harga_sedia($tmt,$tmtdua,$id_sedia);
                  $masuk  = $total_masuk['total'];
                  $harga  = $total_harga['total'];
                  $jml = $masuk*$harga;

                  echo 'Rp'.number_format($jml,0,',','.')
                  ?>
                </td>
                <td>
                  <?php 
                  $id_sedia  = $brg['id_sedia'];
                  $tmt       = $this->uri->segment(4);
                  $tmtdua    = $this->uri->segment(5);
                  $total_masuk   = $this->Persediaan_model->get_jml_keluar($tmt,$tmtdua,$id_sedia);
                  $total_harga   = $this->Persediaan_model->get_harga_keluar($tmt,$tmtdua,$id_sedia);
                  $masuk  = $total_masuk['total'];
                  $harga  = $total_harga['total'];
                  $jml = $masuk*$harga;

                  echo 'Rp'.number_format($jml,0,',','.')
                  ?></td>
                  <td>akhir</td>
                  <td>ket</td>
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




