<div class="section__content">

    <h3 class="section__heading">
        <?=$title; ?>
        <small>Поиск возможен по названию</small>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($pensions)) : ?>

                <div class="h4 text-brand m-t-10 m-b-10">Пансионаты не созданы, обратитесь к сотрудникам <?=$GLOBALS["SITE_NAME"]; ?> для создания.</div>

            <? else: ?>

                <div class="row">
                    <div class="col-xs-12">

                        <form class="search" data-search="pensions">
                            <input id="search" type="search" placeholder="Начните вводить название пансионата" class="search__input">
                            <label for="search" class="search__submit">
                                <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                            </label>
                        </form>

                        <div class="row block-wrapper" id="pensions">

                            <? foreach ($pensions as $pension) : ?>

                                <?=View::factory('pensions/blocks/search-block', array('pension' => $pension))?>

                            <? endforeach; ?>

                        </div>

                    </div>
                </div>

            <? endif; ?>

        </div>

    </div>

</div>

