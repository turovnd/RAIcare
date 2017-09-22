<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.ADLH') as $ADLH) : ?>
        <li class="p-b-10">
            <?= $ADLH['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
