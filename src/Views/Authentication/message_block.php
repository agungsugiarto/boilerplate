<?php if (session()->has('message')) { ?>
    <div class="alert alert-success">
        <?= session('message') ?>
    </div>
<?php } ?>

<?php if (session()->has('error')) { ?>
    <div class="alert alert-danger">
        <?= session('error') ?>
    </div>
<?php } ?>

<?php if (session()->has('errors')) { ?>
    <ul class="alert alert-danger">
    <?php foreach (session('errors') as $error) { ?>
        <li><?= $error ?></li>
    <?php } ?>
    </ul>
<?php } ?>
