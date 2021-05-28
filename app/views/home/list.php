<?php view('template/header'); ?>

<div class="main-news">
    <?php view('template/header-home'); ?>
    <main class="news-list">
        <?php foreach ($news as $n) : ?>
            <div class="news-list-section border-bottom">
                <div class="section-image">
                    <img src="<?= $n['img']; ?>" alt="Random Image" class="img-thumbnail">
                    <p><small><?= $n['desc']; ?></small></p>
                </div>
                <div class="section-news">
                    <a href="<?= url('home/read/' . $n['id']) ?>">
                        <h4><?= $n['judul']; ?></h4>
                    </a>
                    <p><small><?= $n['waktu_publikasi']; ?></small></p>
                    <p><?= filterStrongText($n['sub_news']) ?> <a href="<?= url('home/read/' . $n['id']) ?>" class="read-more">Baca Selengkapnya</a></p>
                    <p>Artikel Asli : <a href="<?= $n['url'] ?>" class="read-more"><?= $n['nama_situs']; ?></a></p>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <a href="<?= url('home/list/' . ($page - 1)) ?>" class="direct">&lt; Prev</a>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $pagination; $i++) : ?>
                <?php if ($i == $page) : ?>
                    <a href="javascript:void(0)" class="active"><?= $i; ?></a>
                <?php else : ?>
                    <a href="<?= url('home/list/' . $i) ?>"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $pagination) : ?>
                <a href="<?= url('home/list/' . ($page + 1)) ?>" class="direct">Next &gt;</a>
            <?php endif; ?>
        </div>
    </main>
</div>

<?php view('template/footer'); ?>