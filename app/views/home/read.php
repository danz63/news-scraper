<?php view('template/header'); ?>

<div class="main-news">
    <?php view('template/header-home'); ?>
    <main class="news-read">
        <div class="news-top">
            <h2><?= $news['judul']; ?></h2>
            <small class="desc-news"><?= $news['nama_situs'] . " : " . $news['waktu_publikasi']; ?></small>
            <img src="<?= $news['img']; ?>" alt="<?= $news['desc']; ?>">
            <small class="desc-photo"><?= $news['desc']; ?></small>
        </div>
        <div class="news-bottom">
            <?= $news['isi']; ?>
            <p>Artikel Asli : <a href="<?= $news['url']; ?>" target="_blank"><?= $news['judul']; ?></a></p>
        </div>
    </main>
</div>

<?php view('template/footer'); ?>