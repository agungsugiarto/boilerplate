<!-- Create Modal -->
<div class="modal fade" id="modal-create-permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= lang('boilerplate.permission.add') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-permission" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><?= lang('boilerplate.permission.fields.name') ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= lang('boilerplate.permission.fields.plc_name') ?>">
                    </div>
                    <div class="form-group">
                        <label><?= lang('boilerplate.permission.fields.description') ?></label>
                        <textarea class="form-control" name="description" placeholder="<?= lang('boilerplate.permission.fields.plc_description') ?>"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-save-permission"><?= lang('boilerplate.global.save') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="modal-edit-permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('boilerplate.permission.edit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-permission" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="permission_id">
                    <div class="form-group">
                        <label><?= lang('boilerplate.permission.fields.name') ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= lang('boilerplate.permission.fields.plc_name') ?>">
                    </div>
                    <div class="form-group">
                        <label><?= lang('boilerplate.permission.fields.description') ?></label>
                        <textarea class="form-control" name="description" placeholder="<?= lang('boilerplate.permission.fields.plc_description') ?>"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('boilerplate.global.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-update-permission"><?= lang('boilerplate.global.save') ?></button>
            </div>
        </div>
    </div>
</div>