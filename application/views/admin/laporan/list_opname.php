        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title" >Cari laporan : </h3>
          </div>
          <div class="panel-body">

            <form class="form-horizontal" name="form1" method="post" action="<?php echo base_url('admin/laporan/tampil_opname/'.$id_jenis.'/'.$id_satker) ?>" enctype="multipart/form-data">


             <div class="box-body">

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Jenis Barang</label>
                <div class="col-sm-4">
                 <select name="id_jenis" class="form-control">
                   <option value="0">Pilih Jenis</option>       
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

                <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Puskesmas</label>
                <div class="col-sm-4">
                 <select name="id_jenis" class="form-control">
                   <option value="0">Pilih Satker</option>       
                   <?php foreach($satker as $satker) { ?>
                     <option value="<?php echo $satker['id_satker'] ?>"
                       <?php if(isset($_POST['id_satker']) && $_POST['id_satker']==$satker['id_satker']) { 
                        echo "selected"; } ?> 
                        >
                        <?php echo $satker['nama_satker'] ?></option>
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
