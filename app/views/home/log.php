<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <div class="d-flex">
            <div>
                <h2 class="content-title">Riwayat Scraping</h2>
            </div>
        </div>
        <hr>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pengguna</th>
                    <th scope="col">Situs</th>
                    <th scope="col">Waktu</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php if (isset($logs['username'])) : ?>
                    <tr>
                        <th scope="row"><?= ++$i ?></th>
                        <td><?= $logs['username']; ?></td>
                        <td><?= $logs['nama_situs']; ?></td>
                        <td><?= $logs['waktu']; ?></td>
                    </tr>
                <?php else : ?>
                    <?php foreach ($logs as $log) : ?>
                        <tr>
                            <th scope="row"><?= ++$i ?></th>
                            <td><?= $log['username']; ?></td>
                            <td><?= $log['nama_situs']; ?></td>
                            <td><?= $log['waktu']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?php view('template/footer'); ?>