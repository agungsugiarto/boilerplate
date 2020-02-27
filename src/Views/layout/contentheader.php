<div class="content-header pt-2 pb-1">
    <div class="container-fluid">
        <div class="row mb-2 align-items-end">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">
                    <?= $title ?>
                    <?php if (isset($subtitle)) { ?>
                        <small class="font-weight-light ml-1 text-md"><?= $subtitle ?></small>
                    <?php } ?>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right text-sm">
                    <li class="breadcrumb-item">
                        <a href="<?= route_to('#') ?>">
                            <?= 'Home' ?>
                        </a>
                    </li>
                    <?php if (isset($breadcrumb)) { ?>
                        <?php foreach ($breadcrumb as $label => $route) { ?>
                        <?php if (is_numeric($label)) { ?>
                            <li class="breadcrumb-item active"><?= $route ?></li>
                        <?php } elseif (is_array($route)) { ?>
                            <li class="breadcrumb-item"><a href="<?= base_url($route[0], $route[1]) ?>"><?= $label ?></a></li>
                        <?php } else { ?>
                            <li class="breadcrumb-item"><a href="<?= base_url($route) ?>"><?= $label ?></a></li>
                        <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </ol>
            </div>
        </div>
    </div>
</div>
