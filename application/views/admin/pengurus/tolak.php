<!-- Button trigger modal -->

<!-- Modal -->


    <?php
    foreach ($listing as $item) { ?>
        <div class="modal fade" id="detailModal<?= $item['id_barang_keluar'] ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="detailModalLabel">Form Permintaan Barang</h4>
                    </div>
                    <div class="modal-body" style="padding: 20px;overflow-y:auto;">
                        <form action="<?php echo base_url('admin/pj_klaster') ?>" method="post">
                            <div class="form-group row">
                                <label for="nama_pegawai" class="col-sm-2 col-form-label">Nama Pegawai</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" disabled id="nama_pegawai" placeholder="Nama Pegawai" value="<?= $item['nama_lengkap'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" disabled id="nama_barang" placeholder="Nama Barang" value="<?= $item['nama_barang'] ?>" readonly>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="stok_barang" class="col-sm-2 col-form-label">Jumlah Permintaan Barang</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="jumlah_keluar" id="jumlah_keluar" placeholder="Jumlah Permintaan Barang" value="<?= $item['jumlah_keluar'] ?>" >
                                </div>
                            </div>

                            <div class="form-group row" hidden="">
                                <label for="stok_barang" class="col-sm-2 col-form-label">id Barang</label>
                                <div class="col-sm-2">
                                    <input type="text" class="form-control" name="id_barang_keluar" id="id_barang_keluar" placeholder="Jumlah Permintaan Barang" value="<?= $item['id_barang_keluar'] ?>" >
                                </div>

                            </div>

                            <div class="form-group row">
                                <div class="col-sm-10">

                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <!-- Tombol Setujui: hijau -->
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-check"></i> Setujui
                            </button>

                            <!-- Tombol Tolak: merah -->
                            <button type="button" class="btn btn-danger">
                                <i class="fa fa-times"></i> Tolak
                            </button>

                            <!-- Tombol Close: abu-abu, tidak submit -->
                            <button type="button" class="btn btn-default" data-dismiss="modal">
                                <i class="fa fa-close"></i> Close
                            </button>

                        </div>
                    </form>
                    <!-- End of form -->
                </div>
            </div>
        </div>
        <?php
    }
    ?>