
<div class="section m-t-150 m-b-100">

    <div class="container animated fade__in">

        <? if ($canLogin) : ?>

            <!-- Logged User SignIn Form -->
            <form id="signinLogged" class="form form--sm m-l-auto m-r-auto ">

                <div class="form__body" >
                    <div class="col-xs-12 m-b-30">

                        <p class="h3 bold text-center m-t-30 m-b-30">Продолжить как</p>


                            <h2 class="text-bold f-s-1_2">
                                <?= $user->name; ?>
                            </h2>

                        <div class="form-group m-b-30">
                            <div class="form-group__control-group">
                                <label for="signinnotlogged_password" class="form-group__control-group-addon">
                                    <i aria-hidden="true" class="fa fa-lock"></i>
                                </label>
                                <input type="password" id="signinnotlogged_password" name="password" class="form-group__control form-group__control-group-input" placeholder="Введите пароль" required autofocus>
                            </div>
                        </div>

                        <button id="signinLoggedCancel" type="button" class="btn btn--default btn--round col-xs-5 fl_l m-r-0">Выйти</button>
                        <button type="submit" class="btn btn--brand btn--round col-xs-5 fl_r m-r-0">Войти</button>
                        <input type="hidden" name="csrf" value="<?=Security::token(); ?>">

                    </div>
                </div>

            </form>

        <? endif; ?>

        <!-- NOT Logged User SignIn Form -->
        <form id="signin" class="form form--sm m-l-auto m-r-auto <?= $canLogin ? 'hide' : ''; ?>">

            <div class="form__body" >
                <div class="col-xs-12 m-b-30">

                    <p class="h3 bold text-center m-t-30 m-b-30">Авторизация</p>

                    <div class="form-group m-b-30">
                        <div class="form-group__control-group">
                            <label for="signin_username" class="form-group__control-group-addon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </label>
                            <input type="text" id="signin_username" name="username" class="form-group__control form-group__control-group-input" placeholder="Имя пользователя" required>
                        </div>
                    </div>

                    <div class="form-group m-b-30">
                        <div class="form-group__control-group">
                            <label for="signin_password" class="form-group__control-group-addon">
                                <i aria-hidden="true" class="fa fa-lock"></i>
                            </label>
                            <input type="password" id="signin_password" name="password" class="form-group__control form-group__control-group-input" placeholder="Пароль" required="">
                        </div>
                    </div>

                    <button type="button" onclick="auth.openReset();" class="btn p-l-0 p-r-0 m-r-0 text-brand">Забыли пароль?</button>
                    <button type="submit" class="btn btn--brand btn--round col-xs-5 fl_r m-r-0">Войти</button>
                    <input type="hidden" name="recover" value="1">
                    <input type="hidden" name="csrf" value="<?=Security::token(); ?>">

                </div>
            </div>

        </form>

        <!-- Forget Password Form -->
        <form id="forget" class="form form--sm m-l-auto m-r-auto hide">

            <div class="form__body ">
                <div class="col-xs-12 m-b-30">

                    <p class="h3 bold text-center m-t-30 m-b-30">Востановление пароля</p>

                    <div class="form-group m-b-30">
                        <div class="form-group__control-group">
                            <label for="forget_email" class="form-group__control-group-addon">
                                <i class="fa fa-envelope-o" aria-hidden="true"></i>
                            </label>
                            <input type="email" id="forget_email" name="email" class="form-group__control form-group__control-group-input" placeholder="Введите ваш email" required="">
                        </div>
                    </div>

                    <div class="g-recaptcha m-b-20 fl_l" data-sitekey="6Lfb5SMUAAAAAIW0QFdCOGR77RtXTu4keNZf8A8V"></div>

                    <button type="button" onclick="auth.openSignIn();" class="btn btn--default btn--round col-xs-5">Отмена</button>
                    <button type="submit" id="" class="btn btn--brand btn--round col-xs-6 fl_r m-r-0">Восстановить</button>
                    <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                </div>
            </div>

        </form>

        <? if ($reset) : ?>

            <!-- Reset Password Form -->
            <form id="reset" class="form form--sm m-l-auto m-r-auto">

                <div class="form__body">
                    <div class="col-xs-12 m-b-30">

                        <p class="h3 bold text-center m-b-30">Сброс пароля</p>

                        <div class="form-group m-b-30">
                            <div class="form-group__control-group">
                                <label for="reset_password" class="form-group__control-group-addon">
                                    <i aria-hidden="true" class="fa fa-lock"></i>
                                </label>
                                <input type="password" id="reset_password" name="password" class="form-group__control form-group__control-group-input" placeholder="Введите новый пароль" required="">
                            </div>
                        </div>

                        <div class="form-group m-b-30">
                            <div class="form-group__control-group">
                                <label for="reset_password1" class="form-group__control-group-addon">
                                    <i aria-hidden="true" class="fa fa-lock"></i>
                                </label>
                                <input type="password" id="reset_password1" name="password1" class="form-group__control form-group__control-group-input" placeholder="Повторите пароль" required="">
                            </div>
                        </div>

                        <button type="button" id="cancelReset" class="btn btn--default btn--round col-xs-5 m-r-0">Отмена</button>
                        <button type="submit" id="" class="btn btn--brand btn--round col-xs-6 fl_r m-r-0">Восстановить</button>
                        <input type="hidden" name="csrf" value="<?=Security::token(); ?>">
                    </div>
                </div>

            </form>

        <? endif; ?>

    </div>

</div>

<!-- =============== PAGE SCRIPTS ===============-->
<script src='https://www.google.com/recaptcha/api.js'></script>
<script type="text/javascript" src="<?=$assets; ?>static/js/auth.js"></script>