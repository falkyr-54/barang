<form action="<?php echo base_url() ?>barang_masuk/tambah" method="post">
    <div class="row">
        <div class="form-group">
            <div class="col-xs-2">
                <label for="">Hari/Tgl</label>
            </div>
            <div class="col-xs-4">
                <input type="date" name="tgl_datang" class="form-control" value="<?php echo set_value('tgl_datang') ?>">
            </div>

            <div class="clearfix"></div>
        </div>

        <div class="form-group">
            <div class="col-xs-2">
                <label for="">Nama Rekanan</label>
            </div>
            <div class="col-xs-4">
                <select name="id_rekanan" id="" class="form-control select">
                    <option value="">Pilih Rekanan</option>
                    <?php foreach ($data_rekanan as $key => $value): ?>
                        <option value="<?php echo $value->id_rekanan ?>"><?php echo $value->nama_rekanan ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <div class="clearfix"></div>
        </div>
        
    </div>


    <div align="right">
        <a class="btn btn-success btn-sm" id="btnAddRow"><i class="fa fa-plus"></i></a>
    </div>

    <div class="table-responsive">

        <table class="table table-hover table-bordered table-striped" id="tblAddRow">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Spesifikasi</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="first"></td>
                    <td>
                        <input type="text" name="nama_barang" class="form-control" value="<?php echo set_value('id_barang') ?>" placeholder="" required id="nama_barang">
                    </td>

                    <td>
                        <textarea name="speck[]" id="" cols="30" rows="5" class="form-control"></textarea>  
                    </td>


                    <td>
                        <input type="text" class="form-control " name="jumlah[]" >
                    </td>

                    <td>
                        <input type="text" class="form-control " name="harga[]" >
                    </td>

                    <td>
                        <input type="text" class="form-control " name="keterangan[]" >
                    </td>

                </tr>
            </tbody>
        </table>
    </div>
    <br>
    <tr id="button">
        <td colspan="8" align="right">
            <input type="submit" class="btn btn-primary " value="Simpan">
        </td>
    </tr>
</form>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery-2.2.3.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery-ui.js"></script>

<!-- angular controller -->


<script>
// Add button Delete in row
$('tbody tr')
.find('td')
    //.append('<input type="button" value="Delete" class="del"/>')
    .parent() //traversing to 'tr' Element
    .append('<td><a href="#" class="delrow">Delete Row</a></td>');

// For select all checkbox in table
$('#checkedAll').click(function (e) {
    //e.preventDefault();
    $(this).closest('#tblAddRow').find('td input:checkbox').prop('checked', this.checked);
});


// Add row the table
$('#btnAddRow').on('click', function() {
    var lastRow = $('#tblAddRow tbody tr:last').html();
    //alert(lastRow);
    $('#tblAddRow tbody').append('<tr>' + lastRow + '</tr>');
    $('#tblAddRow tbody tr:last input').val('');
});


// Delete last row in the table
$('#btnDelLastRow').on('click', function() {
    var lenRow = $('#tblAddRow tbody tr').length;
    //alert(lenRow);
    if (lenRow == 1 || lenRow <= 1) {
        alert("Can't remove all row!");
    } else {
        $('#tblAddRow tbody tr:last').remove();
    }
});

// Delete row on click in the table
$('#tblAddRow').on('click', 'tr a', function(e) {
    var lenRow = $('#tblAddRow tbody tr').length;
    e.preventDefault();
    if (lenRow == 1 || lenRow <= 1) {
        alert("Can't remove all row!");
    } else {
        $(this).parents('tr').remove();
    }
});

// Delete selected checkbox in the table
$('#btnDelCheckRow').click(function() {
    var lenRow      = $('#tblAddRow tbody tr').length;
    var lenChecked  = $("#tblAddRow input[type='checkbox']:checked").length;
    var row = $("#tblAddRow tbody input[type='checkbox']:checked").parent().parent();
    //alert(lenRow + ' - ' + lenChecked);
    if (lenRow == 1 || lenRow <= 1 || lenChecked >= lenRow) {
        alert("Can't remove all row!");
    } else {
        row.remove();
    }
});

    $(function() {                     
        $( "#nama_barang" ).autocomplete({ 
    //the recipient text field with id #username
    source: function( request, response ) {
        $.ajax({
            url: "<?php echo base_url('admin/barang_masuk/getbarang') ?>",
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
        $("#id_barang").val(ui.item.value);
    },

});
    }); 
</script>

