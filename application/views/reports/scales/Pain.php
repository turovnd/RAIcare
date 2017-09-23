<ul class="list-style--none">
    <? foreach (Kohana::$config->load('RAIScales.Pain') as $Pain) : ?>
        <li class="p-b-10">
            <?= $Pain['name']; ?>
        </li>
    <? endforeach; ?>
</ul>
