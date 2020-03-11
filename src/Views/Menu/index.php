<!-- Include nestable -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\nestable') ?>
<!-- Extend from layout index -->
<?= $this->extend('agungsugiarto\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-lg-5">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <div class="btn-group">
                        <a class="btn btn-info btn-sm tree-5e684c12be4cb-tree-tools" data-action="expand" title="Expand">
                            <i class="fa fa-plus-square-o"></i>&nbsp;Expand
                        </a>
                        <a class="btn btn-info btn-sm tree-5e684c12be4cb-tree-tools" data-action="collapse" title="Collapse">
                            <i class="fa fa-minus-square-o"></i>&nbsp;Collapse
                        </a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-primary btn-sm tree-5e684c12be4cb-save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;Save</span></a>
                    </div>
                    <div class="btn-group">
                        <a class="btn btn-warning btn-sm tree-5e684c12be4cb-refresh" title="Refresh"><i class="fa fa-refresh"></i><span class="hidden-xs">&nbsp;Refresh</span></a>
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
                        <!-- <div class="col-md-9"> -->
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="name" class="form-control <?php if (session('error.name')) { ?>is-invalid<?php } ?>" value="<?= old('name') ?>" placeholder="Name for role">
                                        <div class="invalid-feedback">
                                            <?= session('error.name') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Description</label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                                        </div>
                                        <input type="text" name="description" class="form-control <?php if (session('error.description')) { ?>is-invalid<?php } ?>" value="<?= old('description') ?>" placeholder="Description for role">
                                        <div class="invalid-feedback">
                                            <?= session('error.description') ?>
                                        </div>
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
    $(document).ready(function() {
        menu();
    });

    function menu() {
        $.get("<?= base_url('admin/menu') ?>", function(response) {
            $('#menu').nestable({
                maxDepth: 2,
                json: response.data,
                contentCallback: function(item) {
                    return `<i class="fa ${item.icon}"></i>&nbsp;<strong>${item.title}</strong>&nbsp;&nbsp;&nbsp;<a href="<?= base_url() ?>${item.route}" class="dd-nodrag">${item.route}</a>
                            <span class="float-right">
                                <a href=<?= base_url('admin/menu/edit') ?>/${item.id}"><i class="fa fa-edit"></i></a>
                                <a href="javascript:void(0);" data-id="1" class="tree_branch_delete"><i class="fa fa-trash"></i></a>
                            </span>`;
                }
            });
        });
    }
    
</script>
<?= $this->endSection() ?>