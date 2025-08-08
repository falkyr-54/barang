 
<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" >Cari tanggals : </h3>
  </div>
  <div class="panel-body">


    <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/barang/pencarian_masuk/'.$tmt.'/'.$tmtdua) ?>" enctype="multipart/form-data">

     <div class="box-body">

      <div class="form-group">
        <label for="inputEmail3" class="col-sm-2 control-label">Dari</label>
        <div class="col-sm-4">
         <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmt" autocomplete="off">
       </div>
     </div>

     <div class="form-group">
      <label for="inputEmail3" class="col-sm-2 control-label">Sampai</label>
      <div class="col-sm-4">
       <input type="text" class="form-control datepicker" placeholder="YYYY-MM-DD" name="tmtdua" autocomplete="off">
     </div>


     <!-- <div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label">Unit</label>
      <div class="col-sm-4">
       <select name="id_unit" class="form-control">
         <option value="">Pilih Unit</option>       
         <?php foreach($unit as $unit) { ?>
           <option value="<?php echo $unit['id_unit'] ?>"
             <?php if(isset($_POST['id_unit']) && $_POST['id_unit']==$unit['id_unit']) { 
              echo "selected"; } ?> 
              >
              <?php echo $unit['unit'] ?></option>
            <?php } ?>
          </select>
        </div> -->
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
    <!-- Custom Tabs -->
    <div class="nav-tabs-custom">

     <div class="box-body table-responsive no-padding">
       <table id="example1" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th width="17">#</th>
            <th width="17">Nama Barang</th>
            <th width="27">Tanggal</th>
            <th width="27">Penyedia</th>
            <th width="74">Spesifikasi</th>
            <th width="27">Jumlah</th>
            <th width="27">harga</th>
            <th width="27">harga+ppn</th>
            <th width="174">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <tr>
          </tr>
        </tbody>
      </table>

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





