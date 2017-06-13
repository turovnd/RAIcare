<div class="section__content">

    <h3 class="section__heading">
        <?=$title; ?>
        <small>Поиск возможен по названию</small>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <? if (empty($organizations)) : ?>

                <div class="h4 text-brand m-t-10 m-b-10">Организации не созданы</div>

            <? else: ?>

                <div class="row">
                    <div class="col-xs-12">

                        <form class="search" data-search="organizations">
                            <input id="search" type="search" placeholder="Начните вводить название организации" class="search__input">
                            <label for="search" class="search__submit">
                                <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                            </label>
                        </form>

                        <div class="row block-wrapper" id="organizations">

                            <? foreach ($organizations as $organization) : ?>

                                <?=View::factory('organizations/blocks/search-block', array('organization' => $organization))?>

                            <? endforeach; ?>

                        </div>

                    </div>
                </div>

            <? endif; ?>

        </div>

    </div>

</div>

