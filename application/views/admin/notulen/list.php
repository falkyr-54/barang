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

<p><a href="<?php echo base_url('admin/notulen/tambah') ?>" class="btn btn-primary">
  <i class="fa fa-plus"></i> Tambah Notulen</a></p>

 <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      <th>No.</th>
      <th>Hari/Tanggal/jam</th>
      <th>Tempat</th>
      <th>Judul Penyuluhan</th>
      <th>Nama Pemateri dan Pendamping</th>
      <th>Jumlah Peserta</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <?php $i=1; foreach($notulen as $notulen) { ?>
    <tr>
      <td><?php echo $i ?></td>
      <?php 
      $day = date('D', strtotime($notulen['tanggal']));
     ?>
      <td><?php echo $hari[$day] ?>, <?php echo date('d-m-Y',strtotime($notulen['tanggal'])) ?><br>jam <?php echo $notulen['jam'] ?> WIB</td>
      <td><?php echo $notulen['tempat'] ?></td>
      <td><?php echo $notulen['judul'] ?></td>
      <td><?php echo $notulen['pemateri'] ?><br><?php echo $notulen['pendamping'] ?></td>
      <td><?php echo $notulen['total_hadir'] ?></td>
      <td>  
        <a href="<?php echo base_url('admin/notulen/edit/'.$notulen['id_notulen']) ?>" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>

        <a href="<?php echo base_url('admin/notulen/delete/'.$notulen['id_notulen']) ?>" class="btn btn-primary btn-sm" onClick="return confirm('Yakin ingin menghapus jenis notulen ini?')"><i class="fa fa-trash"></i></a>

      </td>
    </tr>
    <?php $i++; } ?> 
  </tbody>
  <tfoot>
    <tr>
     <th>No.</th>
     <th>Hari/Tanggal/jam</th>
     <th>Tempat</th>
     <th>Judul Penyuluhan</th>
     <th>Nama Pemateri dan Pendamping</th>
     <th>Jumlah Peserta</th>
     <th>Action</th>
   </tr>
 </tfoot>
</table>