<?php view('template/header'); ?>

<div class="main">
    <div class="login-box">
        <h2 class="header-h" style="margin-top: 0.1em; text-align:center;">Form Login</h2>
        <form action="<?= url('home/login') ?>" method="POST">
            <label for="username"><b>Nama Pengguna</b></label>
            <input type="text" placeholder="Nama Pengguna" name="username" id="username" autocomplete="Off" required>
            <label for="pwd"><b>Kata Sandi</b></label>
            <input type="password" placeholder="Kata Sandi" name="pwd" id="pwd" required>
            <button type="submit" class="btn btn-primary" name="login">Masuk</button>
            <button type="reset" class="btn btn-warning">Reset</button>
        </form>
    </div>
</div>

<?php view('template/footer'); ?>