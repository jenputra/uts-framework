<?= $this->extend("admin/layout/template"); ?>
<?php $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col-8">
            <h2 class="my-3">Form Tambah Data Buku</h2>
            <!-- Form tambah data-->
            <!-- tambahkan enctype jika ada file upload-->
            <form action="/AdminController/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class=" row mb-3">
                    <label for="gambar_sampul" class="col-sm-2 col-form-label">Sampul</label>
                    <!-- image preview-->
                    <div class="col-sm-2">
                        <img src="/img/default.png" class="img-thumbnail img-preview" id="imgk">
                        <label id="labs" for="gambar_sampul" class="form-label"></label>
                    </div>
                    <div class="col-sm-8">
                        <div class="mb-3">
                            <input class="form-control form-control-sm <?= ($validation->hasError('gambar_sampul')) ? 'is-invalid' : ''; ?>" id="gambar_sampul" type="file" name="gambar_sampul" onchange="showPreview(event);">
                            <!-- Tempatkan invalid feedback HARUSS setelah input-->
                            <div class="invalid-feedback">
                                <?= $validation->getError('gambar_sampul'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="judul" class="col-sm-2 col-form-label">judul</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= old('judul'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('judul'); ?>
                        </div>
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="pengarang" class="col-sm-2 col-form-label">pengarang</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="pengarang" name="pengarang" value="<?= old('penerbit'); ?>">
                    </div>
                </div>
                <div class=" row mb-3">
                    <label for="penerbit" class="col-sm-2 col-form-label">penerbit</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                    </div>
                </div>

                <button type=" submit" class="btn btn-primary">Tambah Data</button>
            </form>
            <?= $validation->listErrors() ?>
        </div>
    </div>
</div>
<?php $this->endSection() ?>