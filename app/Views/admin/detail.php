<?= $this->extend('admin/layout/template'); ?>
<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h2 class="mt-2">Detail Buku</h2>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/img/<?= $buku['Gambar_sampul']; ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $buku['judul']; ?></h5>
                            <p class="card-text"><b>Pengarang :</b> <?= $buku['pengarang']; ?></p>
                            <p class="card-text"><small class="text-muted"><b>Penerbit : </b> <?= $buku['penerbit']; ?></small></p>
                            <a href="/AdminController/edit/<?= $buku['id_buku']; ?>" class="btn btn-warning">Edit</a>
                            <!-- HTTP SPOOFING delete-->
                            <form action="/AdminController/<?= $buku['id_buku']; ?>" method="POST" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin ?')">Delete</button>
                            </form>
                            <br><br>
                            <a href="/AdminController">Kembali ke daftar Buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>