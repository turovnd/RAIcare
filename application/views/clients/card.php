<div class="section__content">

    <h3 class="section__heading">
        Контактная карточка клиента
        <small>Работа с клипентом - создание организации/пансионата, изменение статуса в соответствие с оплатой доступа.</small>
    </h3>

    <div class="row">
        <div class="col-xs-12">
            <div id="application" class="form">
                <div class="form__heading">
                    Анкета
                    <a role="button" class="btn btn--default btn--sm m-b-0 m-r-0 fl_r js-request-reject <? echo $client->status == 1 ? '' : 'hide'; ?>">в спам</a>
                    <a role="button" class="btn btn--brand btn--sm m-b-0 fl_r js-request-accept <? echo $client->status == 1 ? '' : 'hide'; ?>">принять</a>
                </div>

                <div class="form__body">

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientName" class="col-sm-3 col-md-2 form-group__label">Имя</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->name; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientName" name="name" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->name; ?>" maxlength="256">
                                    <label class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientEmail" class="col-sm-3 col-md-2 form-group__label">Эл. почта</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->email; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientEmail" name="email" type="email" class="form-group__control form-group__control-group-input" value="<?= $client->email; ?>" maxlength="64">
                                    <label class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientOrganization" class="col-sm-3 col-md-2 form-group__label">Организация</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->organization; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientOrganization" name="organization" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->organization; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientCity" class="col-sm-3 col-md-2 form-group__label">Город</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->city; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientCity" name="city" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->city; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientPhone" class="col-sm-3 col-md-2 form-group__label">Телефон</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->phone; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <input id="clientPhone" name="phone" type="text" class="form-group__control form-group__control-group-input" value="<?= $client->phone; ?>">
                                    <label class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>

                    <fieldset class="m-b-0 p-t-20 p-b-20 js-field-name">
                        <label for="clientComment" class="col-sm-3 col-md-2 form-group__label">Комментарий</label>
                        <div class="col-xs-12 col-sm-9 col-md-10">
                            <p class="form-group__control-static">
                                <span><?= $client->comment; ?></span>
                                <? if ($client->status != 1 && $client->status != 0) : ?>
                                    <a role="button" class="m-l-5"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                <? endif; ?>
                            </p>
                            <? if ($client->status != 1 && $client->status != 0) : ?>
                                <div class="form-group__control-group hide">
                                    <textarea name="comment" id="clientComment" rows="5" class="form-group__control form-group__control-group-input"><?= $client->comment; ?></textarea>
                                    <label class="cursor-pointer form-group__control-group-addon"><i class="fa fa-check" aria-hidden="true"></i></label>
                                </div>
                            <? endif; ?>
                        </div>
                    </fieldset>
                </div>
                <input id="clientId" type="hidden" value="<?= $client->id; ?>">
            </div>
        </div>

    </div>


    <? if ($client->status != 1 && $client->status != 0) : ?>
4
    <? endif; ?>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>
<script type="text/javascript">
    function ready() {
        clients.request.init();
    }
    document.addEventListener("DOMContentLoaded", ready);
</script>

