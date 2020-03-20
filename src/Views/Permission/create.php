<!-- Create Modal -->
<div class="modal fade" id="modal-create-permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?= lang('permission.add') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-create-permission" enctype="multipart/form-data">
                    <div class="form-group">
                        <label><?= lang('permission.name') ?></label>
                        <input type="text" class="form-control" name="name" placeholder="<?= lang('permission.place_name') ?>">
                    </div>
                    <div class="form-group">
                        <label><?= lang('permission.description') ?></label>
                        <textarea class="form-control" name="description" placeholder="<?= lang('permission.place_description') ?>"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('permission.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-save-permission"><?= lang('permission.save') ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="modal-edit-permission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit a Permission</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit-permission" enctype="multipart/form-data">
                    <input type="hidden" class="form-control" id="permission_id">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Name of permission">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="description" placeholder="Enter ..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-update-permission">Update</button>
            </div>
        </div>
    </div>
</div>