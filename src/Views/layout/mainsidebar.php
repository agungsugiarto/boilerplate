<aside class="main-sidebar <?= config('Boilerplate')->theme['sidebar']['border'] ? 'border-right' : '' ?> sidebar-<?= config('Boilerplate')->theme['sidebar']['type'] ?>-<?= config('Boilerplate')->theme['sidebar']['links']['bg'] ?> elevation-<?= config('Boilerplate')->theme['sidebar']['shadow'] ?>">
    <a href="<?= route_to('/') ?>" class="brand-link <?= !empty(config('Boilerplate')->theme['sidebar']['brand']['bg']) ? 'bg-' . config('Boilerplate')->theme['sidebar']['brand']['bg'] : '' ?>">
        <img src="<?= base_url(config('Boilerplate')->theme['sidebar']['brand']['logo']['icon']) ?>" class="brand-image img-circle elevation-<?= config('Boilerplate')->theme['sidebar']['brand']['logo']['shadow'] ?>" style="opacity: .8">
        <span class="brand-text"><?= config('Boilerplate')->theme['sidebar']['brand']['logo']['text'] ?></span>
    </a>
    <div class="sidebar">
        <?php if (config('Boilerplate')->theme['sidebar']['user']['visible']) { ?>
            <div class="user-panel py-3 d-flex">
                <div class="image">
                    <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.2/dist/img/avatar.png" class="img-circle elevation-<?= config('Boilerplate')->theme['sidebar']['user']['shadow'] ?>"
                         alt="User Image">
                </div>
                <div class="info">
                    <a href="<?= base_url(route_to('user-profile')) ?>" class="d-block"><?= user()->username ?></a>
                </div>
            </div>
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" id="search" name="search" placeholder="<?= lang('boilerplate.global.search') ?>" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>

            </div>
        <?php } ?>
        <nav class="mt-3">
            <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent <?= config('Boilerplate')->theme['sidebar']['compact'] ? 'nav-compact' : '' ?>" data-widget="treeview"
                role="menu" data-accordion="false">
                    <?php foreach (menu() as $parent) { ?>
                    <li class="nav-item has-treeview <?= current_url() == base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route')) ? 'menu-open' : '' ?>">
                        <a href="<?= base_url($parent->route) ?>" class="nav-link <?= current_url() == base_url($parent->route) || in_array(uri_string(), array_column($parent->children, 'route')) ? 'active' : '' ?>">
                            <i class="nav-icon <?= $parent->icon ?>"></i>
                            <p>
                                <?= $parent->title ?>
                                <?php if (count($parent->children)) { ?>
                                    <i class="right fas fa-angle-left"></i>
                                <?php } ?>
                            </p>
                        </a>
                        <?php if (count($parent->children)) { ?>
                            <ul class="nav nav-treeview">
                                <?php foreach ($parent->children as $child) { ?>
                                    <li class="nav-item has-treeview">
                                        <a href="<?= base_url($child->route) ?>"
                                           class="nav-link <?= current_url() == base_url($child->route) ? 'active' : '' ?>">
                                            <i class="nav-icon <?= $child->icon ?>"></i>
                                            <p><?= $child->title ?></p>
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

<?= $this->section('js') ?>

<script>

    $(document).ready(function () {


        $("#search").on("keyup", function () {
            if (this.value.length > 0) {
                $(".nav-sidebar li").hide().filter(function () {
                    return $(this).text().toLowerCase().indexOf($("#search").val().toLowerCase()) != -1;
                }).show();
            } else {
                $(".sidebar-menu li").show();
            }
        });

    });

</script>


<?= $this->endSection() ?>