<?php
// Pesan notifikasi
echo validation_errors('<div class="alert alert-success">','</div>');
// Pesan sukses
if($this->session->flashdata('sukses')) {
  echo '<div class="alert alert-success">';
  echo $this->session->flashdata('sukses');
  echo '</div>';
}
?>

<p><a href="<?php echo base_url('admin/brg_masuk/tambah') ?>" class="btn btn-primary">
  <i class="fa fa-plus"></i> input barang masuk</a></p>

 <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Hari/Tanggal/jam</th>
      <th>Nama Barang</th>
      <th>Volume</th>
      <th>Harga</th>
      <th>Pihak Ketiga</th>
      <th>Spek</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($barang_masuk as $barang_masuk) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <?php 
      $day = date('D', strtotime($barang_masuk['tgl_datang']));
     ?>
      <td><?php echo $hari[$day] ?>, <?php echo date('d-m-Y',strtotime($barang_masuk['tgl_datang'])) ?></td>
      <td><?php echo $barang_masuk['nama_barang'] ?></td>
      <td><?php echo $barang_masuk['jumlah'] ?> <?php echo $barang_masuk['satuan'] ?></td>
      <td><?php echo $barang_masuk['harga'] ?></td>
      <td><?php echo $barang_masuk['nama_rekanan'] ?></td>
      <td><?php echo $barang_masuk['spesifikasi'] ?></td>
      <td> 
        <a href="<?php echo base_url('admin/brg_masuk/edit/'.$barang_masuk['id_barang_masuk']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/brg_masuk/delete/'.$barang_masuk['id_barang_masuk']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin menghapus jenis barang_masuk ini?')"><i class="fa fa-trash"></i></a>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
  <tfoot>
    <tr>
      <th>No.</th>
      <th>Hari/Tanggal/jam</th>
      <th>Nama Barang</th>
      <th>Volume</th>
      <th>Harga</th>
      <th>Pihak Ketiga</th>
      <th>Keterangan</th>
      <th>Action</th>
   </tr>
 </tfoot>
</table>