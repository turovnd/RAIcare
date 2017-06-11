<div class="section__content">

    <h3 class="section__heading">
        Организации
        <small>Поиск возможен по названию</small>
    </h3>


    <div class="row">

        <div class="col-xs-12">

            <? foreach ($organizations as $organization) : ?>

                <?=View::factory('organizations/blocks/card', array('organization' => $organization));?>

            <? endforeach; ?>

        </div>

    </div>

<!--    <div class="tabs">-->
<!---->
<!--        <div class="tabs__header">-->
<!---->
<!--            <a data-toggle="tabs" data-block="newClients" data-search="newClientsSearch" class="tabs__btn tabs__btn--active">-->
<!--                Новые-->
<!--                <span id="newClientsCounter" class="tabs__count">--><?//= count($clients['new']); ?><!--</span>-->
<!--            </a>-->
<!---->
<!--            <a data-toggle="tabs" data-block="withoutAccessClients" data-search="withoutAccessClientsSearch" class="tabs__btn ">-->
<!--                Без доступа-->
<!--                <span id="withoutAccessClientsCounter" class="tabs__count">--><?//= count($clients['withoutAccess']); ?><!--</span>-->
<!--            </a>-->
<!---->
<!--            <a data-toggle="tabs" data-block="hasAccessClients" data-search="hasAccessClientsSearch" class="tabs__btn ">-->
<!--                В системе-->
<!--                <span id="hasAccessClientsCounter" class="tabs__count">--><?//= count($clients['hasAccess']); ?><!--</span>-->
<!--            </a>-->
<!---->
<!--            <button data-toggle="modal" data-area="addClientModal" class="tabs__btn btn btn--brand fl_r">Добавить</button>-->
<!---->
<!--        </div>-->
<!---->
<!--        <div class="tabs__search">-->
<!---->
<!--            <div id="newClientsSearch" class="tabs__search-block tabs__search-block--active">-->
<!--                <input id="newClientsSearchInput" type="text" class="tabs__search-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Начните вводить имя нового клиента">-->
<!--                <label for="newClientsSearchInput" class="fa fa-search tabs__search-label" aria-hidden="true"></label>-->
<!--            </div>-->
<!---->
<!--            <div id="withoutAccessClientsSearch" class="tabs__search-block">-->
<!--                <input id="withoutAccessClientsSearchInput" type="text" class="tabs__search-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Начните вводить имя клиента">-->
<!--                <label for="withoutAccessClientsSearchInput" class="fa fa-search tabs__search-label" aria-hidden="true"></label>-->
<!--            </div>-->
<!---->
<!--            <div id="hasAccessClientsSearch" class="tabs__search-block">-->
<!--                <input id="hasAccessClientsSearchInput" type="text" class="tabs__search-input" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" placeholder="Начните вводить имя клиента">-->
<!--                <label for="hasAccessClientsSearchInput" class="fa fa-search tabs__search-label" aria-hidden="true"></label>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--        <div class="tabs__content clear_fix">-->
<!---->
<!--            <div id="newClients" class="tabs__block tabs__block--active">-->
<!---->
<!--                --><?// foreach ($clients['new'] as $client) : ?>
<!---->
<!--                    <div id="client_--><?//=$client->id; ?><!--" class="item clear-fix">-->
<!---->
<!--                        <a href="--><?//=URL::site('client/' . $client->id); ?><!--" class="col-xs-3 col-sm-2 col-lg-1 text-center">-->
<!--                            <i class="fa fa-id-card-o fa-4x" aria-hidden="true"></i>-->
<!--                        </a>-->
<!---->
<!--                        <ul class="col-xs-9 col-sm-10 col-lg-11 list-style--none">-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Имя</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10 item__search-text">--><?//= $client->name; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Эл. почта</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10">--><?//= $client->email; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Телефон</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10">--><?//= $client->phone; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                        </ul>-->
<!---->
<!--                    </div>-->
<!---->
<!--                --><?// endforeach; ?>
<!---->
<!--            </div>-->
<!---->
<!--            <div id="withoutAccessClients" class="tabs__block">-->
<!---->
<!--                --><?// foreach ($clients['withoutAccess'] as $client) : ?>
<!---->
<!--                    <div id="client_--><?//=$client->id; ?><!--" class="item clear-fix">-->
<!---->
<!--                        <a href="--><?//=URL::site('client/' . $client->id); ?><!--" class="col-xs-3 col-sm-2 col-lg-1 text-center">-->
<!--                            <i class="fa fa-id-card-o fa-4x" aria-hidden="true"></i>-->
<!--                        </a>-->
<!---->
<!--                        <ul class="col-xs-9 col-sm-10 col-lg-11 list-style--none">-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Имя</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10 item__search-text">--><?//= $client->name; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Эл. почта</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10">--><?//= $client->email; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Телефон</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10">--><?//= $client->phone; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                        </ul>-->
<!---->
<!--                    </div>-->
<!---->
<!--                --><?// endforeach; ?>
<!---->
<!--            </div>-->
<!---->
<!--            <div id="hasAccessClients" class="tabs__block">-->
<!---->
<!--                --><?// foreach ($clients['hasAccess'] as $client) : ?>
<!---->
<!--                    <div id="client_--><?//=$client->id; ?><!--" class="item clear-fix">-->
<!---->
<!--                        <a href="--><?//=URL::site('client/' . $client->id); ?><!--" class="col-xs-3 col-sm-2 col-lg-1 text-center">-->
<!--                            <i class="fa fa-id-card-o fa-4x" aria-hidden="true"></i>-->
<!--                        </a>-->
<!---->
<!--                        <ul class="col-xs-9 col-sm-10 col-lg-11 list-style--none">-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Имя</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10 item__search-text">--><?//= $client->name; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Эл. почта</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10">--><?//= $client->email; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                            <li class="item__text col-xs-12">-->
<!--                                <div class="col-xs-12 col-sm-3 col-md-2 text-bold">Телефон</div>-->
<!--                                <div class="col-xs-12 col-sm-9 col-md-10">--><?//= $client->phone; ?><!--</div>-->
<!--                            </li>-->
<!---->
<!--                        </ul>-->
<!---->
<!--                    </div>-->
<!---->
<!--                --><?// endforeach; ?>
<!---->
<!--            </div>-->
<!---->
<!--        </div>-->
<!---->
<!--    </div>-->

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/clients.min.js?v=<?= filemtime("assets/frontend/bundles/clients.min.js") ?>"></script>
