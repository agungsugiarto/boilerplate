<!-- Include datatables -->
<?= $this->include('agungsugiarto\boilerplate\Views\load\datatables') ?>
<?= $this->include('agungsugiarto\boilerplate\Views\load\sweetalert') ?>
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
                            <a href="<?= route_to('admin/role/new') ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-plus"></i> Add
                                Role
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
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
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
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
        }
    });
    
    var tableRole = $('#table-role').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,

        ajax : {
            url: '<?= route_to('admin/role') ?>',
            method: 'GET'
        },
        columns : [
            { 'data': null },
            { 'data': 'name' },
            { 'data': 'description' },
            {
                'data': function (data) {
                    return '<a href="<?= route_to('admin/role') ?>/'+ data.id +'/edit" class="btn btn-primary btn-sm btn-edit"><span class="fa fa-fw fa-pencil-alt"></span></a> <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' + data.id + '"><span class="fa fa-fw fa-trash"></span></button>';
                }
            }
        ]
    });

    tableRole.on( 'order.dt search.dt', function () {
        tableRole.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();
</script>
<script>
    $(document).on('click', '.btn-delete', function (e) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: `<?= route_to('admin/role') ?>/${$(this).attr('data-id')}`,
                    method: 'DELETE',
                }).done((data, textStatus) => {
                    Toast.fire({
                        icon: 'success',
                        title: textStatus,
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
