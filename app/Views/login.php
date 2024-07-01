<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Webpage Icon & Title -->
        
            <title>Login • Sekolah Kitsumyuzu Utama</title>
            
            <link rel="icon" href="<?= base_url('favicon.ico') ?>" type="image/x-icon">

        <!-- Requesting  -->

            <link rel="stylesheet" href="<?= base_url('Views/login.css') ?>">
            <link rel="stylesheet" href="<?= base_url('Vendor') ?>/plugins/fontawesome-free/css/all.min.css">

    </head>

    <body>

        <div class="box">

            <span class="borderline"></span>

            <form action="<?= base_url('/home/authentication_login/?') ?>" method="post">

                <div class="logo">

                    <img src="<?= base_url('Images') ?>/default.png" alt="icon">

                </div>

                <h2>Login</h2>

                <div class="inputBox">

                    <input type="text" name="account_input_username" maxlength="75" required autofocus>
                    <span>Username or Email</span>
                    <i></i>

                </div>

                <div class="inputBox">

                    <input type="password" name="account_input_password" maxlength="100" required>
                    <span>Password</span>
                    <i></i>

                </div>

                <div class="links">

                    <a href="#">Forgot Password!</a>

                </div>


                <!-- Submit -->

                    <?php if (session()->has('alert')): ?>

                        <div style="color: #ff0000;" class="alert alert-warning">

                            <?= session()->get('alert') ?>

                        </div>

                    <?php endif; ?>

                    <input type="submit" value="Login">

            </form>

        </div>

    </body>

</html>