<div class="topnav">
    <span>Christian Dian Fajar | Ekstraksi Web</span>
</div>
<?php if ($notif = getFlashData()) : ?>
    <div class="alert <?= $notif['type']; ?>">
        <span id="closeAlert">&times;</span>
        <strong><?= ucfirst($notif['type']); ?></strong> <?= $notif['msg']; ?>
    </div>
<?php endif; ?>