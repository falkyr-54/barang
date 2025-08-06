
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

<table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>#</th>
        <th>Unit</th>
        <th>Jumlah PC/Komputer</th>
        <th>Jumlah Printer</th>
    </tr>
</thead>
<tbody>
    <?php $i=1; foreach($unit as $unit) { ?>
      <tr>
        <td><?php echo $i ?></td>
        <td>
            <a href="<?php echo base_url('admin/penempatan/list_unit_brg/'.$unit['id_unit'].'/'.$satker['id_satker']) ?>" class="btn btn-info btn-xs"><?php echo $unit['unit'] ?></a></td>
            <td><?php
            $id_unit    = $unit['id_unit'];
            $hitungpc   = $this->penempatan_model->hitungpc($id_unit);
            echo count($hitungpc).' Buah<br>'
            ?></td>
            <td><?php
            $id_unit    = $unit['id_unit'];
            $hitungpc   = $this->penempatan_model->hitungprinter($id_unit);
            echo count($hitungpc).' Buah<br>'
            ?></td>
        </tr>
        <?php $i++; } ?> 
    </tbody>
</table>