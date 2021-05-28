<div class="topnav">
    <span>Christian Dian Fajar | Ekstraksi Web</span>
</div>
<?php if ($notif = getFlashData()) : ?>
    <div class="alert <?= $notif['type']; ?>">
        <span id="closeAlert">&times;</span>
        <strong><?= ucfirst($notif['type']); ?></strong> <?= $notif['msg']; ?>
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('closeAlert').click();
        }, 3000);
    </script>
<?php endif; ?>