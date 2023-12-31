<div class="row">
    <div class="col-12">
        <?php
        if (session()->getFlashdata('pesan')) {
            echo '<div class="alert alert-success">';
            echo session()->getFlashdata('pesan');
            echo '</div>';
        }
        ?>
        <table class="table table-bordered" id="datatablesSimple">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Cabang</th>
                    <th>Alamat</th>
                    <th>Coordinat</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; 
                foreach ($lokasi as $key => $value) { ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $value['nama_lokasi'] ?></td>
                        <td><?= $value['alamat_lokasi'] ?></td>
                        <td><?= $value['latitude'] ?>, <?= $value['longitude'] ?></td>
                        <td><img src="<?= base_url('foto/' . $value['foto_lokasi']) ?>" width="200px"></td>
                        <td>
                            <a href="<?= base_url('Lokasi/ruteLokasi/' . $value['id_lokasi']) ?>" class="btn btn-success"><i class="fa-solid fa-route"></i></a>
                            <?php if (session()->get('role') === 'admin') : ?>
                            <a href="<?= base_url('Lokasi/editLokasi/' . $value['id_lokasi']) ?>" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="<?= base_url('Lokasi/deleteLokasi/' . $value['id_lokasi']) ?>" class="btn btn-danger" onclick="return confirm('Yakin Hapus Data ?')"><i class="fa-solid fa-trash"></i></a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>