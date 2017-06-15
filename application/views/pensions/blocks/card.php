<div class="col-xs-12 col-sm-6 col-md-4">

    <div class="card">

        <a href="<?=URL::site('pension/' . $pension->id); ?>" class="card__img" style="background-image: url(<?=URL::site('uploads/pensions/cover/o_' . $pension->cover); ?>)"></a>

        <div class="card__content">

            <div class="card__content-heading">
                <?= $pension->name; ?>
            </div>

            <div class="card__content-body">

                <p class="card__content-text">Дата создания: <?= $pension->dt_create; ?></p>

            </div>

        </div>

    </div>

</div>
