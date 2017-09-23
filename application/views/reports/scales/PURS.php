<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.PURS') as $PURS) : ?>
        <li class="p-b-10">
            <?= $PURS['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
