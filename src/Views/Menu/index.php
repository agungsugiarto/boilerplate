<!-- Include nestable -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\nestable') ?>
<!-- select2 -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\select2') ?>
<!-- iconpicker -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\iconpicker') ?>
<!-- Extend from layout index -->
<?= $this->extend('agungsugiarto\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <style>
        .fade.in{
            opacity: 1;
        }
    </style>
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary card-outline">
                <div id="nestable-menu" class="card-header">
                    <div class="btn-group">
                        <button class="btn btn-info btn-sm" data-action="expand" title="Expand">
                            <i class="fas fa-chevron-down"></i>&nbsp;Expand
                        </button>
                        <button class="btn btn-info btn-sm" data-action="collapse" title="Collapse">
                            <i class="fas fa-chevron-up"></i>&nbsp;Collapse
                        </button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-primary btn-sm" data-action="save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;Save</span></button>
                    </div>
                    <div class="btn-group">
                        <button class="btn btn-warning btn-sm" data-action="refresh" title="Refresh"><i class="fas fa-sync-alt"></i><span class="hidden-xs">&nbsp;Refresh</span></button>
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
                    <h5>Create Menu</h5>
                </div>
                <div class="card-body">
                    <?= form_open('admin/role/create', ['method' => 'post']) ?>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Parent</label>
                                <div class="col-sm-8">
                                    <div class="input-group col">
                                        <select class="form-control parent" style="width: 100%;>
                                            <option selected="selected">Alabama</option>
                                            <option>Alaska</option>
                                            <option>California</option>
                                            <option>Delaware</option>
                                            <option>Tennessee</option>
                                            <option>Texas</option>
                                            <option>Washington</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?= session('error.name') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control <?php if (session('error.name')) { ?>is-invalid<?php } ?>" value="<?= old('name') ?>" placeholder="Name for role" autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= session('error.name') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Icon</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
                                        </div>
                                        <input type="text" name="description" class="icon-picker form-control <?php if (session('error.description')) { ?>is-invalid<?php } ?>" value="<?= old('description') ?>" placeholder="Description for role" autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= session('error.description') ?>
                                        </div>
                                    </div>
                                    <span class="help-block">
                                        <i class="fa fa-info-circle"></i>&nbsp;For more icons please see <a href="http://fontawesome.io/icons" target="_blank">http://fontawesome.io/icons</a>
                                    </span>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Route</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-link"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control <?php if (session('error.name')) { ?>is-invalid<?php } ?>" value="<?= old('name') ?>" placeholder="Name for role" autocomplete="off">
                                        <div class="invalid-feedback">
                                            <?= session('error.name') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div class="select2-blue" style="width: 100%">
                                            <select class="select2" multiple="multiple" data-placeholder="Select a State" data-dropdown-css-class="select2-blue" style="width: 100%;">
                                                <option>Alabama</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                        <div class="invalid-feedback">
                                            <?= session('error.name') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-10">
                                <div class="float-right">
                                    <div class="btn-group">
                                        <button type="submit" class="btn btn-sm btn-block btn-primary">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    <?= form_close() ?>
                </div>
            </div>
        </div>
        <!-- /.col-md-6 -->
    </div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    $('.icon-picker').iconpicker({
        placement: 'bottomRight',
        hideOnSelect: true,
        showFooter: false,
    });

    //Initialize Select2 Elements
    $('.select2').select2();
    $('.parent').select2();

    $.get("<?= base_url('admin/menu') ?>", function(response) {
        $('#menu').nestable({
            maxDepth: 2,
            json: response.data,
            contentCallback: function(item) {
                return `<i class="fa ${item.icon}"></i>&nbsp;<strong>${item.title}</strong>&nbsp;&nbsp;&nbsp;<a href="<?= base_url() ?>${item.route}" class="dd-nodrag">${item.route}</a>
                        <span class="float-right">
                            <a href=<?= route_to('admin/menu') ?>/${item.id}/edit"><i class="fa fa-edit"></i></a>
                            <a href="javascript:void(0);" data-id="1" class="tree_branch_delete"><span style="color:Tomato;"><i class="fa fa-trash"></i></span></a>
                        </span>`;
            }
        });
    });

    $('#nestable-menu').on('click', (e) => {
        var target = $(e.target);
        var action = target.data('action');

        switch (action) {
            case 'expand':
                $('#menu').nestable('expandAll');
                break;
            case 'collapse':
                $('#menu').nestable('collapseAll');
                break;
            case 'refresh':
                console.log('refresh');
                break;
            default:
                $('#menu').nestable('expandAll');
        }
    });
    
</script>
<?= $this->endSection() ?>