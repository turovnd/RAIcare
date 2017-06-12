<div id="pension_<?=$pension->id?>" class="block">

    <a href="<?=URL::site('pension/'.$pension->id);?>" class="block__heading"><?= $pension->name; ?></a>

    <div class="block__body">

        <p> Создатель: <?= $pension->creator->name; ?> </p>

        <p> Создана: <?= $pension->dt_create; ?> </p>

    </div>

</div>