<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.DRS') as $DRS) : ?>
        <li class="p-b-10">
            <?= $DRS['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
