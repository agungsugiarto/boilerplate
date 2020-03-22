<?= $this->include('agungsugiarto\boilerplate\Views\load\select2') ?>
<?= $this->include('agungsugiarto\boilerplate\Views\load\datatables') ?>
<?= $this->include('agungsugiarto\boilerplate\Views\load\sweetalert') ?>
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
                                    <th><?= lang('user.username') ?></th>
                                    <th><?= lang('user.email') ?></th>
                                    <th><?= lang('user.active') ?></th>
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
        ordering: false,
        autoWidth: false,

        ajax : {
            url: '<?= route_to('admin/user/manage') ?>',
            method: 'GET'
        },
        columns : [
            { 'data': null },
            { 'data': 'username' },
            { 'data': 'email' },
            {
                'data': function (data) {
                    return `<span class="badge ${data.active == 1 ? 'bg-success' : 'bg-danger'}">${data.active == 1 ? 'active' : 'non-active'}</span>`
                }
            },
            { 
                'data': function (data) {
                    return `<a href="<?= route_to('admin/user/manage') ?>/${data.id}/edit" class="btn btn-primary btn-sm btn-edit" data-id="${data.id}"><span class="fa fa-fw fa-pencil-alt"></span></a> <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="${data.id}"><span class="fa fa-fw fa-trash"></span></button>`;
                }
            }
        ]
    });

    tableUser.on('order.dt search.dt', () => {
        tableUser.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        });
    }).draw();
</script>
<?= $this->endSection() ?>