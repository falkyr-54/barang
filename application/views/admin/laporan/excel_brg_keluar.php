<?php 

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=Laporan Barang dari $tmt sampai $tmtdua.xls");

header("Pragma: no-cache");

header("Expires: 0");

?>

<h1>Laporan Cetak <?php echo $nama['nama_jenis'].' '.date('d-m-Y',strtotime($tmt)).' Sampai '.date('d-m-Y',strtotime($tmtdua)) ?></h1>


 <table id="example1" class="table table-bordered table-striped">
            <thead>

             <tr class="bg-primary">
               <th width="37">No</th>
               <th width="138">Nama Barang</th>
               <th width="138">Jenis Barang</th>
               <th width="138">Satuan</th>
               <th width="138">Harga</th>
               <!-- <th width="138">Stok <?php echo $this->tanggal->romawi($bulan).' '.$tahun ?></th> -->
               <th width="138">Barang masuk</th>
               <th width="138">Pemakaian barang</th>
               <th width="375">Stok tersedia</th>
               <th width="375">harga sisa stok</th>
             </tr>
           </thead>

           <tbody>
            <?php 
            $i=1; foreach ($brg as $brg) {

              $id_barang   = $brg['id_barang_masuk'];
              $jml_masuk   = $this->Brg_masuk_model->get_jumlah_stok($id_barang,$tmt,$tmtdua);
              $jml_keluar  = $this->Brg_keluar_model->get_jumlah_stok($id_barang,$tmt,$tmtdua);
              
              $masuk  = $jml_masuk['total'];
              $keluar = $jml_keluar['total'];
              $hasil  = $jml_masuk['total'] - $jml_keluar['total'];


              $total_masuk   = $this->Brg_masuk_model->get_jumlah_msk($id_barang);
              $total_keluar  = $this->Brg_keluar_model->get_jumlah_klr($id_barang);
              $update  = $total_masuk['total'] - $total_keluar['total'];

              ?>
              <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $brg['nama_barang'] ?></td>
                <td><?php echo $brg['nama_jenis'] ?></td>
                <td><?php echo $brg['satuan'] ?></td>
                <td><?php echo 'Rp'.number_format($brg['harga'],0,',','.') ?></td>
                <!-- <td>
                  <?php if ($hasil<0) {
                    echo "0";
                  }else{ 
                    echo $hasil;
                  }
                  ?></td> -->
                  
                  <td> <?php if ($masuk==null) {
                    echo "0";
                  }else{ 
                    echo $masuk;
                  }
                  ?></td>
                  
                  <td><?php echo $keluar ?></td>
                  <td><?php echo $update ?></td>
                  <td><?php echo 'Rp'.number_format($brg['harga']*$update,0,',','.') ?> </td>
                </tr>
                <?php $i++; } ?> 
              </tbody>
            </table>
  </table>
</div>
</div>