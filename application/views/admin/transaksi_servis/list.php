
<div class="box-header with-border">
    <a href="<?php echo base_url('admin/transaksi_servis/tambah') ?>" class="btn btn-sm btn-primary pull-left">
        <i class="fa fa-plus"></i> Tambah</a> 
    </div>

    <br>
    <div class="box-body">
        <table  id="example1" class="table table-bordered table-striped">
            <thead>
                <tr class="tengah">
                    <th rowspan="2" scope="col">No</th>
                    <th rowspan="2" scope="col">Nama Barang</th>
                    <th rowspan="2" scope="col">Kerusakan</th>
                    <th rowspan="2" scope="col">Tanggal servis</th>
                    <th colspan="2" scope="col" style="text-align:center">Petugas</th>
                    <th rowspan="2" scope="col">Status</th>
                    <th rowspan="2" scope="col">Tanggal Selesai</th>
                    <th colspan="2" scope="col" style="text-align:center">Petugas</th>
                    <th rowspan="2" scope="col">Perbaikan/Harga</th>
                    <th rowspan="2" scope="col">Action</th>
                </tr>
                <tr class="tengah">
                    <th width="11%" scope="col">Petugas IT</th>
                    <th width="3%" scope="col">Petugas Servis</th>
                    <th width="3%" scope="col">Petugas IT</th>
                    <th width="3%" scope="col">Petugas Servis</th>
                </tr>

            </thead>

            <tbody>
                <?php $i=1;foreach ($list as $list) { ?>
                   <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $list['merk'].' '.$list['type'] ?><br><?php echo $list['kd_barang'] ?><br><?php echo $list['nama_satker'].' '.$list['unit'] ?></td>
                    <td><?php echo $list['kerusakan'] ?></td>
                    <td><?php echo $list['tgl_servis'] ?></td>
                    <td><?php echo $list['pemberi_it'] ?></td>
                    <td><?php echo $list['penerima_servis'] ?></td>
                    <?php if ($list['status']=="proses"){ ?>
                       <td><span class="badge badge bg-red"><?php echo $list['status'] ?></span></td>
                   <?php }else{ ?>
                    <td><span class="badge badge bg-green"><?php echo $list['status'] ?></span></td>
                <?php } ?>
                <td><?php echo $list['tgl_selesai'] ?></td>
                <td><?php echo $list['penerima_it'] ?></td>
                <td><?php echo $list['pemberi_servis'] ?></td>
                <td><?php echo $list['keterangan'] ?><br>Biaya Servis :<?php echo $list['harga'] ?></td>
                <td>
                    <a href="<?php echo base_url('admin/transaksi_servis/ubah/'.$list['id_servis']) ?>" class="btn btn-warning btn-xs">update</a>
                    <a href="<?php echo base_url('admin/transaksi_servis/hapus/'.$list['id_servis']) ?>" class="btn btn-danger btn-xs remove">hapus</a>
                </td>

            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
</div>
