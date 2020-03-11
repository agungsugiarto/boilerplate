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
                            <a href="<?= base_url('admin/role/show') ?>" class="btn btn-sm btn-block btn-primary"><i class="fa fa-plus"></i> Add
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
    var tableRole = $('#table-role').DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: false,
        info: true,
        autoWidth: false,

        ajax : {
            url: '<?= base_url('admin/role/datatable') ?>',
            method: 'post'
        },
        columns : [
            { 'data': null },
            { 'data': 'name' },
            { 'data': 'description' },
            {
                'data': function (data) {
                    return '<a href="<?= base_url('admin/role/edit') ?>/'+ data.id +'" class="btn btn-primary btn-sm btn-edit"><span class="fa fa-fw fa-pencil-alt"></span></a> <button type="button" class="btn btn-danger btn-sm btn-delete" data-id="' + data.id + '"><span class="fa fa-fw fa-trash"></span></button>';
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
    $(document).on('click', '#btn-save-role', function() {
        $('.text-danger').remove();
        var createForm = $('#form-create-role');
        $.ajax({
            url: '<?= route_to('admin/role/create') ?>',
            method: 'post',
            data: createForm.serializeArray(),

            success: function(response) {
                if (response.errors) {
                    $.each(response.errors, function (elem, messages) {
                        createForm.find('input[name="' + elem + '"]').after('<p class="text-danger">' + messages + '</p>');
                        createForm.find('textarea[name="' + elem + '"]').after('<p class="text-danger">' + messages + '</p>');
                    });
                } else {
                    console.log(response.success)
                    tableRole.ajax.reload();
                    $("#form-create-role").trigger("reset");
                    $("#modal-create-role").modal('hide');
                }
            }
        })
    })
</script>
<script>
    $(document).on('click', '.btn-delete', function (e) {
        var url = "<?= base_url('admin/role/delete') ?>" + "/" + ":id"
        url = url.replace(':id', $(this).attr('data-id'))

        $.ajax({
            url: url,
            method: 'delete',
            data: { "id": $(this).attr('data-id') },

            success: function(response) {
                if (response.errors) {
                    console.log(response.errors)
                } else {
                    console.log(response.success)
                    tableRole.ajax.reload();
                }
            }
        })
    })
</script>
<?= $this->endSection() ?>
