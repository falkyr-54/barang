<div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title"><?= $title ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Nama Pegawai</th>
                <th>Jumlah</th>
                <th>Status Validasi</th>
                <th>Tanggal Ambil</th>
              </tr>
            </thead>
            <tbody>
              <?php $no=1; foreach($barang_keluar as $row): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $row->nama_barang ?></td>
                <td><?= $row->nama_pegawai ?></td>
                <td><?= $row->jumlah_keluar ?></td>
                <td>
                  <?php if($row->status_validasi == 'valid'){ ?>
                      <span class="label label-success">Valid</span>
                  <?php } else { ?>
                      <span class="label label-danger">Belum Valid</span>
                  <?php } ?>
                </td>
                <td><?= date('d-m-Y', strtotime($row->tanggal_ambil)) ?></td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
    </div>
  </div>