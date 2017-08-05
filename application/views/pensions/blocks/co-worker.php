<div class="col-xs-12 col-sm-6">

    <div class="block" data-id="<?= $co_worker->id; ?>" data-name="<?= $co_worker->name; ?>">

        <div class="block__heading valign">
            <div class="fa fa-id-card-o fa-2x" aria-hidden="true"></div>
            <div class="m-0 m-l-15 text-bold js-field-name">
                <div class="form-group__control-static p-l-0 p-r-0">
                    <span class="js-co-worker-info">
                        <?= $co_worker->name; ?>
                    </span>
                    <? if ($co_worker->is_confirmed == 0 && $co_worker->role->id != 20) : ?>
                        <a onclick="pension.coworker.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <? endif; ?>
                </div>
                <? if ($co_worker->is_confirmed == 0 && $co_worker->role->id != 20) : ?>
                    <div class="form-group__control-group hide">
                        <input name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $co_worker->name; ?>" maxlength="30">
                        <label onclick="pension.coworker.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                        <label onclick="pension.coworker.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                    </div>
                <? endif; ?>
            </div>
        </div>

        <div class="block__body p-b-0">

            <div class="row">

                <fieldset>
                    <div class="form-group js-field-name">
                        <label for="coWorkerUserName" class="form-group__label col-xs-12 p-t-0">Логин</label>
                        <div class="col-xs-12">
                            <p class="form-group__control-static p-l-0 p-r-0">
                                <span class="js-co-worker-info">
                                    <?= $co_worker->username; ?>
                                </span>

                                <? if ($co_worker->is_confirmed == 0 && $co_worker->role->id != 20) : ?>
                                    <a onclick="pension.coworker.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($co_worker->is_confirmed == 0 && $co_worker->role->id != 20) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="coWorkerUserName" name="username" type="text" class="form-group__control form-group__control-group-input" value="<?= $co_worker->username; ?>" maxlength="30">
                                    <label onclick="pension.coworker.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="pension.coworker.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group js-field-name">
                        <label for="coWorkerUserEmail" class="form-group__label col-xs-12 p-t-0">Эл. почта</label>
                        <div class="col-xs-12">
                            <div class="form-group__control-static p-l-0 p-r-0">
                                <span class="js-co-worker-info">
                                    <?= $co_worker->email; ?>
                                </span>
                                <? if ($co_worker->is_confirmed == 0 && $co_worker->role->id != 20) : ?>
                                    <a onclick="pension.coworker.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    <span class="label label--warning display-table m-t-5">не потверждена</span>
                                    <button onclick="pension.coworker.changePass(this)" class="btn btn--default m-t-5 m-b-0 display-table">Сбросить пароль</button>
                                <? else : ?>
                                    <span class="label label--brand display-table m-t-5">потверждена</span>
                                <? endif; ?>
                            </div>
                            <? if ($co_worker->is_confirmed == 0 && $co_worker->role->id != 20) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="coWorkerUserEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $co_worker->email; ?>" maxlength="65">
                                    <label onclick="pension.coworker.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="pension.coworker.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group js-field-name">
                        <label for="coWorkerRole" class="form-group__label col-xs-12 p-t-0">Роль</label>
                        <div class="col-xs-12">
                            <p class="form-group__control-static p-l-0 p-r-0">
                                <span class="js-co-worker-info">
                                    <?= $co_worker->role->name; ?>
                                </span>

                                <? if ($co_worker->role->id != 20) : ?>
                                    <a onclick="pension.coworker.toggle(this)" role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($co_worker->role->id != 20) : ?>
                                <div class="form-group__control-group hide">
                                    <select name="role" id="coWorkerRole" class="form-group__control form-group__control-group-input js-single-select">
                                        <? foreach ($roles as $role) : ?>
                                            <option value="<?= $role->id; ?>" <?= $co_worker->role->id == $role->id ? 'selected': ''; ?> > <?= $role->name; ?> </option>
                                        <? endforeach; ?>
                                    </select>
                                    <label onclick="pension.coworker.toggle(this)" class="b-l-0 cursor-pointer form-group__control-group-addon"><i class="fa fa-times" aria-hidden="true"></i></label>
                                    <label onclick="pension.coworker.save(this)" class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </fieldset>

                <? if ($co_worker->role->id != 20 ) : ?>
                    <fieldset>
                        <div class="col-xs-12">
                            <a onclick="pension.coworker.exclude(this)" class="btn btn--default m-0">
                                Исключить из пансионата
                            </a>
                        </div>
                    </fieldset>
                <? endif; ?>

            </div>

        </div>

    </div>

</div>