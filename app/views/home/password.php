<?php view('template/header'); ?>
<?php view('template/sidebar'); ?>
<div class="content">
    <?php view('template/topnav'); ?>
    <div class="container">
        <div class="row">
            <div class="col border">
                <form action="<?= url('home/password'); ?>" class="form" method="POST">
                    <h2 class="content-title">Ubah Kata Sandi</h2>
                    <hr>
                    <label for="old_pass">
                        <b>Sandi Lama</b>
                    </label>
                    <input type="password" placeholder="*****" name="old_pass" id="old_pass" required>
                    <label for="new_pass">
                        <b>Sandi Baru</b>
                    </label>
                    <input type="password" placeholder="*****" name="new_pass" id="new_pass" required>
                    <label for="repeat_pass">
                        <b>Konfirmasi Sandi Baru</b>
                    </label>
                    <input type="password" placeholder="*****" name="repeat_pass" id="repeat_pass" required>
                    <div class="d-flex w-50">
                        <button type="submit" class="btn btn-primary btn-submit" name="submit">Ubah</button>
                        <button type="reset" class="btn btn-warning btn-reset">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    let alertSuccess = document.getElementsByClassName('success');
    if (alertSuccess.length > 0) {
        setTimeout(() => {
            window.location = `<?= url('home/logout') ?>`;
        }, 3000);
    }
</script>
<?php view('template/footer'); ?>