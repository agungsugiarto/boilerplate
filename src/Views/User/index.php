<?= $this->include('julio101290\boilerplate\Views\load\select2') ?>
<?= $this->include('julio101290\boilerplate\Views\load\datatables') ?>
<!-- Extend from layout index -->
<?= $this->extend('julio101290\boilerplate\Views\layout\index') ?>

<!-- Section content -->
<?= $this->section('content') ?>
<!-- SELECT2 EXAMPLE -->
<div class="card card-default">
    <div class="card-header">
        <div class="card-tools">
            <div class="btn-group">
                <a href="<?= base_url(route_to('admin/user/manage/new')) ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-plus"></i>
                    <?= lang('boilerplate.user.add') ?>
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
                                <th><?= lang('boilerplate.user.firstname') ?></th>
                                <th><?= lang('boilerplate.user.lastname') ?></th>
                                <th><?= lang('Auth.email') ?></th>
                                <th><?= lang('boilerplate.user.fields.active') ?></th>
                                <th><?= lang('boilerplate.user.fields.join') ?></th>
                                <th><?= lang('boilerplate.global.action') ?></th>
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
        responsive: true,
        autoWidth: false,
        order: [[1, 'asc']],

        ajax: {
            url: '<?= base_url(route_to('admin/user/manage')) ?>',
            method: 'GET'
        },
        columnDefs: [{
                orderable: false,
                targets: [0, 5, 7]
            }],
        columns: [{
                'data': null
            },
            {
                'data': 'username'
            },
            {
                'data': 'firstname'
            },

            {
                'data': 'lastname'
            },
            {
                'data': 'email'
            },
            {
                'data': function (data) {
                    return `<span class="badge ${data.active == 1 ? 'bg-success' : 'bg-danger'}">${data.active == 1 ? '<?= lang('boilerplate.user.fields.active') ?>' : '<?= lang('boilerplate.user.fields.non_active') ?>'}</span>`
                }
            },
            {
                'data': 'created_at',
                'render': function (data) {
                    return moment(data).fromNow()
                }
            },
            {
                "data": function (data) {
                    return `<td class="text-right py-0 align-middle">
                            <div class="btn-group btn-group-sm">
                                <a href="<?= base_url(route_to('admin/user/manage')) ?>/${data.id}/edit" class="btn btn-primary btn-edit"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-danger btn-delete" data-id="${data.id}"><i class="fas fa-trash"></i></button>
                            </div>
                            </td>`
                }
            }
        ]
    });

    tableUser.on('draw.dt', function () {
        var PageInfo = $('#table-user').DataTable().page.info();
        tableUser.column(0, {
            page: 'current'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    $(document).on('click', '.btn-delete', function (e) {
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
                            url: `<?= base_url(route_to('admin/user/manage')) ?>/${$(this).attr('data-id')}`,
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
        tableUser.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();
</script>
<?= $this->endSection() ?>