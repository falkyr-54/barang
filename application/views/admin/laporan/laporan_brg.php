  

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >Cari tanggal : </h3>
  </div>
  <div class="panel-body">


    <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/laporan/tampil_opname/'.$id_jenis) ?>" enctype="multipart/form-data">

     <div class="box-body">

       <div class="form-group">
        <label for="inputPassword3" class="col-sm-2 control-label">jenis barang</label>
        <div class="col-sm-4">
         <select name="id_jenis" class="form-control">
           <option value="0">jenis barang</option>       
           <?php foreach($jenis as $jenis) { ?>
             <option value="<?php echo $jenis['id_jenis'] ?>"
               <?php if(isset($_POST['id_jenis']) && $_POST['id_jenis']==$jenis['id_jenis']) { 
                echo "selected"; } ?> 
                >
                <?php echo $jenis['nama_jenis'] ?></option>
              <?php } ?>
            </select>
          </div>
        </div>


      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <!-- <button type="submit"  name="submit" class="btn btn-info">Cari</button> -->
          <input type="submit" name="submit" value="Cari" class="btn btn-success btn-md">
        </div>
      </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
    </div><!-- /.box-footer -->
  </form>


  <div class="row">
    <div class="col-md-12">
      <h2 class="page-header">Laporan Opname Terupdate</h2>
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <div class="box-body table-responsive no-padding">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
               <th rowspan="3">No.</th>
               <th rowspan="3">Nama Barang</th>
               <th rowspan="3">Satuan</th>
               <th align="center" colspan="2" rowspan="1">Sisa persediaan Barang</th>
               <th rowspan="3">harga total</th>
               <!-- <th rowspan="3">jumlah</th> -->
             </tr>

             <tr>
            <!--   <?php foreach ($satker as $satker) { ?>
                <th align="center" colspan="2" rowspan="1" align="center"><?php echo $satker['nama_satker'] ?></th>
                <?php } ?> -->

                <th align="center" colspan="2" rowspan="1" align="center">pasar rebo</th>
              </tr>

              <tr>
                <th align="center" colspan="1" rowspan="1" align="center">sisa barang</th>
                <th align="center" colspan="1" rowspan="1" align="center">harga satuan</th>

             <!--  <th align="center" colspan="1" rowspan="1" align="center">sisa</th>
              <th align="center" colspan="1" rowspan="1" align="center">harga</th>

              <th align="center" colspan="1" rowspan="1" align="center">sisa</th>
              <th align="center" colspan="1" rowspan="1" align="center">harga</th>

              <th align="center" colspan="1" rowspan="1" align="center">sisa</th>
              <th align="center" colspan="1" rowspan="1" align="center">harga</th>

              <th align="center" colspan="1" rowspan="1" align="center">sisa</th>
              <th align="center" colspan="1" rowspan="1" align="center">harga</th>

              <th align="center" colspan="1" rowspan="1" align="center">sisa</th>
              <th align="center" colspan="1" rowspan="1" align="center">harga</th> -->

              
            </tr>

          </thead>
          <tbody>
           <?php 
           $i=1; foreach ($ada as $ada) {
             $id_barang       = $ada['id_barang'];
             $id_barang_masuk = $ada['id_barang_masuk'];
             $id_jenis   = $this->uri->segment(4);
             $store      = $this->Laporan_model->list_brg_masuk($id_barang,$id_barang_masuk);
             $stok_id    = $this->Brg_keluarkel_model->get_total_id($id_barang,$id_barang_masuk);
             $hasil      = $store['jumlah'] - $stok_id['total'];

             // $id_satker   = 1;
             // $jml_masuk   = $this->Laporan_model->get_jumlah_masuk($id_barang);
             // $jml_keluar  = $this->Laporan_model->get_jumlah_keluar($id_barang);
             // $hasil = $jml_masuk['total'] - $jml_keluar['total'];


             // $masuk = $jml_masuk['total'];
             // $keluar = $jml_keluar['total'];
             // $total_masuk   = $this->Brg_masuk_model->get_jumlah_masuk($id_barang);
             // $total_keluar  = $this->Brg_keluar_model->get_jumlah_keluar($id_barang);

             ?>

             <?php if ($hasil==0){ ?>
              <tr hidden=""></tr>
            <?php }else{ ?>
              <tr>

                <td><?php echo $i ?></td>
                <td><?php echo $ada['nama_barang'] ?></td>
                <td><?php echo $ada['satuan'] ?></td>

                <td>
                  <?php
                  echo $hasil;
                  ?>
                </td>

                <td><?php echo $ada['harga'] ?></td>
                <td><?php echo $ada['harga']*$hasil ?></td>
              </tr>
              <?php $i++; } ?> 

            <?php } ?>
            <tr>
            <td></td>
            <td>JUMLAH</td>
            <td></td>
            <td></td>
            <td></td>
            <td><?php count($i) ?></td>
            </tr>
          </tbody>
        </table>
      </div>