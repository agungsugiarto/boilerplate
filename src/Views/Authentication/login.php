<?= $this->extend('julio101290\boilerplate\Views\Authentication\index') ?>
<?= $this->section('content') ?>
<!-- /.login-logo -->
<div class="card">
  <div class="card-body login-card-body">
    <p class="login-box-msg"><?=lang('Auth.loginTitle')?></p>
    <?= $this->include('julio101290\boilerplate\Views\Authentication\message_block') ?>
    <form action="<?= base_url(route_to('login')) ?>" method="post">
      <?= csrf_field() ?>
      <?php if ($config->validFields === ['email']) { ?>
      <div class="input-group mb-3">
        <input type="email" name="login"
          class="form-control <?= session('error.login') || session('errors.login') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.email')?>" value="<?= old('login') ?>" autocomplete="off">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.login') ?>
        </div>
      </div>
      <?php } else { ?>
      <div class="input-group mb-3">
        <input type="text" name="login"
          class="form-control <?= session('error.login') || session('errors.login') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.emailOrUsername')?>" value="<?= old('login') ?>" autocomplete="off">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.login') ?>
        </div>
      </div>
      <?php } ?>
      <div class="input-group mb-3">
        <input type="password" name="password"
          class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.password')?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.password') ?>
        </div>
      </div>
      <div class="row">
        <?php if ($config->allowRemembering) { ?>
        <div class="col-8">
          <div class="icheck-primary">
            <input type="checkbox" name="remember" id="remember" <?= old('remember') ? 'checked' : '' ?> >
            <label for="remember">
              <?=lang('Auth.rememberMe')?>
            </label>
          </div>
        </div>
        <?php } ?>
        <!-- /.col -->
        <div class="col-4">
          <button type="submit" class="btn btn-primary btn-block"><?= lang('Auth.signIn') ?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p class="mb-1">
      <a href="<?= base_url(route_to('forgot')) ?>"><?=lang('Auth.forgotYourPassword')?></a>
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
