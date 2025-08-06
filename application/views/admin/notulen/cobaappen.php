<?php

foreach ($_POST['nomor'] as $i)

{
    /*query insert ke database taruh disini

    mysql_query = "insert into tbl_barang (kd_brng,nm_brng,hrga)

    values('$_POST['kode_barang_'.$i]','$_POST['nama_barang_'.$i]','$_POST['harga_barang_'.$i]')";

    */
    echo '<tr>
    <td>'.$_POST['kode_barang_'.$i].'</td>
    <td>'.$_POST['nama_barang_'.$i].'</td>
    <td>'.$_POST['harga_barang_'.$i].'</td>
    </tr>';
}
?>
