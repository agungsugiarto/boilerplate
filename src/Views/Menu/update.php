<!-- Edit Modal -->
<div class="modal fade" id="modal-update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><?= lang('menu.edit') ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" class="form-horizontal">
                    <input type="hidden" id="menu_id">
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('menu.parent') ?></label>
                        <div class="col-sm-10">
                            <select name="parent_id" id="parent_id" style="width: 100%;">
                                <option value="0">ROOT</option>
                            </select>
                            <span class="help-block">
                                <i class="fas fa-exclamation-triangle text-danger"></i>&nbsp;<?= lang('menu.warning_parent') ?>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('menu.active') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control" id="active" name="active" style="width: 100%;">
                                <option value="1"><?= lang('menu.active') ?></option>
                                <option value="0"><?= lang('menu.non_active') ?></option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label"><?= lang('menu.icon') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fab fa-font-awesome-flag"></i></span>
                                </div>
                                <input type="text" name="icon" class="icon-picker form-control" placeholder="<?= lang('menu.place_icon') ?>" autocomplete="off">
                            </div>
                            <span class="help-block">
                                <i class="fa fa-info-circle text-info"></i>&nbsp;<?= lang('menu.info_icon') ?> <a href="http://fontawesome.io/icons" target="_blank">http://fontawesome.io/icons</a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('menu.name') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="title" class="form-control <?php if (session('error.title')) { ?>is-invalid<?php } ?>" value="<?= old('title') ?>" placeholder="<?= lang('menu.place_title') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label"><?= lang('menu.route') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-link"></i></span>
                                </div>
                                <input type="text" name="route" class="form-control <?php if (session('error.route')) { ?>is-invalid<?php } ?>" value="<?= old('route') ?>" placeholder="<?= lang('menu.place_route') ?>" autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('menu.role') ?></label>
                        <div class="col-sm-10">
                            <select name="groups_menu[]" id="groups_menu" multiple="multiple" style="width: 100%;">
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><?= lang('menu.close') ?></button>
                <button type="button" class="btn btn-primary btn-sm" id="btn-update"><?= lang('menu.save') ?></button>
            </div>
        </div>
    </div>
</div>