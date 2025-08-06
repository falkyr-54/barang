  

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >Cari tanggal : </h3>
  </div>
  <div class="panel-body">


    <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/laporan/stok/'.$tmt.'/'.$tmt2) ?>" enctype="multipart/form-data">

     <div class="box-body">

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Awal</label>
        <div class="col-sm-4">
         <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmt" autocomplete="off">
       </div>
     </div>


     <div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label">Unit</label>
      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Tanggal Akhir</label>
        <div class="col-sm-4">
         <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmt2" autocomplete="off">
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
    <h2 class="page-header">Pencarian Tanggal <?php echo date('d-m-Y',strtotime($tmt)) ?> </h2>
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">


      <div class="box-body table-responsive no-padding">
        <div class="box" style="width:99%;">
          <a class="btn btn-block btn-social btn-flickr">
            <i class="fa fa-linkedin"></i> Laporan stok barang
          </a>
          <br>

          <table id="example1" class="table table-bordered table-striped">
            <thead>

             <tr class="bg-primary">
               <th width="37">No</th>
               <th width="138">Nama Barang</th>
               <th width="138">Nama Pegawai</th>
               <th width="138">Tanggal</th>
               <th width="375">Jumlah</th>
               <th width="375">Satker</th>
               <th width="375">Unit</th>
             </tr>
           </thead>

           <tbody>
             
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <script>
        $(function() {
          $( ".datepicker" ).datepicker({
            changeYear: true,
            changeMonth: true,
            yearRange: "2020:<?php echo date('Y') ?>",
            dateFormat: "yy-mm-dd"
          });
        });
      </script>




