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
                <a href="#" id="btnAddSitus" class="btn btn-sm btn-primary btn-add">
                    Tambah Data
                </a>
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
                <?php if (count($sites) < 1) : ?>
                    <tr>
                        <th colspan="4">Data Kosong</th>
                    </tr>
                <?php endif; ?>
                <?php $i = 0; ?>
                <?php foreach ($sites as $s) : ?>
                    <tr>
                        <th scope="row"><?= array_search($s, $sites) + 1 ?></th>
                        <td><?= $s['nama_situs']; ?></td>
                        <td><?= $s['url']; ?></td>
                        <td class="button-td">
                            <a href="<?= url('situs/ekstrak/' . $s['id']) ?>" class="btn btn-sm btn-primary btn-extract">Ekstrak</a>
                            <a href="#" class="btn btn-sm btn-info btn-detail">Detail</a>
                            <a href="#" class="btn btn-sm btn-success btn-edit" data-id="<?= $s['id']; ?>">Edit</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div class="modal">
</div>
<script>
    let btnEdit = document.querySelectorAll('.btn-edit');
    btnEdit.forEach(e => {
        e.addEventListener('click', function() {
            let situs_id = this.getAttribute('data-id');
            ajax("<?= url('situs/edit/') ?>" + situs_id);
        });
    });
    document.getElementById('btnAddSitus').onclick = function() {
        ajax("<?= url('situs/add') ?>");
    }
</script>
<?php view('template/footer'); ?>