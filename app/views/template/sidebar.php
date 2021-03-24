<?php $page = getActivePage(); ?>
<div class="sidebar">
    <div class="sidebar-brand">
        <div class="navbar-brand">
            <h2>NS</h2>
        </div>
    </div>
    <ul>
        <li>
            <a href="<?= url('home/index') ?>" <?= ($page == 'home/index') ? 'class=\'active\'' : '' ?>>Beranda</a>
        </li>
        <li>
            <a href="<?= url('ekstraktor/index') ?>" <?= ($page == 'ekstraktor/index') ? 'class=\'active\'' : '' ?>>Ekstraktor</a>
        </li>
        <li>
            <a href="<?= url('situs/index') ?>" <?= ($page == 'situs/index') ? 'class=\'active\'' : '' ?>>Situs</a>
        </li>
        <li>
            <a href="<?= url('log/index') ?>" <?= ($page == 'log/index') ? 'class=\'active\'' : '' ?>>Log</a>
        </li>
        <li>
            <a href="<?= url('pengguna/password') ?>" <?= ($page == 'pengguna/password') ? 'class=\'active\'' : '' ?>>Ubah Password</a>
        </li>
        <li>
            <a href="<?= url('pengguna/logout') ?>" <?= ($page == 'pengguna/logout') ? 'class=\'active\'' : '' ?>>Logout</a>
        </li>
    </ul>
</div>