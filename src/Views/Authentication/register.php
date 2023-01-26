<?= $this->extend('julio101290\boilerplate\Views\Authentication\index') ?>
<?= $this->section('content') ?>
<div class="card">
  <div class="card-body register-card-body">
    <p class="login-box-msg"><?=lang('Auth.register')?></p>
    <?= $this->include('julio101290\boilerplate\Views\Authentication\message_block') ?>
    <form action="<?= base_url(route_to('register')) ?>" method="post">
      <?= csrf_field() ?>
      <div class="input-group mb-3">
        <input type="text" name="username"
          class="form-control <?= session('errors.username') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.username')?>" value="<?= old('username') ?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-user"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.username') ?>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="email" name="email"
          class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.email')?>" value="<?= old('email') ?>">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-envelope"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.email') ?>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" name="password"
          class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.password')?>" autocomplete="off">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.password') ?>
        </div>
      </div>
      <div class="input-group mb-3">
        <input type="password" name="pass_confirm"
          class="form-control <?= session('errors.pass_confirm') ? 'is-invalid' : '' ?>"
          placeholder="<?=lang('Auth.repeatPassword')?>" autocomplete="off">
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-lock"></span>
          </div>
        </div>
        <div class="invalid-feedback">
          <?= session('errors.pass_confirm') ?>
        </div>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-12">
          <button type="submit" class="btn btn-primary btn-block"><?=lang('Auth.register')?></button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p><?=lang('Auth.alreadyRegistered')?> <a href="<?= base_url(route_to('login')) ?>"
        class="text-center"><?=lang('Auth.signIn')?></a></p>
  </div>
  <!-- /.form-box -->
</div><!-- /.card -->
<?= $this->endSection() ?>
