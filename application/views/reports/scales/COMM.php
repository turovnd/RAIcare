<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.COMM') as $COMM) : ?>
        <li class="p-b-10">
            <?= $COMM['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
