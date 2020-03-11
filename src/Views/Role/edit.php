<!-- Include duallistbox-->
<?= $this->include('agungsugiarto\boilerplate\Views\load\duallistbox') ?>
<!-- Extend from layout index -->
<?= $this->extend('agungsugiarto\boilerplate\Views\layout\index') ?>

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
                <div class="row">
                    <?= form_open('admin/role/update/'.$role->id, ['method' => 'post']) ?>
                        <div class="col-md-10">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control <?php if (session('error.name')) { ?>is-invalid<?php } ?>" value="<?= $role->name ?>" placeholder="Name for role">
                                        <div class="invalid-feedback">
                                            <?= session('error.name') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input class="form-control <?php if (session('error.description')) { ?>is-invalid<?php } ?>" name="description" value="<?= $role->description ?>" placeholder="Description for role"></input>
                                        <div class="invalid-feedback">
                                            <?= session('error.description') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Permission</label>
                                <div class="col-sm-10">
                                    <div class="input-group">
                                        <select multiple="multiple" name="permission[]" title="permission[]">
<<<<<<< HEAD
                                            <?php foreach ($permission as $key) { ?>
                                                <option value="<?= $key['id'] ?>" selected="selected"><?= $key['name'] ?></option>
                                            <?php } ?>
=======
                                            <?php foreach ($data as $d) { ?>
                                                <option value="<?= $d['id'] ?>"><?= $d['name'] ?></option>
                                            <?php } ?>
>>>>>>> 633cd2c19dd1354dec518e6845ee8ab61fb80114
                                        </select>
                                        <?php if (session('error.permission')) { ?>
                                             <?= session('error.permission') ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="float-right">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-sm btn-block btn-primary">
                                        Save
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
    <script>
        var demo = $('select[name="permission[]"]').bootstrapDualListbox();
    </script>
<?= $this->endSection() ?>

