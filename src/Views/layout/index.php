<!DOCTYPE html>
<html lang="<?= config('App')->defaultLocale ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="<?= csrf_token() ?>" content="<?= csrf_hash() ?>">
    <title><?= $title ?? '' ?> | <?= config('Boilerplate')->appName ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <!-- Sweetalert -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.min.css">
    <!-- Render section boilerplate css -->
    <?= $this->renderSection('css') ?>
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swap">

</head>

<body class="layout-fixed layout-navbar-fixed sidebar-mini <?= config('Boilerplate')->theme['footer']['fixed'] ? 'layout-footer-fixed' : '' ?> <?= config('Boilerplate')->theme['body-sm'] ? 'text-sm' : '' ?>">
<div class="wrapper">

    <!-- Navbar -->
    <?= $this->include('agungsugiarto\boilerplate\Views\layout\header') ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->include('agungsugiarto\boilerplate\Views\layout\mainsidebar') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <?= $this->include('agungsugiarto\boilerplate\Views\layout\contentheader') ?>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <?= $this->renderSection('content') ?>
            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <!-- <div class="p-3">
          <h5>Title</h5>
          <p>Sidebar content</p>
        </div> -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            <strong><a href="https://github.com/agungsugiarto/boilerplate">Boilerplate</a></strong>
        </div>
        <!-- Default to the left -->
        <strong>&copy; <?= date('Y') ?>
            <a href="<?= config('Boilerplate')->theme['footer']['vendorlink'] ?>"><?= config('Boilerplate')->theme['footer']['vendorname'] ?></a>.</strong> All rights reserved.
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- Preload Scriptt -->
<script>
    $('.sidebar-toggle').on('click', function (event) {
        event.preventDefault();
        if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            sessionStorage.setItem('sidebar-toggle-collapsed', '')
        } else {
            sessionStorage.setItem('sidebar-toggle-collapsed', '1')
        }
    });
    (function () {
        if (Boolean(sessionStorage.getItem('sidebar-toggle-collapsed'))) {
            var body = document.getElementsByTagName('body')[0];
            body.className = body.className + ' sidebar-collapse'
        }
    })()
</script>
<?php if (config('Boilerplate')->theme['dark-mode']) { ?>
    <script>
        // Use matchMedia to check the user preference
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)');

        toggleDarkTheme(prefersDark.matches);

        // Listen for changes to the prefers-color-scheme media query
        prefersDark.addListener((mediaQuery) => toggleDarkTheme(mediaQuery.matches));

        // Add or remove the "dark" class based on if the media query matches
        function toggleDarkTheme(shouldAdd) {
            document.body.classList.toggle('dark-mode', shouldAdd);
        }
    </script>
<?php } ?>
<!-- Render section boilerplate js -->
<?= $this->renderSection('js') ?>
<script>
    $.ajaxSetup({headers: {'<?= config('App')->CSRFHeaderName ?>': $('meta[name="<?= config('App')->CSRFTokenName ?>"]').attr('content')}})
</script>
<!-- Sweeat alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.7.2/dist/sweetalert2.all.min.js"></script>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        onOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    <?php if (session('sweet-success')) { ?>
    Toast.fire({
        icon: 'success',
        title: '<?= session('sweet-success.') ?>'
    });
    <?php } ?>
    <?php if (session('sweet-warning')) { ?>
    Toast.fire({
        icon: 'warning',
        title: '<?= session('sweet-warning.') ?>'
    });
    <?php } ?>
    <?php if (session('sweet-error')) { ?>
    Toast.fire({
        icon: 'error',
        title: '<?= session('sweet-error.') ?>'
    });
    <?php } ?>
</script>
</body>

</html>
