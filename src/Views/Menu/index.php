<!-- Include -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\nestable') ?>
<?= $this->include('agungsugiarto\boilerplate\Views\load\select2') ?>
<?= $this->include('agungsugiarto\boilerplate\Views\load\iconpicker') ?>
<!-- Extend from layout index -->
<?= $this->extend('agungsugiarto\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <?= $this->include('agungsugiarto\boilerplate\Views\Menu\update') ?>
    <style>.fade.in{opacity: 1;}</style>
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary card-outline">
                <div id="nestable-menu" class="card-header">
                    <div class="btn-group">
                        <button class="btn btn-info btn-sm tree-tools" data-action="expand" title="Expand">
                            <i class="fas fa-chevron-down"></i>&nbsp;<?= lang('menu.expand') ?>
                        </button>
                        <button class="btn btn-info btn-sm tree-tools" data-action="collapse" title="Collapse">
                            <i class="fas fa-chevron-up"></i>&nbsp;<?= lang('menu.collapse') ?>
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm save" data-action="save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;<?= lang('menu.save') ?></span></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm refresh" data-action="refresh" title="Refresh"><i class="fas fa-sync-alt"></i><span class="hidden-xs">&nbsp;<?= lang('menu.refresh') ?></span></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="dd" id="menu"></div>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-7">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="float-left">
                        <h5><?= lang('menu.add') ?></h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?= route_to('admin/menu') ?>" method="post" class="form-horizontal">
                        <?= csrf_field() ?>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('menu.parent') ?></label>
                            <div class="col-sm-10">
                                <select class="form-control parent" name="parent_id" style="width: 100%;">
                                    <option selcted value="0">ROOT</option>
                                    <?php foreach($menus as $menu) : ?>
                                        <option <?= ($menu->id == old('parent')) ? 'selected' : '' ?> value="<?= $menu->id ?>"><?= $menu->title ?></option>
                                    <?php endforeach ?>
                                </select>
                                <span class="help-block">
                                    <i class="fas fa-exclamation-triangle"></i>&nbsp;<?= lang('menu.warning_parent') ?>
                                </span>
                                <?php if (session('error.parent')) : ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.parent') ?></h6>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('menu.active') ?></label>
                            <div class="col-sm-10">
                                <!-- <input type="text" class="form-control" id="inputSkills" placeholder="Skills"> -->
                                <select class="form-control parent" name="active" style="width: 100%;">
                                    <option selected value="1"><?= lang('menu.active') ?></option>
                                    <option value="0"><?= lang('menu.non_active') ?></option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('menu.icon') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
                                    </div>
                                    <input type="text" name="icon" class="icon-picker form-control <?php if (session('error.icon')) { ?>is-invalid<?php } ?>" value="<?= old('icon') ?>" placeholder="<?= lang('menu.place_icon') ?>" autocomplete="off">
                                    <?php if (session('error.icon')) : ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.icon') ?></h6>
                                    </div>
                                    <?php endif ?>
                                </div>
                                <span class="help-block">
                                    <i class="fa fa-info-circle"></i>&nbsp;<?= lang('menu.info_icon') ?> <a href="http://fontawesome.io/icons" target="_blank">http://fontawesome.io/icons</a>
                                </span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName" class="col-sm-2 col-form-label"><?= lang('menu.title') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                    </div>
                                    <input type="text" name="title" class="form-control <?php if (session('error.title')) { ?>is-invalid<?php } ?>" value="<?= old('title') ?>" placeholder="<?= lang('menu.place_title') ?>" autocomplete="off">
                                    <?php if (session('error.title')) : ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.title') ?></h6>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('menu.route') ?></label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-link"></i></span>
                                    </div>
                                    <input type="text" name="route" class="form-control <?php if (session('error.route')) { ?>is-invalid<?php } ?>" value="<?= old('route') ?>" placeholder="<?= lang('menu.place_route') ?>" autocomplete="off">
                                    <?php if (session('error.route')) : ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.route') ?></h6>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"><?= lang('menu.role') ?></label>
                            <div class="col-sm-10">
                                <select multiple="multiple" class="form-control parent" name="groups_menu[]" data-placeholder="<?= lang('menu.select_role') ?>" style="width: 100%;">
                                    <?php foreach($roles as $role) : ?>
                                        <option <?= in_array($role->id, old('groups_menu', [])) ? 'selected' : '' ?> value="<?= $role->id ?>"><?= $role->name ?></option>
                                    <?php endforeach ?>
                                </select>
                                <?php if (session('error.role')) : ?>
                                    <h6 class="text-danger"><?= session('error.role') ?></h6>
                                <?php endif ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-sm btn-primary"><?= lang('menu.save') ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
$(function () {
    $('.icon-picker').iconpicker({
        placement: 'bottomRight',
        hideOnSelect: true,
    });
    $('.parent').select2();

    $.get("<?= base_url('admin/menu') ?>", function(response) {
        $('.dd').nestable({
            maxDepth: 2,
            json: response.data,
            contentCallback: (item) => {
                return `<i class="fa ${item.icon}"></i>&nbsp;<strong>${item.title}</strong>&nbsp;&nbsp;&nbsp;<a href="<?= base_url() ?>/${item.route}" class="dd-nodrag">${item.route}</a>
                        <span class="float-right dd-nodrag">
                            <button data-id="${item.id}" id="btn-update" class="btn btn-primary btn-xs"><span class="fa fa-fw fa-pencil-alt"></span></button>
                            <button data-id="${item.id}" id="btn-delete" class="btn btn-danger btn-xs"><span class="fa fa-fw fa-trash"></span></button>
                        </span>`;
            }
        });
    });

    $('.tree-tools').on('click', function(e) {
        var action = $(this).data('action');
        if (action === 'expand') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse') {
            $('.dd').nestable('collapseAll');
        }
    });

    $('.save').click(function () {
        var serialize = $('#menu').nestable('serialize');
        // $.post('http://admin.laravel.local/admin/auth/menu', {
        //     _token: LA.token,
        //     _order: JSON.stringify(serialize)
        // },
        // function(data){
        //     $.pjax.reload('#pjax-container');
        //     toastr.success('Save succeeded !');
        // });
        location.reload(true);
        console.log(JSON.stringify(serialize));
    });

    $('.refresh').on('click', function (e) {
        location.reload(true);
    });

    $(document).on('click', '#btn-update', (e) => {
        e.preventDefault();
        $('#modal-update').modal('show');
    })

    $(document).on('click', '#btn-delete', (e) => {
        e.preventDefault();
        $('#modal-update').modal('show');
    })
})
</script>
<?= $this->endSection() ?>