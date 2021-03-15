<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <h2 class="content-title">Table Sample</h2>
        <?php view('admin/table'); ?>
    </div>
</div>
<?php view('template/footer'); ?>