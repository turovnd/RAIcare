<div id="organization_<?=$organization->id?>" class="block">

    <a href="<?=URL::site('organization/'.$organization->id);?>" class="block__heading"><?= $organization->name; ?></a>

    <div class="block__body">

        <p> Создатель: <?= $organization->creator->name; ?> </p>

        <p> Создана: <?= $organization->dt_create; ?> </p>

    </div>

</div>