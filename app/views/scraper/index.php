<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <table class=" table" style="margin-top: 2rem;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Url</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 0; ?>
                <?php foreach ($_SESSION['links'] as $index => $l) : ?>
                    <tr style="font-size: 0.75rem;">
                        <th scope="row" style="padding:0 3px;"><?= ++$i ?></th>
                        <td style="padding:0 3px;"><?= $l; ?></td>
                        <td class="button-td" style="padding:2px 3px;">
                            <a href="<?= url('scraper/getContent/' . $index) ?>" class="btn btn-sm btn-info btn-detail btn-proses" target="_blank">Proses</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    let btnProses = document.querySelector('.btn-proses');
    console.log(btnProses);
    setInterval(() => {
        btnProses.click();
        window.location.reload();
    }, 2000);
</script>
<?php view('template/footer'); ?>