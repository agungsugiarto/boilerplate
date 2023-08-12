<!-- Include duallistbox-->
<?= $this->include('julio101290\boilerplate\Views\load\duallistbox') ?>
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
                        <a href="<?= base_url('admin/role') ?>" class="btn btn-sm btn-block btn-secondary"><i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url('admin/role/'.$role->id) ?>/update" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="put" />
                    <div class="col-md-10">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('boilerplate.role.fields.name') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" name="name" class="form-control <?= session('error.name') ? 'is-invalid' : '' ?>" value="<?= $role->name ?>" placeholder="<?= lang('boilerplate.role.fields.plc_name') ?>">
                                    <?php if (session('error.name')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.name') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('boilerplate.role.fields.description') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="far fa-comment-alt"></i></span>
                                    </div>
                                    <textarea class="form-control <?= session('error.description') ? 'is-invalid' : '' ?>" name="description" value="<?= $role->description ?>" placeholder="<?= lang('boilerplate.role.fields.plc_description') ?>"><?= $role->description ?></textarea>
                                    <?php if (session('error.description')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.description') ?></h6>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('boilerplate.permission.title') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <select multiple="multiple" name="permission[]" title="permission[]">
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
                        </div>
                        <div class="float-right">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-sm btn-block btn-primary"><?= lang('boilerplate.global.save') ?></button>
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
        $('select[name="permission[]"]').bootstrapDualListbox();
    </script>
<?= $this->endSection() ?>

