<form class="modal" id="newCoWorker" tabindex="-1">
    <div class="modal__content">
        <div class="modal__wrapper">
            <div class="modal__header">
                <button type="button" class="modal__title-close" data-close="modal">
                    <i class="fa fa-close" aria-hidden="true"></i>
                </button>
                <h4 class="modal__title">Приглашение сотрудника</h4>
            </div>
            <div class="modal__body">
                <p class="text-danger text-italic">Все поля обязательны для заполнения</p>
                <fieldset>
                    <div class="form-group">
                        <label for="newCoWorkerName" class="form-group__label p-t-0">Имя</label>
                        <input type="text" id="newCoWorkerName" name="name" class="form-group__control" maxlength="256">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newCoWorkerEmail" class="form-group__label p-t-0">Эл.почта</label>
                        <input type="email" id="newCoWorkerEmail" name="email" class="form-group__control" maxlength="64">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newCoWorkerUserName" class="form-group__label p-t-0">Логин</label>
                        <input type="text" id="newCoWorkerUserName" name="username" class="form-group__control" maxlength="30">
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newCoWorkerRole" class="form-group__label p-t-0 p-t-0">Роль</label>
                        <select name="role" id="newCoWorkerRole" class="form-group__control js-single-select">
                            <option selected disabled>Не выбрано</option>
                            <? foreach ($roles as $role) : ?>
                                <option value="<?=$role->id; ?>"><?=$role->name; ?></option>
                            <? endforeach; ?>
                        </select>
                    </div>
                </fieldset>

                <fieldset>
                    <div class="form-group">
                        <label for="newCoWorkerPensions" class="form-group__label p-t-0">
                            Пансинаты
                            <small class="text-italic text-normal text-brand">Укажите пансионаты только для ролей связанных с пансионатами</small>
                        </label>

                        <? foreach ($pensions as $pension) : ?>
                            <p>
                                <input type="checkbox" id="newCoWorkerPension<?= $pension['id']; ?>" name="pensions[]" class="checkbox" value="<?= $pension['id']; ?>">
                                <label for="newCoWorkerPension<?= $pension['id']; ?>" class="checkbox-label"><?= $pension['name']; ?></label>
                            </p>
                        <? endforeach; ?>

                    </div>
                </fieldset>

            </div>
            <div class="modal__footer">
                <button type="button" class="btn btn--default" data-close="modal">Отмена</button>
                <button onclick="organization.coworker.invite()" type="button" class="btn btn--brand">Создать</button>
            </div>
        </div>
    </div>
</form>