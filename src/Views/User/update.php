<!-- Include -->
<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-info">
            <div class="card-header">
                <div class="float-left">
                    <div class="btn-group">
                        <a href="<?= base_url(route_to('admin/user/manage')) ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/user/manage/' . $user['id']) ?>/update" method="post" class="form-horizontal">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="put" />
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('boilerplate.user.fields.active') ?></label>
                        <div class="col-sm-8">
                            <select class="form-control select" name="active" style="width: 100%;">
                                <option <?= $user['active'] == 1 ? 'selected' : '' ?> value="1"><?= lang('boilerplate.user.fields.active') ?></option>
                                <option <?= $user['active'] == 0 ? 'selected' : '' ?> value="0"><?= lang('boilerplate.user.fields.non_active') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Auth.email') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                </div>
                                <input type="email" name="email" class="form-control <?= session('error.email') ? 'is-invalid' : '' ?>" value="<?= $user['email'] ?>" placeholder="<?= lang('Auth.email') ?>" autocomplete="off">
                                <?php if (session('error.email')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.email') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('Auth.username') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="username" class="form-control <?= session('error.username') ? 'is-invalid' : '' ?>" value="<?= $user['username'] ?>" placeholder="<?= lang('Auth.username') ?>" autocomplete="off">
                                <?php if (session('error.username')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.username') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('boilerplate.user.firstname') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="firstname" class="form-control <?= session('error.firstname') ? 'is-invalid' : '' ?>" value="<?= $user['firstname'] ?>" placeholder="<?= lang('boilerplate.user.firstname') ?>" autocomplete="off">
                                <?php if (session('error.firstname')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.firstname') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('boilerplate.user.lastname') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                </div>
                                <input type="text" name="lastname" class="form-control <?= session('error.lastname') ? 'is-invalid' : '' ?>" value="<?= $user['lastname'] ?>" placeholder="<?= lang('boilerplate.user.firstname') ?>" autocomplete="off">
                                <?php if (session('error.lastname')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.lastname') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Auth.password') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="password" class="form-control <?= session('error.password') ? 'is-invalid' : '' ?>" placeholder="<?= lang('Auth.password') ?>" autocomplete="off">
                                <?php if (session('error.password')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.password') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('Auth.repeatPassword') ?></label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                </div>
                                <input type="password" name="pass_confirm" class="form-control <?= session('error.pass_confirm') ? 'is-invalid' : '' ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" autocomplete="off">
                                <?php if (session('error.pass_confirm')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.pass_confirm') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('boilerplate.permission.title') ?></label>
                        <div class="col-sm-8">
                            <select class="form-control select" name="permission[]" multiple="multiple" data-placeholder="<?= lang('boilerplate.permission.fields.plc_name') ?>" style="width: 100%;">
                                <?php foreach ($permissions as $value) { ?>
                                    <?php if (array_key_exists($value['id'], $permission)) { ?>
                                        <option value="<?= $value['id'] ?>" selected><?= $value['name'] ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <?php if (session('error.permission')) { ?>
                                <h6 class="text-danger"><?= session('error.permission') ?></h6>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('boilerplate.role.title') ?></label>
                        <div class="col-sm-8">
                            <select class="form-control select" name="role[]" multiple="multiple" data-placeholder="<?= lang('boilerplate.role.fields.plc_name') ?>" style="width: 100%;">
                                <?php foreach ($roles as $value) { ?>
                                    <?php if (array_key_exists($value->id, $role)) { ?>
                                        <option value="<?= $value->id ?>" selected><?= $value->name ?></option>
                                    <?php } else { ?>
                                        <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                    <?php } ?>
                                <?php } ?>
                            </select>
                            <?php if (session('error.role')) { ?>
                                <h6 class="text-danger"><?= session('error.role') ?></h6>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <div class="float-right">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-sm btn-block btn-primary">
                                        <?= lang('boilerplate.global.save') ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $('.select').select2();
</script>
<?= $this->endSection() ?>

