<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <div class="row border-top border-bottom">
            <div class="col border-right">
                <?php if (empty($byId)) : ?>
                    <form action="<?= url('ekstraktor/create'); ?>" class="form" method="POST" enctype="multipart/form-data">
                        <h2 class="content-title">Tambah Ekstraktor</h2>
                        <hr>
                        <label for="filename">
                            <b>Nama File</b> <span class="text-danger">*</span>
                        </label>
                        <input type="text" placeholder="Contoh : example_link" name="filename" id="filename" pattern="[^\s]+" required>
                        <label for="ekstraktor">
                            <b>File Ekstraktor</b> <span class="text-danger">**</span>
                        </label>

                        <input type="file" name="ekstraktor" id="ekstraktor" required>
                        <label for="info">
                            <b>Informasi</b> <span class="text-danger">**</span>
                        </label>
                        <textarea name="info" id="info" placeholder="Contoh : File digunakan untuk mengekstrak link situs tujuan" required></textarea>
                        <small class="text-muted">
                            <span class="text-danger">*</span> Nama Tidak boleh Mengandung Spasi</small>
                        <br>
                        <small class="text-muted">
                            <span class="text-danger">**</span> Hanya Ekstensi '.js' Yang Diterima</small>
                        <hr>
                        <div class="d-flex w-50">
                            <button type="submit" class="btn btn-primary btn-submit">Tambah</button>
                            <button type="reset" class="btn btn-warning btn-reset">Reset</button>
                        </div>
                    </form>
                <?php else : ?>
                    <form action="<?= url('ekstraktor/update/' . getIndex()); ?>" class="form" method="POST" enctype="multipart/form-data">
                        <h2 class="content-title">Update Ekstraktor</h2>
                        <hr>
                        <label for="filename">
                            <b>Nama File</b> <span class="text-danger">*</span>
                        </label>
                        <input type="text" placeholder="Contoh : example_link" name="filename" id="filename" pattern="[^\s]+" value="<?= $byId['nama']; ?>" required>
                        <label for="ekstraktor">
                            <b>File Ekstraktor</b> <span class="text-danger">**</span>
                        </label>
                        <input type="file" name="ekstraktor" id="ekstraktor" required>
                        <label for="info">
                            <b>Informasi</b> <span class="text-danger">**</span>
                        </label>
                        <textarea name="info" id="info" placeholder="Contoh : File digunakan untuk mengekstrak link situs tujuan" required><?= $byId['info']; ?></textarea>
                        <small class="text-muted">
                            <span class="text-danger">*</span> Nama Tidak boleh Mengandung Spasi</small>
                        <br>
                        <small class="text-muted">
                            <span class="text-danger">**</span> Hanya Ekstensi '.js' Yang Diterima</small>
                        <hr>
                        <div class="d-flex w-50">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="reset" class="btn btn-warning">Reset</button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
            <div class="col">
                <h2 class="content-title">Tabel Ekstraktor</h2>
                <hr>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nama File</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($ekstraktor) < 1) : ?>
                            <tr>
                                <th colspan="3">Data Kosong</th>
                            </tr>
                        <?php endif; ?>
                        <?php foreach ($ekstraktor as $e) : ?>
                            <tr>
                                <th scope="row"><?= array_search($e, $ekstraktor) + 1 ?></th>
                                <td><?= $e['nama']; ?></td>
                                <td class="button-td">
                                    <a href="<?= url('ekstraktor/index/' . $e['id']) ?>" class="btn btn-sm btn-success btn-edit">Edit</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php view('template/footer'); ?>