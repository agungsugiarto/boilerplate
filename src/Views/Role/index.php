<!-- Include datatables -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\datatables') ?>
<!-- Extend from layout index -->
<?= $this->extend('agungsugiarto\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-right">
                        <div class="btn-group">
                            <a href="<?= route_to('admin/role/new') ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-plus"></i>
                                <?= lang('role.add') ?>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-role" class="table table-striped table-hover va-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('role.name') ?></th>
                                    <th><?= lang('role.description') ?></th>
                                    <th><?= lang('role.action') ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<!-- Push section js -->
<?= $this->section('js') ?>
<script>    
    var tableRole = $('#table-role').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        autoWidth: false,

        ajax : {
            url: '<?= route_to('admin/role') ?>',
            method: 'GET'
        },
        columns : [
            { 'data': 'id' },
            { 'data': 'name' },
            { 'data': 'description' },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= route_to('admin/role') ?>/${data.id}/edit" class="btn btn-primary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });
    
    $(document).on('click', '.btn-delete', function (e) {
        Swal.fire({
            title: '<?= lang('global.title') ?>',
            text: "<?= lang('global.text') ?>",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('global.confirm_delete') ?>'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: `<?= route_to('admin/role') ?>/${$(this).attr('data-id')}`,
                    method: 'DELETE',
                }).done((data, textStatus, jqXHR) => {
                    Toast.fire({
                        icon: 'success',
                        title: jqXHR.statusText,
                    });
                    tableRole.ajax.reload();
                }).fail((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: error.responseJSON.messages.error,
                    });
                })
            }
        })
    })
</script>
<?= $this->endSection() ?>
