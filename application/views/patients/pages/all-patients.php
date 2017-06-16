<div class="section__content">

    <h3 class="section__heading">
        База данных пациентов всех пансионатов
        <small>Поиск возможен по названию</small>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($pensions)) : ?>

                <div class="h4 text-brand m-t-10 m-b-10">Пациенты не созданы</div>

            <? else: ?>

                <div class="row">
                    <div class="col-xs-12">

                        <form class="search" data-search="patients">
                            <input id="search" type="search" placeholder="Начните вводить имя пациента" class="search__input" oninput="pension.get.search(this)" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false">
                            <label for="search" class="search__submit">
                                <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                            </label>
                        </form>

                        <div class="row block-wrapper" id="pensions">

                            <? foreach ($pensions as $pension) : ?>

                                <?=View::factory('pensions/blocks/search-block', array('pension' => $pension))?>

                            <? endforeach; ?>

                        </div>

                        <div class="text-center m-t-20 m-b-10">
                            <button id="getMoreBtn" onclick="pension.get.blocks(this)" data-type="<?=$type; ?>" data-offset="<?= count($pensions); ?>" class="btn btn--lg btn--default btn--round p-r-50 p-l-50">
                                Загрузить ещё
                            </button>
                        </div>

                    </div>
                </div>

            <? endif; ?>

        </div>

    </div>

</div>

<script type="text/javascript" src="<?=$assets; ?>frontend/bundles/pension.min.js?v=<?= filemtime("assets/frontend/bundles/pension.min.js") ?>"></script>