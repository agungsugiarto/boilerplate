<div class="card <?= isset($tabs) ? ($outline ?? !dot_array_search('card.outline', config('Boilerplate')->theme)) ? 'card-outline-tabs' : 'card-tabs' : ''?> <?= ($outline ?? !dot_array_search('card.outline', config('Boilerplate')->theme)) ? 'card-outline' : '' ?> card-<?= $color ?? (dot_array_search('card.outline', config('Boilerplate')->theme) == 'info') ?>">
    <?php if ($title ?? $header ?? false) { ?>
        <div class="card-header <?= isset($tabs) ? ($outline ?? !dot_array_search('card.outline', config('Boilerplate')->theme)) ? 'p-0' : 'p-0 pt-1' : '' ?> border-bottom-0">
            <?php if (isset($header)) { ?>
                <?= $header ?>
            <?php } else { ?>
                <h3 class="card-title"><?= $title ?></h3>
                <?php if (isset($tools)) { ?>
                    <div class="card-tools">
                        <?= $tools ?>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="card-body <?= $title ?? false ? ($outline ?? !dot_array_search('card.outline', config('Boilerplate')->theme)) ? 'pt-0' : '' : '' ?>">
        <?= $slot ?>
    </div>
    <?php if (isset($footer)) { ?>
        <div class="card-footer">
            <?= $footer ?>
        </div>
    <?php } ?>
</div>
