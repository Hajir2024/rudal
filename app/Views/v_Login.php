<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="shortcut icon" type="text/css" href="<?= base_url('public') ?>/img/rudal_1.png">
    <!-- Link ke SB Admin 2 CSS -->
    <link href="<?= base_url('public') ?>/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= base_url('public') ?>/css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body class="bg-gradient-primary">
    <div class="container">
        <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9 pt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <!-- Flash Message -->
                                    <?php if (session()->getFlashdata('error')) : ?>
                                        <div class="alert alert-danger">
                                            <?= session()->getFlashdata('error'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <form action="<?= base_url('Auth/attemptLogin'); ?>" method="post" class="user">
                                        <?= csrf_field(); ?>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control form-control-user"
                                                id="exampleInputUsername" autocomplete="off" placeholder="Masukkan Username" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" name="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Masukkan Password" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>
                                    <hr>
                                    <a href="<?= base_url('/'); ?>" class="text-decoration-none">&laquo; Kembali</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Link ke SB Admin 2 JS -->
    <script src="<?= base_url('public') ?>/vendor/jquery/jquery.min.js"></script>
    <script src="<?= base_url('public') ?>/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('public') ?>/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= base_url('public') ?>/js/sb-admin-2.min.js"></script>
</body>

<footer class="sticky-footer" style="position: fixed; bottom: 0; width: 100%; text-align: center;">
    <div class="container my-auto">
        <div class="copyright text-center" style="margin-bottom: -12px;">
            <span>Copyright &copy; RUDAL - <strong>2024</strong></span>
        </div>
    </div>
</footer>

</html>