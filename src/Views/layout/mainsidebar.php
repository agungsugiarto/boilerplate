<aside class="main-sidebar <?= config('Boilerplate')->theme['sidebar']['border'] ? 'border-right' : ''?> sidebar-<?= config('Boilerplate')->theme['sidebar']['type'] ?>-<?= config('Boilerplate')->theme['sidebar']['links']['bg'] ?> elevation-<?= config('Boilerplate')->theme['sidebar']['shadow'] ?>">
    <a href="<?= route_to('/') ?>"
        class="brand-link <?= !empty(config('Boilerplate')->theme['sidebar']['brand']['bg']) ? 'bg-'.config('Boilerplate')->theme['sidebar']['brand']['bg'] : '' ?>">
        <span
            class="brand-logo bg-<?= config('Boilerplate')->theme['sidebar']['brand']['logo']['bg'] ?> elevation-<?= config('Boilerplate')->theme['sidebar']['brand']['logo']['shadow'] ?>">
            <?= config('Boilerplate')->theme['sidebar']['brand']['logo']['icon'] ?>
        </span>
        <span class="brand-text"><?= config('Boilerplate')->theme['sidebar']['brand']['logo']['text'] ?></span>
    </a>
    <div class="sidebar">
        <?php if (config('Boilerplate')->theme['sidebar']['user']['visible']) { ?>
        <div class="user-panel py-3 d-flex">
            <div class="image">
                <img src="http://localhost/adminlte3/dist/img/user2-160x160.jpg" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="<?= route_to('user-show') ?>" class="d-block"><?= user()->username ?></a>
            </div>
        </div>
        <?php } ?>
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent <?= config('Boilerplate')->theme['sidebar']['compact'] ? 'nav-compact' : '' ?>" data-widget="treeview"
                role="menu" data-accordion="false">
                <?php foreach (menu() as $parent) { ?>
                <li class="nav-item has-treeview menu-open">
                    <a href="<?= base_url($parent['route']) ?>" class="nav-link active">
                        <i class="nav-icon fas <?= $parent['icon']?>"></i>
                        <p>
                            <?= $parent['title'] ?>
                            <?php if (count($parent['children'])) { ?>
                            <i class="right fas fa-angle-left"></i>
                            <?php } ?>
                        </p>
                    </a>
                    <?php if (count($parent['children'])) { ?>
                    <ul class="nav nav-treeview">
                        <?php foreach ($parent['children'] as $child) { ?>
                        <li class="nav-item has-treeview">
                            <a href="<?= base_url($child['route']) ?>"
                                class="nav-link <?= current_url() == base_url($child['route']) ? 'active' : '' ?>">
                                <i class="far fa-circle nav-icon"></i>
                                <p><?= $child['title'] ?></p>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</aside>