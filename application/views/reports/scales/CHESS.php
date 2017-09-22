<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.CHESS') as $CHESS) : ?>
        <li class="p-b-10">
            <?= $CHESS['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
