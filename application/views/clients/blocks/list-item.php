<div class="col-xs-12 col-md-6">

    <div id="client_<?=$client->id; ?>" class="block">

        <a href="<?=URL::site('client/' . $client->id); ?>" class="block__heading valign">
            <i class="fa fa-id-card-o fa-3x" aria-hidden="true"></i>
            <p class="m-0 m-l-15 text-bold"><?= $client->name; ?></p>
        </a>

        <div class="block__body">

            <div class="clear-fix m-b-10">
                <span class="col-xs-12 col-sm-4 col-lg-3 text-bold">Эл. почта</span>
                <span class="col-xs-12 col-sm-8 col-lg-9"><?= $client->email; ?></span>
            </div>

            <div class="clear-fix">
                <span class="col-xs-12 col-sm-4 col-lg-3 text-bold">Телефон</span>
                <span class="col-xs-12 col-sm-8 col-lg-9"><?= $client->phone; ?></span>
            </div>

        </div>

    </div>

</div>