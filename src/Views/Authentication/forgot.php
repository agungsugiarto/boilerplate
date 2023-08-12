<?= $this->extend('julio101290\boilerplate\Views\Authentication\index') ?>
<?= $this->section('content') ?>
<!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg"><?=lang('Auth.forgotPassword')?></p>
    <p class="login-box-msg"><?=lang('Auth.enterEmailForInstructions')?></p>
    <?= $this->include('julio101290\boilerplate\Views\Authentication\message_block') ?>
    <form action="<?= base_url(route_to('forgot')) ?>" method="post">
      <?= csrf_field() ?>
      <div class="input-group mb-3">
        <input type="email" name="email"
          class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.email')?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.email') ?>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.sendInstructions')?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p class="mt-3 mb-1">
      <a href="<?= base_url(route_to('login')) ?>"><?=lang('Auth.signIn')?></a>
    </p>
    <?php if ($config->allowRegistration) { ?>
    <p class="mb-0">
      <a href="<?= base_url(route_to('register')) ?>" class="text-center"><?=lang('Auth.needAnAccount')?></a>
    </p>
    <?php } ?>
  </div>
  <!-- /.login-card-body -->
</div>
<?= $this->endSection() ?>