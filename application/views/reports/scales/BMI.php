<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.BMI') as $BMI) : ?>
        <li class="p-b-10">
            <?= $BMI['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
