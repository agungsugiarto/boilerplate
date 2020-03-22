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
                <form class="form-horizontal">
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('menu.parent') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control parent" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('menu.active') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control parent" style="width: 100%;">
                                <option selected="selected">Active</option>
                                <option>Non Active</option>
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
                                <input type="text" name="description" class="icon-picker form-control <?php if (session('error.description')) { ?>is-invalid<?php } ?>" value="<?= old('description') ?>" placeholder="<?= lang('menu.place_icon') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('error.description') ?>
                                </div>
                            </div>
                            <span class="help-block">
                                <i class="fa fa-info-circle"></i>&nbsp;<?= lang('menu.info_icon') ?> <a href="http://fontawesome.io/icons" target="_blank">http://fontawesome.io/icons</a>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label"><?= lang('menu.title') ?></label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                                <input type="text" name="name" class="form-control <?php if (session('error.name')) { ?>is-invalid<?php } ?>" value="<?= old('name') ?>" placeholder="<?= lang('menu.place_title') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('error.name') ?>
                                </div>
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
                                <input type="text" name="name" class="form-control <?php if (session('error.name')) { ?>is-invalid<?php } ?>" value="<?= old('name') ?>" placeholder="<?= lang('menu.place_route') ?>" autocomplete="off">
                                <div class="invalid-feedback">
                                    <?= session('error.name') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label"><?= lang('menu.role') ?></label>
                        <div class="col-sm-10">
                            <select class="form-control parent" multiple="multiple" style="width: 100%;">
                                <option selected="selected">Alabama</option>
                                <option>Alaska</option>
                                <option>California</option>
                                <option>Delaware</option>
                                <option>Tennessee</option>
                                <option>Texas</option>
                                <option>Washington</option>
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