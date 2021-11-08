<?= $this->extend("layouts/app") ?>

<?= $this->section("body") ?>

<div class="container" style="margin-top:20px;">
    <div class="row">
        <div class="col-sm-6">
            <div class="panel panel-primary">
                <div class="panel-heading">Admin Dashboard</div>
                <div class="panel-body">
                    <h1>Hello, <?= session()->get('name') ?></h1>
                    <div class="row">
                        <div class="col">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">id_buku</th>
                                        <th scope="col">Sampul</th>
                                        <th scope="col">Judul</th>
                                        <th scope="col">Pengarang</th>
                                        <th scope="col">Penerbit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($buku as $b) : ?>
                                        <tr>
                                            <th scope="row"><?= $b['id_buku']; ?></th>
                                            <td><?= $b['Gambar_sampul'] ?></td>
                                            <td><?= $b['judul'] ?></td>
                                            <td><?= $b['pengarang'] ?></td>
                                            <td><?= $b['penerbit'] ?></td>
                                        </tr>
                                    <?php endforeach; ?>

                        </div>

                    </div>
                    <h3><a href="<?= site_url('logout') ?>">Logout</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>