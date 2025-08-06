<?php
// Check error
echo validation_errors('<div class="alert alert-warning">','</div>');

// Error upload file
if(isset($error)) {
	echo '<div class="alert alert-warning">'.$error.'</div>';	
}
?>

<form name="form1" method="post" action="<?php echo base_url('admin/notulen/edit/'.$notulen['id_notulen']) ?>" enctype="multipart/form-data">
    <div class="box box-primary">
        <div class="box-header with-border">

            <div class="col-md-12">
                <h3 class="box-title">Ubah Data Notulen</h3>
            </div>
            <br>
            <br>
            <div class="col-md-4">
                <div class="form-group has-warning">
                    <label>Hari/Tanggal</label>
                    <input type="text" name="tanggal" class="form-control datepicker" placeholder="tgl penyuluhan" value="<?php echo $notulen['tanggal'] ?>" required>
                </div>

                <div class="form-group has-warning">
                    <label>Waktu</label>
                    <input type="text" name="jam" class="form-control" placeholder="" value="<?php echo $notulen['jam'] ?>" required>
                </div>
            </div>

            <div class="col-md-4">
                <div class="form-group has-warning">
                    <label>Jenis Program</label>
                    <select class="form-control" name="id_program">
                        <option  value="">-Pilih Program-</option>
                        <?php foreach ($program as $program) { ?>
                        <option value="<?php echo $program['id_program'] ?>"
                            <?php if ($program['id_program']==$notulen['id_program'])
                            {
                             echo "selected";
                         } ?>>
                         <?php echo $program['nama'] ?>
                     </option>
                     <?php } ?>
                 </select>
             </div>

             <div class="form-group has-warning">
                <label>Tempat</label>
                <input type="text" name="tempat" class="form-control" placeholder="tempat" value="<?php echo $notulen['tempat'] ?>" id="tempat" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group has-warning">
                <label>Jenis Tempat</label>
                <input type="text" name="jenis_tempat" class="form-control" placeholder="" value="<?php echo $notulen['jenis_tempat'] ?>" id="jenis_tempat" readonly>
            </div>

            <div class="form-group has-warning">
                <label>Wilayah</label>
                <input type="text" name="wilayah" class="form-control" placeholder="wilayah" value="<?php echo $notulen['wilayah'] ?>" id="wilayah" readonly>
            </div>

            <div class="form-group has-warning" hidden="">
                <label>id tempat</label>
                <input type="text" name="id_tempat" class="form-control" placeholder="id_tempat" value="<?php echo $notulen['id_tempat'] ?>" id="id_tempat" readonly>
            </div>
        </div>
    </div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">

        <div class="col-md-12">
            <h3 class="box-title">Peserta Hadir</h3>
        </div>
        <br>
        <br>
        <div class="col-md-3">

           <div class="form-group has-warning">
            <label>Tokoh Masyarakat</label>
            <input type="text" name="tm" class="form-control a" id="tm" placeholder="" onchange="hitung();" value="<?php echo $notulen['tm'] ?>" required>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group has-warning">
            <label>Masyarakat Umum</label>
            <input type="text" name="mu" class="form-control b" id="mu" onchange="hitung();" placeholder="" value="<?php echo $notulen['mu'] ?>" required>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group has-warning">
            <label>Masyarakat Sekolah</label>
            <input type="text" name="ms" class="form-control c" id="ms" onchange="hitung();" placeholder="" value="<?php echo $notulen['ms'] ?>" required>
        </div>
    </div>

    <div class="col-md-3">
        <div class="form-group has-warning">
            <label>Jumlah Peserta hadir</label>
            <input type="text" name="total_hadir" class="form-control d" id="total_hadir" placeholder="" value="<?php echo $notulen['total_hadir'] ?>" readonly>
        </div>
    </div>
</div>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <div class="col-md-12">
            <h3 class="box-title">Notulensi</h3>
        </div>
        <br>
        <br>
        <div class="col-md-4">
            <div class="form-group has-warning">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul penyuluhan" value="<?php echo $notulen['judul'] ?>" required>
            </div>

            <div class="form-group has-warning">
                <label>Nama Pemateri</label>
                <input type="text" name="pemateri" class="form-control" placeholder="Pemateri penyuluhan" value="<?php echo $notulen['pemateri'] ?>" required>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group has-warning">
                <label>Nama Pendamping/Notulen</label>
                <input type="text" name="pendamping" class="form-control" placeholder="Isi pendamping penyuluhan" value="<?php echo $notulen['pendamping'] ?>" required>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label>Notulensi</label>
                <textarea name="notulensi" class="form-control" placeholder="isi notulensi ketik disini" style="margin: 0px -19.0156px 0px 0px; height: 178px; width: 344px;"><?php echo $notulen['notulensi'] ?></textarea>
            </div>         
        </div>
    </div>
</div>

<div class="col-md-12">

    <div class="table-repsonsive">
     <span id="error"></span>
     <table class="table table-bordered" id="item_table">
      <tr>
       <th>Nama</th>
       <th>Umur</th>
       <th>Pertanyaan</th>
       <th>Jawaban</th>
       <th><button type="button" name="add" class="btn btn-success btn-sm add"><span class="glyphicon glyphicon-plus"></span></button>
       </th>
   
   
       <?php foreach ($diskusi as $diskusi) { ?>
       <tr>
        <td><input type="text" name="nama[]" class="form-control nama" value="<?php echo $diskusi['nama'] ?>"></td>
        <td><input hidden="" type="text" name="id_diskusi[]" class="form-control nama" value="<?php echo $diskusi['id_diskusi'] ?>"></td>

        <td><input type="text" name="umur[]" class="form-control umur" value="<?php echo $diskusi['umur'] ?>"></td>
        <td><input type="text" name="pertanyaan[]" class="form-control pertanyaan" value="<?php echo $diskusi['pertanyaan'] ?>"></td>
        <td><input type="text" name="jawaban[]" class="form-control jawaban" value="<?php echo $diskusi['jawaban'] ?>"></td>
        <td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td>
    </tr>
    <?php } ?>

</table>
</div>
</div>


<div class="col-md-6">
    <div class="form-group">
        <input type="submit" name="submit" value="Simpan" class="btn btn-success btn-lg">
        <input type="reset" name="reset" value="Reset" class="btn btn-default btn-lg">
    </div>
</div>
</div>
</form>

<script>
    $(function() {
      $( ".datepicker" ).datepicker({
         changeYear: true,
         changeMonth: true,
         yearRange: "2010:<?php echo date('Y') ?>",
         dateFormat: "yy-mm-dd"
     });
  });
</script>

<script>
    $(function() {                     
    $( "#tempat" ).autocomplete({ //the recipient text field with id #username
        source: function( request, response ) {
            $.ajax({
                url: "<?php echo base_url('admin/notulen/gettempat') ?>",
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
            $("#id_tempat").val(ui.item.value);
            $("#jenis_tempat").val(ui.item.jenis);
            $("#wilayah").val(ui.item.wilayah);
        },

    });
}); 
</script>

<script>
    function hitung() {
        var a = $(".a").val();
        var b = $(".b").val();
        var c = $(".c").val();
        d = parseInt(a) + parseInt(b) + parseInt(c);
        $(".d").val(d);

    }
</script>

<script>
    $(document).ready(function(){
     $(document).on('click', '.add', function(){
      var html = '';

      html += '<tr>';
      html += '<td><input type="text" name="nama[]" class="form-control nama"></td>';
      html += '<td><input type="text" name="umur[]" class="form-control umur"></td>';
      html += '<td><input type="text" name="pertanyaan[]" class="form-control pertanyaan"></td>';
      html += '<td><input type="text" name="jawaban[]" class="form-control jawaban"></td>';
      html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="glyphicon glyphicon-minus"></span></button></td></tr>';
      $('#item_table').append(html);
  });

     $(document).on('click', '.remove', function(){
      $(this).closest('tr').remove();
  });

 });
</script>


