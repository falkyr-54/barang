        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title" >Cari laporan : </h3>
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
          </div>
        </div>
      </div><!-- /.box-body -->
      <div class="box-footer">
      </div><!-- /.box-footer -->
    </form>


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

<script>
  $(function() {                     
    $( "#unit" ).autocomplete({ //the recipient text field with id #username
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo base_url('admin/brg_keluar/getunit') ?>",
          dataType: "json",
          data: request,
          success: function(data){
            if(data.response == 'true') {
              response(data.message);
            }
          }
        });
      },
      minLength: 3,
      select: function( event, ui ) {
        event.preventDefault();
        $(this).val(ui.item.label);
        $("#id_unit").val(ui.item.value);
      },

    });
  }); 
</script>  