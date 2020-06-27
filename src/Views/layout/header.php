<nav
    class="main-header navbar navbar-expand navbar-<?= config('Boilerplate')->theme['navbar']['bg'] ?> navbar-<?= config('Boilerplate')->theme['navbar']['type'] ?> <?= config('Boilerplate')->theme['navbar']['type'] ? '' : 'border-bottom-0' ?>">
    <ul class="nav navbar-nav">
        <li class="nav-item">
            <a class="nav-link sidebar-toggle" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <!-- Notifications Dropdown Menu -->
        <?php if (config('Boilerplate')->theme['navbar']['user']['visible']) { ?>
        <li class="nav-item">
            <a href="<?= route_to('user-profile') ?>" class="nav-link d-flex align-items-center">
                <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.2/dist/img/avatar.png"
                    class="avatar-img img-circle bg-gray mr-2 elevation-<?= config('Boilerplate')->theme['navbar']['user']['shadow'] ?>"
                    alt="<?= user()->username ?>" height="32">
                <?= user()->username ?>
            </a>
        </li>
        <?php } ?>
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-power-off"></i>
                <!-- <span class="badge badge-warning navbar-badge">15</span> -->
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <div class="card card-primary card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.2/dist/img/avatar.png" alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"><?= user()->username ?></h3>

                        <p class="text-muted text-center"><?= user()->email ?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <span><?= lang('boilerplate.user.fields.join') ?></span> 
                                <div class="float-right">
                                    <?= user()->created_at->toLocalizedString('MMM d, yyyy') ?>
                                </div>
                            </li>
                        </ul>

                        <a href="<?= route_to('logout') ?>" class="btn btn-primary btn-block"><b><?= lang('boilerplate.global.logout') ?></b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </li>
    </ul>
</nav>