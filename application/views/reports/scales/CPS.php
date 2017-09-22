<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.CPS') as $CPS) : ?>
        <li class="p-b-10">
            <?= $CPS['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
