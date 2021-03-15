<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <div class="row border-top border-bottom">
            <div class="col border-right">
                <form action="<?= url('extraktor/create'); ?>" class="form">
                    <h2 class="content-title">Tambah Ekstraktor</h2>
                    <hr>
                    <label for="filename"><b>Nama File</b> <span class="text-danger">*</span></label>
                    <input type="text" placeholder="Contoh : example_link" name="filename" id="filename" pattern="[^\s]+" required>
                    <label for="extractor"><b>File Ekstraktor</b> <span class="text-danger">**</span></label>
                    <input type="file" name="extractor" id="extractor" required>
                    <label for="info"><b>File Ekstraktor</b> <span class="text-danger">**</span></label>
                    <textarea name="info" id="info" placeholder="Contoh : File digunakan untuk mengekstrak link situs tujuan" required></textarea>
                    <small class="text-muted"><span class="text-danger">*</span> Nama Tidak boleh Mengandung Spasi</small>
                    <br>
                    <small class="text-muted"><span class="text-danger">**</span> Hanya Ekstensi '.js' Yang Diterima</small>
                    <hr>
                    <div class="d-flex w-50">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                        <button type="reset" class="btn btn-warning">Reset</button>
                    </div>
                </form>
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
                        <tr>
                            <th scope="row">1</th>
                            <td>kompas_url.js</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-success">Edit</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php view('template/footer'); ?>