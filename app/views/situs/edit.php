<!-- Modal content -->
<div class="modal-content">
    <div class="modal-header">
        <span id="btnCloseModal" onclick="closeModal();">&times;</span>
        <h2>Ubah Data Situs</h2>
    </div>
    <div class="modal-body">
        <form action="<?= url('situs/update/' . $situs['id']); ?>" class="form" method="POST">
            <hr>
            <label for="nama_situs">
                <b>Nama Situs</b> <span class="text-danger">*</span>
            </label>
            <input type="text" placeholder="Contoh : Kompas" name="nama_situs" id="nama_situs" value="<?= $situs['nama_situs']; ?>" required>
            <label for="url">
                <b>Url</b> <span class="text-danger">*</span>
            </label>
            <input type="text" placeholder="Contoh : https://money.kompas.com" name="url" value="<?= $situs['url']; ?>" id="url" required>
            <label><b>Ekstraktor Isi Berita </b><span class="text-danger">*</span></label>
            <div class="box">
                <?php foreach ($ekstraktor as $e) : ?>
                    <label class="radio"><?= $e['nama'] ?>
                        <input type="radio" name="ekstraktor" value="<?= $e['id'] ?>" required>
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
            <small class="text-muted"><span class="text-danger">*</span> Harus Diisi</small>
            <hr>
            <div class="d-flex w-50">
                <button type="submit" class="btn btn-primary">Ubah</button>
            </div>
        </form>
    </div>
</div>