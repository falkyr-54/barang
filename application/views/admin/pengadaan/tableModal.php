<!-- Button trigger modal -->
<?php
function formatTanggalIndo($tanggal)
{
    $bulan = [
        1 => 'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    $tgl = date('d', strtotime($tanggal));
    $bln = (int)date('m', strtotime($tanggal));
    $thn = date('Y', strtotime($tanggal));

    return $tgl . ' ' . $bulan[$bln] . ' ' . $thn;
}
?>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="width: 95%; height: auto; padding:0; margin:30px auto;">
        <div class="modal-content" style="height: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">List barang</h4>
            </div>
            <div class="modal-body" style="padding: 20px;overflow-y:auto;">
                <div class="table-responsive">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Nomor Seri</th>
                                <th>Tanggal Permintaan</th>
                                <th>Jumlah</th>
                                <th>Satker</th>
                                <th>Unit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($listing as $item) {

                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?= $item['nama_barang'] ?></td>
                                    <td><?= $item['seri'] ?></td>
                                    <td>
                                        <!-- format -->

                                        <?= formatTanggalIndo($item['tanggal_minta']) ?>
                                    </td>
                                    <td><?= $item['jumlah_keluar'] ?></td>
                                    <td><?= $item['nama_satker'] ?></td>
                                    <td><?= $item['unit'] ?></td>
                                    <td>

                                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#detailModal<?= $item['id_barang_keluar'] ?>" title="PROSES">
                                            <i class="fa fa-circle-o-notch"></i>
                                        </a>

                                    
                                        <!--   <a href="#" class="btn btn-danger btn-sm" onClick="return confirm('Apa anda ingin menghapus barang ini?')"><i class="fa fa-trash"></i></a> -->


                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>