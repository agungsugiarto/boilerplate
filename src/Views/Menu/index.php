<!-- Include -->
<?= $this->include('julio101290\boilerplate\Views\load\nestable') ?>
<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\iconpicker') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<?= $this->include('julio101290\boilerplate\Views\Menu\update') ?>
<style>.fade.in{
    opacity: 1;
}</style>
<div class="row">
    <div class="col-lg-5">
        <div class="card card-primary card-outline">
            <div id="nestable-menu" class="card-header">
                <div class="btn-group">
                    <button class="btn btn-info btn-sm tree-tools" data-action="expand" title="Expand">
                        <i class="fas fa-chevron-down"></i>&nbsp;<?= lang('boilerplate.menu.expand') ?>
                    </button>
                    <button class="btn btn-info btn-sm tree-tools" data-action="collapse" title="Collapse">
                        <i class="fas fa-chevron-up"></i>&nbsp;<?= lang('boilerplate.menu.collapse') ?>
                    </button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-primary btn-sm save" data-action="save" title="Save"><i class="fa fa-save"></i><span class="hidden-xs">&nbsp;<?= lang('boilerplate.global.save') ?></span></button>
                </div>
                <div class="btn-group">
                    <button class="btn btn-warning btn-sm refresh" data-action="refresh" title="Refresh"><i class="fas fa-sync-alt"></i><span class="hidden-xs">&nbsp;<?= lang('boilerplate.menu.refresh') ?></span></button>
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
                    <h5><?= lang('boilerplate.menu.add') ?></h5>
                </div>
            </div>
            <div class="card-body">
                <form action="<?= base_url(route_to('admin/menu')) ?>" method="post" class="form-horizontal">
                    <?= csrf_field() ?>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('boilerplate.menu.fields.parent') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control parent" name="parent_id" style="width: 100%;">
                                <option selcted value="0">ROOT</option>
                                <?php foreach ($menus as $menu) { ?>
                                    <option <?= ($menu->id == old('parent_id')) ? 'selected' : '' ?> value="<?= $menu->id ?>"><?= $menu->title ?></option>
                                <?php } ?>
                            </select>
                            <span class="help-block">
                                <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;<?= lang('boilerplate.menu.fields.warning_parent') ?>
                            </span>
                            <?php if (session('error.parent_id')) { ?>
                                <div class="invalid-feedback">
                                    <h6><?= session('error.parent_id') ?></h6>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('boilerplate.menu.fields.active') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control parent" name="active" style="width: 100%;">
                                <option selected value="1"><?= lang('boilerplate.menu.fields.active') ?></option>
                                <option value="0"><?= lang('boilerplate.menu.fields.non_active') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('boilerplate.menu.fields.icon') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
                                </div>
                                <input type="text" name="icon" class="icon-picker form-control <?= session('error.icon') ? 'is-invalid' : '' ?>" value="<?= old('icon') ?>" placeholder="<?= lang('boilerplate.menu.fields.place_icon') ?>" autocomplete="off">
                                <?php if (session('error.icon')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.icon') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                            <span class="help-block">
                                <i class="fa fa-info-circle text-info"></i>&nbsp;<?= lang('boilerplate.menu.fields.info_icon') ?> <a href="http://fontawesome.io/icons" target="_blank">http://fontawesome.io/icons</a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('boilerplate.menu.fields.name') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="title" class="form-control <?= session('error.title') ? 'is-invalid' : '' ?>" value="<?= old('title') ?>" placeholder="<?= lang('boilerplate.menu.fields.place_title') ?>" autocomplete="off">
                                <?php if (session('error.title')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.title') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('boilerplate.menu.fields.route') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                                <input type="text" name="route" class="form-control <?= session('error.route') ? 'is-invalid' : '' ?>" value="<?= old('route') ?>" placeholder="<?= lang('boilerplate.menu.fields.place_route') ?>" autocomplete="off">
                                <?php if (session('error.route')) { ?>
                                    <div class="invalid-feedback">
                                        <h6><?= session('error.route') ?></h6>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('boilerplate.role.fields.name') ?></label>
                        <div class="col-sm-10">
                            <select multiple="multiple" class="form-control parent" name="groups_menu[]" data-placeholder="<?= lang('boilerplate.role.fields.plc_name') ?>" style="width: 100%;">
                                <?php foreach ($roles as $role) { ?>
                                    <option <?= in_array($role->id, old('groups_menu', [])) ? 'selected' : '' ?> value="<?= $role->id ?>"><?= $role->name ?></option>
                                <?php } ?>
                            </select>
                            <?php if (session('error.groups_menu')) { ?>
                                <h6 class="text-danger"><?= session('error.groups_menu') ?></h6>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="float-right btn btn-sm btn-primary"><?= lang('boilerplate.global.save') ?></button>
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
            inputSearch: true,
        });
        $('.parent').select2();

        menu();

        function menu() {
            $.get("<?= base_url('admin/menu') ?>", function (response) {
                $('.dd').nestable({
                    maxDepth: 2,
                    json: response.data,
                    contentCallback: (item) => {
                        return `<i class="${item.icon}"></i>&nbsp;<strong>${item.title}</strong>&nbsp;&nbsp;&nbsp;<a href="<?= base_url() ?>/${item.route}" class="dd-nodrag">${item.route}</a>
                            <span class="float-right dd-nodrag">
                                <button data-id="${item.id}" id="btn-edit" class="btn btn-primary btn-xs"><span class="fa fa-fw fa-pencil-alt"></span></button>
                                <button data-id="${item.id}" id="btn-delete" class="btn btn-danger btn-xs"><span class="fa fa-fw fa-trash"></span></button>
                            </span>`;
                    }
                });
            });
        }

        $('.tree-tools').on('click', function (e) {
            var action = $(this).data('action');
            if (action === 'expand') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse') {
                $('.dd').nestable('collapseAll');
            }
        });

        $('.save').on('click', function (e) {
            e.preventDefault();
            var serialize = $('#menu').nestable('toArray');
            var btnSave = $(this);
            $(this).attr('disabled', true);
            $(this).html('<i class="fas fa-spinner fa-spin"></i>');

            $.ajax({
                url: `<?= base_url(route_to('menu-update')) ?>`,
                method: 'PUT',
                dataType: 'JSON',
                data: JSON.stringify(serialize)
            }).done((data, textStatus, jqXHR) => {
                Toast.fire({
                    icon: 'success',
                    title: jqXHR.statusText
                });
                btnSave.attr('disabled', false);
                btnSave.html('<i class="fa fa-save"></i> ' + "<?= lang('boilerplate.global.save') ?>");
                $('.dd').nestable('destroy');
                menu();
            }).fail((error) => {
                Toast.fire({
                    icon: 'error',
                    title: error.responseJSON.messages.error,
                });
                btnSave.attr('disabled', false);
                btnSave.html('<i class="fa fa-save"></i> ' + "<?= lang('boilerplate.global.save') ?>");
            })
        });

        $('.refresh').on('click', function (e) {
            location.reload(true);
        });

        $(document).on('click', '#btn-edit', function (e) {
            e.preventDefault();
            $('.is-invalid').removeClass('is-invalid');

            $.ajax({
                url: `<?= base_url(route_to('admin/menu')) ?>/${$(this).attr('data-id')}/edit`,
                method: 'GET',
                dataType: 'JSON',

            }).done((response) => {

                $('#active').select2();
                $('#parent_id').select2({
                    data: response.menu
                });
                $('#groups_menu').select2({
                    data: response.roles
                });
                var editForm = $('#form-edit');

                var group_id = response.data.group_id;
                var group = group_id.split('|');
                var parent_id = response.data.parent_id == 0 ? 0 : response.data.parent_id;

                editForm.find('select[name="active"]').val(response.data.active).change();
                editForm.find('select[name="parent_id"]').val(parent_id).change();
                editForm.find('select[name="groups_menu[]"]').val(group).change();
                editForm.find('input[name="icon"]').val(response.data.icon);
                editForm.find('input[name="icon"]').val(response.data.icon);
                editForm.find('input[name="title"]').val(response.data.title);
                editForm.find('input[name="route"]').val(response.data.route);
                $("#menu_id").val(response.data.id);
                $('#modal-update').modal('show');

            }).fail((jqXHR, textStatus, errorThrown) => {
                Toast.fire({
                    icon: 'error',
                    title: jqXHR.responseJSON.messages.error,
                });
            })
        });

        $(document).on('click', '#btn-update', function (e) {
            $('.invalid-feedback').remove();
            var editForm = $('#form-edit');

            $.ajax({
                url: `<?= base_url(route_to('admin/menu')) ?>/${ $('#menu_id').val() }`,
                method: 'PUT',
                data: editForm.serialize()

            }).done((data, textStatus, jqXHR) => {
                Toast.fire({
                    icon: 'success',
                    title: jqXHR.statusText
                });

                $('.dd').nestable('destroy');
                menu();
                $("#form-edit").trigger("reset");
                $("#modal-update").modal('hide');

            }).fail((xhr, status, error) => {
                $.each(xhr.responseJSON.messages, (elem, messages) => {
                    editForm.find('input[name="' + elem + '"]').addClass('is-invalid').after('<p class="invalid-feedback">' + messages + '</p>');
                });
            })
        });

        $(document).on('click', '#btn-delete', function (e) {
            Swal.fire({
                title: '<?= lang('boilerplate.global.sweet.title') ?>',
                text: "<?= lang('boilerplate.global.sweet.text') ?>",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '<?= lang('boilerplate.global.sweet.confirm_delete') ?>'
            })
                    .then((result) => {
                        if (result.value) {
                            $.ajax({
                                url: `<?= base_url(route_to('admin/menu')) ?>/${$(this).attr('data-id')}`,
                                method: 'DELETE',
                            }).done((data, textStatus, jqXHR) => {
                                Toast.fire({
                                    icon: 'success',
                                    title: jqXHR.statusText,
                                });
                                $('.dd').nestable('destroy');
                                menu();
                            }).fail((jqXHR, textStatus, errorThrown) => {
                                Toast.fire({
                                    icon: 'error',
                                    title: jqXHR.responseJSON.messages.error,
                                });
                            })
                        }
                    })
        })

        $('#modal-edit').on('hidden.bs.modal', function () {
            $(this).find('#form-edit').reset();
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').removeClass('invalid-feedback');
        });
    })

    $(function () {
        $("#modal-update").draggable();
    });

</script>
<?= $this->endSection() ?>
