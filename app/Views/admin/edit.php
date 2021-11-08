<?= $this->extend('admin/layout/template'); ?>
<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Update Data Buku</h2>
            <!-- tambahkan enctype jika ada input data-->
            <form action="/AdminController/update/<?= $buku['id_buku']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <!-- slug input-->
                <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
                <!-- tempat simpan nama file lama-->
                <input type="hidden" name="sampulLama" value="<?= $buku['Gambar_sampul']; ?>">
                <!-- slug input end-->
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $buku['judul'] ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= (old('pengarang')) ? old('pengarang') : $buku['pengarang'] ?>">
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $buku['penerbit'] ?>">
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="gambar_sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <div class="col-sm-2">
                        <img src="/img/<?= $buku['Gambar_sampul']; ?>" class="img-thumbnail img-preview" id="imgk">
                        <label id="labs" for="Gambar_sampul" class="form-label"><?= $buku['Gambar_sampul']; ?></label>
                    </div>
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <input class="form-control form-control-sm <?= ($validation->hasError('Gambar_sampul')) ? 'is-invalid' : ''; ?>" id="Gambar_sampul" type="file" name="Gambar_sampul" onchange="showPreview(event);">
                            <!-- Tempatkan invalid feedback HARUSS setelah input-->
                            <div class="invalid-feedback">
                                <?= $validation->getError('Gambar_sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <button type=" submit" class="btn btn-primary">Update Data</button>
            </form>
            <?= $validation->listErrors() ?>
        </div>
    </div>
</div>
<?php $this->endSection() ?>