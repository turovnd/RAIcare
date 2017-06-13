<div class="section__content">

    <h3 class="section__heading">
        Пользователи
        <small>Поиск возможен по имени или логину</small>
    </h3>

    <div class="row">

        <div class="col-xs-12">

            <div class="row">
                <div class="col-xs-12">

                    <form class="search" data-search="users">
                        <input id="search" type="search" placeholder="Начните вводить имя или логин пользователя" class="search__input">
                        <label for="search" class="search__submit">
                            <i class="fa fa-search search__submit-icon" aria-hidden="true"></i>
                        </label>
                    </form>

                    <div class="row block-wrapper" id="profiles">

                        <? foreach ($profiles as $profile) : ?>

                            <?=View::factory('profiles/blocks/search-block', array('profile' => $profile))?>

                        <? endforeach; ?>

                    </div>

                </div>
            </div>

        </div>

    </div>

</div>

