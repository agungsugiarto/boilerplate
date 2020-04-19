<?= $this->include('agungsugiarto\boilerplate\Views\load\select2') ?>
<?= $this->include('agungsugiarto\boilerplate\Views\load\datatables') ?>
<!-- Extend from layout index -->
<?= $this->extend('agungsugiarto\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
    <!-- SELECT2 EXAMPLE -->
    <div class="card card-default">
        <div class="card-header">
            <div class="card-tools">
                <div class="btn-group">
                    <a href="<?= route_to('admin/user/manage/new') ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-plus"></i>
                        <?= lang('user.add') ?>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="table-responsive">
                        <table id="table-user" class="table table-striped table-hover va-middle">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th><?= lang('Auth.username') ?></th>
                                    <th><?= lang('Auth.email') ?></th>
                                    <th><?= lang('user.active') ?></th>
                                    <th><?= lang('user.join') ?></th>
                                    <th><?= lang('user.action') ?></th>
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
    <!-- /.card -->
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    var tableUser = $('#table-user').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        autoWidth: false,

        ajax : {
            url: '<?= route_to('admin/user/manage') ?>',
            method: 'GET'
        },
        columns : [
            { 'data': 'id' },
            { 'data': 'username' },
            { 'data': 'email' },
            {
                'data': function (data) {
                    return `<span class="badge ${data.active == 1 ? 'bg-success' : 'bg-danger'}">${data.active == 1 ? '<?= lang('user.active') ?>' : '<?= lang('user.non_active') ?>'}</span>`
                }
            },
            {
                'data': 'created_at',
                'render': function(date) {
                    return moment(date).fromNow()
                }
            },
            {
                "data": function(data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= route_to('admin/user/manage') ?>/${data.id}/edit" class="btn btn-primary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    $(document).on('click', '.btn-delete', function(e) {
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
                    url: `<?= route_to('admin/user/manage') ?>/${$(this).attr('data-id')}`,
                    method: 'DELETE',
                }).done((data, textStatus, jqXHR) => {
                    Toast.fire({
                        icon: 'success',
                        title: jqXHR.statusText,
                    });
                    tableUser.ajax.reload();
                }).fail((error) => {
                    Toast.fire({
                        icon: 'error',
                        title: error.responseJSON.messages.error,
                    });
                })
            }
        })
    });

    tableUser.on('order.dt search.dt', () => {
        tableUser.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
</script>
<?= $this->endSection() ?>