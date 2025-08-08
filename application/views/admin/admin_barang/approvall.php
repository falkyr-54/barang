<button type="button" class="btn btn-default btn-md" data-toggle="modal" data-target="#Approve<?php echo $klast['id_barang_keluar'] ?>">
    <?php if ($klast['status_validasi']=="belum"){ ?>
        <i class="fa  fa-calendar-minus-o btn btn-warning btn-md"> belum validasi PJ</i>
    <?php }elseif($klast['status_validasi']=="tolak_pj"){ ?>
        <i class="fa fa-calendar-times-o btn btn-danger btn-md"> di tolak PJ</i>
    <?php }elseif($klast['status_validasi']=="acc_pj"){ ?>
        <i class="fa fa-calendar-check-o btn btn-success btn-md"> acc PJ</i>
    <?php }elseif($klast['status_validasi']=="acc_p"){ ?>
        <i class="fa fa-calendar-check-o btn btn-info btn-md"> acc pengurus barang</i>
    <?php }elseif($klast['status_validasi']=="tolak_p"){ ?>
        <i class="fa fa-calendar-check-o btn btn-info btn-md"> di tolak pengurus barang</i>
    <?php } ?>
</button>

<?php 

$id_barang        = $klast['id_barang'];
$barang           = $this->Barang_model->detail($id_barang);
$jml_masuk        = $this->Brg_masuk_model->get_jumlah_masuk($id_barang);
$jml_keluar       = $this->Brg_keluar_model->get_jumlah_keluar($id_barang);
$hasil            = (int)$jml_masuk['total'] - (int)$jml_keluar['total'];

?>

<div class="modal fade" id="Approve<?php echo $klast['id_barang_keluar'] ?>" tabindex="-1" role="dialog"
    aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <form action="<?php echo base_url('admin/admin_barang/approve/' . $klast['id_barang_keluar']) ?>" method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Approve permintaan unit <?php echo $klast['unit'] ?>?</h4>
                    </div>

                    <div class="modal-body">
                        <h4>Stok barang : 
                            <input type="text" name="hasil" value="<?php echo $hasil ?>" style="width: 50px;" readonly> <?php echo $klast['satuan'] ?>
                        </h4>

                        <br>
                        <br>
                        <label>Permintaan barang :</label>
                        <input type="number" name="jumlah_keluar" class="form-control"
                        value="<?php echo $klast['jumlah_keluar'] ?>" style="width: 70px;">
                        <?php echo $klast['satuan'] ?>

                        <!-- Kirim juga periode jika dibutuhkan di controller -->
                        <input type="hidden" name="tmt" value="<?php echo $tmt ?>">
                        <input type="hidden" name="sampai" value="<?php echo $sampai ?>">
                    </div>


                    <div class="modal-footer">


                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Setujui</button>
                        <a href="<?php echo base_url('admin/admin_barang/tolak/' . $klast['id_barang_keluar'] . '/' . $tmt . '/' . $sampai) ?>"
                            class="btn btn-danger"><i class="fa fa-close"></i> Tolak</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>