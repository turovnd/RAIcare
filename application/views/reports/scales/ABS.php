<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.ABS') as $ABS) : ?>
        <li class="p-b-10">
            <?= $ABS['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
