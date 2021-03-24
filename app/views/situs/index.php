<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <div class="d-flex">
            <div>
                <h2 class="content-title">Tabel Situs</h2>
            </div>
            <div class="header-left">
                <a href="#" id="btnAdd" class="btn btn-sm btn-primary">Tambah Data</a>
            </div>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Situs</th>
                    <th scope="col">Url</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Kompas</td>
                    <td>https://bisnis.kompas.com</td>
                    <td class="button-td">
                        <a href="#" class="btn btn-sm btn-primary">Ekstrak</a>
                        <a href="#" class="btn btn-sm btn-info">Detail</a>
                        <a href="#" class="btn btn-sm btn-success">Edit</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="modal">
    <!-- Modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <span id="btnCloseModal">&times;</span>
            <h2>Tambah Data Situs</h2>
        </div>
        <div class="modal-body">
            <form action="<?= url('extraktor/create'); ?>" class="form">
                <hr>
                <label for="nama_situs">
                    <b>Nama Situs</b>
                    <span class="text-danger">*</span>
                </label>
                <input type="text" placeholder="Contoh : Kompas" name="nama_situs" id="nama_situs" required>
                <label for="url"><b>Url</b> <span class="text-danger">*</span></label>
                <input type="text" placeholder="Contoh : https://money.kompas.com" name="url" id="url" required>
                <small class="text-muted"><span class="text-danger">*</span> Harus Diisi</small>
                <hr>
                <div class="d-flex w-50">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </form>
        </div>
    </div>

</div>
<?php view('template/footer'); ?>