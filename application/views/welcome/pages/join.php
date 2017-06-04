
<div class="section m-t-100 m-b-100">

    <div class="container animated fade__in">

        <form class="form clear-fix" action="<?=URL::site('application/new')?>" method="POST">

            <div class="form__body m-t-20">

                <div class="col-xs-12">

                    <div class="text-center text-brand text-bold f-s-2_5 m-b-20">
                        <?=$GLOBALS['SITE_NAME']; ?>
                    </div>

                    <p class="h4 m-b-20">
                        Команда <?=$GLOBALS['SITE_NAME']; ?> готова Вам помочь, просто оставьте заявку и мы свяжемся с Вами как можно скорее.
                    </p>

                    <fieldset>
                        <div class="form-group">
                            <label for="name" class="form-group__label">
                                Ваше имя <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="name" name="name" class="f-s-1 form-group__control" required>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="email" class="form-group__label">
                                Ваш адрес электронной почты <span class="text-danger">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="f-s-1 form-group__control" required>
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="organization" class="form-group__label">
                                Организация / компания
                            </label>
                            <input type="text" id="organization" name="organization" class="f-s-1 form-group__control">
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="city" class="form-group__label">
                                Город
                            </label>
                            <input type="text" id="city" name="city" class="f-s-1 form-group__control">
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="phone" class="form-group__label">
                                Телефон
                            </label>
                            <input type="text" id="phone" name="phone" class="f-s-1 form-group__control">
                        </div>
                    </fieldset>

                    <fieldset>
                        <div class="form-group">
                            <label for="comment" class="form-group__label">
                                Комментарий
                            </label>
                            <textarea name="comment" id="comment" rows="5" class="f-s-1 form-group__control"></textarea>
                        </div>
                    </fieldset>

                </div>

            </div>

            <button role="submit" class="form__submit text-center col-xs-12 text-brand">
                Присоединиться к <?=$GLOBALS['SITE_NAME']?>
            </button>


        </form>

    </div>

</div>

