<div class="section__content">

    <h3 class="section__heading">
        <? if(in_array(7, $user->permissions) && $add_client) : ?>
            <a role="button" data-toggle="modal" data-area="addClientModal" class="btn btn--brand btn--sm m-0 fl_r">Добавить клиента</a>
        <? endif; ?>
        <?=$title; ?>
        <small>Для просмотра нажмите на имя клиента</small>
    </h3>

    <? if($reject_client) : ?>
        <a href="<?=URL::site('clients/reject'); ?>" class="btn btn--lg btn--default m-b-20">Просмотреть отклоненные заявки</a>
    <? endif; ?>

    <div class="row">

        <div class="block-wrapper">

            <? if (empty($clients)) : ?>
                <h4 class="h4 col-xs-12 text-bold text-brand"><?=$empty_text; ?></h4>
            <? endif; ?>

            <? foreach ($clients as $client) : ?>

                <?= View::factory('clients/blocks/list-item', array('client' => $client)); ?>

            <? endforeach; ?>

        </div>

    </div>

</div>


<?  // Module Clients => permission: ADD_NEW_CLIENT = 7
if (in_array(7, $user->permissions) && $add_client) : ?>

    <form class="modal" id="addClientModal" tabindex="-1">
        <div class="modal__content">
            <div class="modal__header">
                <button type="button" class="modal__title-close" data-close="modal">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                <h4 class="modal__title">Новый клиент</h4>
            </div>
            <div class="modal__body">

                <fieldset>
                    <div class="form-group">
                        <label for="addClientName" class="form-group__label">Имя <span class="text-danger">*</span></label>
                        <input type="text" id="addClientName" name="name" class="form-group__control" maxlength="256">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="addClientEmail" class="form-group__label">Адрес электронной почты <span class="text-danger">*</span></label>
                        <input type="email" id="addClientEmail" name="email" class="form-group__control" maxlength="64">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="addClientOrganization" class="form-group__label">Организация / компания</label>
                        <input type="text" id="addClientOrganization" name="organization" class="form-group__control">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="addClientCity" class="form-group__label">Город</label>
                        <input type="text" id="addClientCity" name="city" class="form-group__control">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="addClientPhone" class="form-group__label">Телефон</label>
                        <input type="text" id="addClientPhone" name="phone" class="form-group__control" maxlength="20">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="addClientComment" class="form-group__label">Комментарий</label>
                        <textarea name="comment" id="addClientComment" rows="5" class="form-group__control"></textarea>
                    </div>
                </fieldset>

                </div>
                <div class="modal__footer">
                    <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                    <button onclick="clients.create.client()" type="button" class="btn btn--brand">Создать</button>
                </div>
            </div>
        </form>

<? endif; ?>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>