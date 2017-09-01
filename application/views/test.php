<!DOCTYPE html>
<html lang="ru">
<head>
    <title><?=$GLOBALS['SITE_NAME']; ?></title>

    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <link rel="stylesheet" href="<?=$assets; ?>vendor/font-awesome/css/font-awesome.css?v=<?= filemtime("assets/vendor/font-awesome/css/font-awesome.css") ?>">

    <link rel="stylesheet" href="<?=$assets; ?>frontend/bundles/raicare.min.css?v=<?= filemtime("assets/frontend/bundles/raicare.min.css") ?>">
    <script type="text/javascript" src="<?=$assets; ?>frontend/bundles/raicare.min.js?v=<?= filemtime("assets/frontend/bundles/raicare.min.js") ?>"></script>

    <script type="text/javascript">
        function ready() {
            raicare.table.init();
            raicare.table.create();
        }

        document.addEventListener("DOMContentLoaded", ready);
    </script>

</head>

<body>



    $surveys;
    $protocols;
    $raiscales;
    $excel_surveys;
    $excel_protocols;
    $excel_raiscales;

    <table class="tablesaw" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
        <thead>
            <tr>
                <th>id</th>
                <? foreach ($headers as $key => $header) : ?>
                    <th scope="col"  data-tablesaw-priority="<?= $key + 1; ?>">
                        <?= $header->value; ?>
                    </th>
                <? endforeach; ?>
            </tr>
        </thead>
        <tbody>

            <? for($i = 0; $i <= 348; $i++) : ?>
                <tr>
                    <td>
                        <?= $i+1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C1 != $excel_surveys[$i]->unitC->C1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C1 . '||' . $excel_surveys[$i]->unitC->C1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C2[0] != $excel_surveys[$i]->unitC->C2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C2[0] . '||' . $excel_surveys[$i]->unitC->C2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C2[1] != $excel_surveys[$i]->unitC->C2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C2[1] . '||' . $excel_surveys[$i]->unitC->C2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C2[2] != $excel_surveys[$i]->unitC->C2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C2[2] . '||' . $excel_surveys[$i]->unitC->C2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C2[3] != $excel_surveys[$i]->unitC->C2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C2[3] . '||' . $excel_surveys[$i]->unitC->C2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C3[0] != $excel_surveys[$i]->unitC->C3[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C3[0] . '||' . $excel_surveys[$i]->unitC->C3[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C3[1] != $excel_surveys[$i]->unitC->C3[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C3[1] . '||' . $excel_surveys[$i]->unitC->C3[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C3[2] != $excel_surveys[$i]->unitC->C3[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C3[2] . '||' . $excel_surveys[$i]->unitC->C3[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C4 != $excel_surveys[$i]->unitC->C4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C4 . '||' . $excel_surveys[$i]->unitC->C4; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitC->C5 != $excel_surveys[$i]->unitC->C5 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitC->C5 . '||' . $excel_surveys[$i]->unitC->C5; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitD->D1 != $excel_surveys[$i]->unitD->D1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitD->D1 . '||' . $excel_surveys[$i]->unitD->D1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitD->D2 != $excel_surveys[$i]->unitD->D2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitD->D2 . '||' . $excel_surveys[$i]->unitD->D2; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitD->D3[0] != $excel_surveys[$i]->unitD->D3[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitD->D3[0] . '||' . $excel_surveys[$i]->unitD->D3[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitD->D3[1] != $excel_surveys[$i]->unitD->D3[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitD->D3[1] . '||' . $excel_surveys[$i]->unitD->D3[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitD->D4[0] != $excel_surveys[$i]->unitD->D4[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitD->D4[0] . '||' . $excel_surveys[$i]->unitD->D4[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitD->D4[1] != $excel_surveys[$i]->unitD->D4[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitD->D4[1] . '||' . $excel_surveys[$i]->unitD->D4[1]; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitE->E1[0] != $excel_surveys[$i]->unitE->E1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[0] . '||' . $excel_surveys[$i]->unitE->E1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[1] != $excel_surveys[$i]->unitE->E1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[1] . '||' . $excel_surveys[$i]->unitE->E1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[2] != $excel_surveys[$i]->unitE->E1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[2] . '||' . $excel_surveys[$i]->unitE->E1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[3] != $excel_surveys[$i]->unitE->E1[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[3] . '||' . $excel_surveys[$i]->unitE->E1[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[4] != $excel_surveys[$i]->unitE->E1[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[4] . '||' . $excel_surveys[$i]->unitE->E1[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[5] != $excel_surveys[$i]->unitE->E1[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[5] . '||' . $excel_surveys[$i]->unitE->E1[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[6] != $excel_surveys[$i]->unitE->E1[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[6] . '||' . $excel_surveys[$i]->unitE->E1[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[7] != $excel_surveys[$i]->unitE->E1[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[7] . '||' . $excel_surveys[$i]->unitE->E1[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[8] != $excel_surveys[$i]->unitE->E1[8] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[8] . '||' . $excel_surveys[$i]->unitE->E1[8]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[9] != $excel_surveys[$i]->unitE->E1[9] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[9] . '||' . $excel_surveys[$i]->unitE->E1[9]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E1[10] != $excel_surveys[$i]->unitE->E1[10] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E1[10] . '||' . $excel_surveys[$i]->unitE->E1[10]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E2[0] != $excel_surveys[$i]->unitE->E2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E2[0] . '||' . $excel_surveys[$i]->unitE->E2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E2[1] != $excel_surveys[$i]->unitE->E2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E2[1] . '||' . $excel_surveys[$i]->unitE->E2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E2[2] != $excel_surveys[$i]->unitE->E2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E2[2] . '||' . $excel_surveys[$i]->unitE->E2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E3[0] != $excel_surveys[$i]->unitE->E3[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E3[0] . '||' . $excel_surveys[$i]->unitE->E3[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E3[1] != $excel_surveys[$i]->unitE->E3[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E3[1] . '||' . $excel_surveys[$i]->unitE->E3[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E3[2] != $excel_surveys[$i]->unitE->E3[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E3[2] . '||' . $excel_surveys[$i]->unitE->E3[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E3[3] != $excel_surveys[$i]->unitE->E3[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E3[3] . '||' . $excel_surveys[$i]->unitE->E3[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E3[4] != $excel_surveys[$i]->unitE->E3[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E3[4] . '||' . $excel_surveys[$i]->unitE->E3[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitE->E3[5] != $excel_surveys[$i]->unitE->E3[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitE->E3[5] . '||' . $excel_surveys[$i]->unitE->E3[5]; ?>
                    </td>


                    <td class="<?= $surveys[$i]->unitF->F1[0] != $excel_surveys[$i]->unitF->F1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F1[0] . '||' . $excel_surveys[$i]->unitF->F1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F1[1] != $excel_surveys[$i]->unitF->F1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F1[1] . '||' . $excel_surveys[$i]->unitF->F1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F1[2] != $excel_surveys[$i]->unitF->F1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F1[2] . '||' . $excel_surveys[$i]->unitF->F1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[0] != $excel_surveys[$i]->unitF->F2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[0] . '||' . $excel_surveys[$i]->unitF->F2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[1] != $excel_surveys[$i]->unitF->F2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[1] . '||' . $excel_surveys[$i]->unitF->F2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[2] != $excel_surveys[$i]->unitF->F2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[2] . '||' . $excel_surveys[$i]->unitF->F2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[3] != $excel_surveys[$i]->unitF->F2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[3] . '||' . $excel_surveys[$i]->unitF->F2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[4] != $excel_surveys[$i]->unitF->F2[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[4] . '||' . $excel_surveys[$i]->unitF->F2[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[5] != $excel_surveys[$i]->unitF->F2[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[5] . '||' . $excel_surveys[$i]->unitF->F2[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F2[6] != $excel_surveys[$i]->unitF->F2[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F2[6] . '||' . $excel_surveys[$i]->unitF->F2[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F3[0] != $excel_surveys[$i]->unitF->F3[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F3[0] . '||' . $excel_surveys[$i]->unitF->F3[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F3[1] != $excel_surveys[$i]->unitF->F3[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F3[1] . '||' . $excel_surveys[$i]->unitF->F3[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F3[2] != $excel_surveys[$i]->unitF->F3[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F3[2] . '||' . $excel_surveys[$i]->unitF->F3[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F3[3] != $excel_surveys[$i]->unitF->F3[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F3[3] . '||' . $excel_surveys[$i]->unitF->F3[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F3[4] != $excel_surveys[$i]->unitF->F3[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F3[4] . '||' . $excel_surveys[$i]->unitF->F3[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F4 != $excel_surveys[$i]->unitF->F4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F4 . '||' . $excel_surveys[$i]->unitF->F4; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F5[0] != $excel_surveys[$i]->unitF->F5[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F5[0] . '||' . $excel_surveys[$i]->unitF->F5[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F5[1] != $excel_surveys[$i]->unitF->F5[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F5[1] . '||' . $excel_surveys[$i]->unitF->F5[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitF->F5[2] != $excel_surveys[$i]->unitF->F5[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitF->F5[2] . '||' . $excel_surveys[$i]->unitF->F5[2]; ?>
                    </td>


                    <td class="<?= $surveys[$i]->unitG->G1[0] != $excel_surveys[$i]->unitG->G1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[0] . '||' . $excel_surveys[$i]->unitG->G1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[1] != $excel_surveys[$i]->unitG->G1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[1] . '||' . $excel_surveys[$i]->unitG->G1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[2] != $excel_surveys[$i]->unitG->G1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[2] . '||' . $excel_surveys[$i]->unitG->G1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[3] != $excel_surveys[$i]->unitG->G1[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[3] . '||' . $excel_surveys[$i]->unitG->G1[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[4] != $excel_surveys[$i]->unitG->G1[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[4] . '||' . $excel_surveys[$i]->unitG->G1[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[5] != $excel_surveys[$i]->unitG->G1[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[5] . '||' . $excel_surveys[$i]->unitG->G1[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[6] != $excel_surveys[$i]->unitG->G1[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[6] . '||' . $excel_surveys[$i]->unitG->G1[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[7] != $excel_surveys[$i]->unitG->G1[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[7] . '||' . $excel_surveys[$i]->unitG->G1[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[8] != $excel_surveys[$i]->unitG->G1[8] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[8] . '||' . $excel_surveys[$i]->unitG->G1[8]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G1[9] != $excel_surveys[$i]->unitG->G1[9] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G1[9] . '||' . $excel_surveys[$i]->unitG->G1[9]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G2[0] != $excel_surveys[$i]->unitG->G2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G2[0] . '||' . $excel_surveys[$i]->unitG->G2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G2[1] != $excel_surveys[$i]->unitG->G2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G2[1] . '||' . $excel_surveys[$i]->unitG->G2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G2[2] != $excel_surveys[$i]->unitG->G2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G2[2] . '||' . $excel_surveys[$i]->unitG->G2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G2[3] != $excel_surveys[$i]->unitG->G2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G2[3] . '||' . $excel_surveys[$i]->unitG->G2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G3[0] != $excel_surveys[$i]->unitG->G3[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G3[0] . '||' . $excel_surveys[$i]->unitG->G3[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G3[1] != $excel_surveys[$i]->unitG->G3[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G3[1] . '||' . $excel_surveys[$i]->unitG->G3[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G4[0] != $excel_surveys[$i]->unitG->G4[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G4[0] . '||' . $excel_surveys[$i]->unitG->G4[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G4[1] != $excel_surveys[$i]->unitG->G4[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G4[1] . '||' . $excel_surveys[$i]->unitG->G4[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitG->G5 != $excel_surveys[$i]->unitG->G5 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitG->G5 . '||' . $excel_surveys[$i]->unitG->G5; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitH->H1 != $excel_surveys[$i]->unitH->H1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitH->H1 . '||' . $excel_surveys[$i]->unitH->H1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitH->H2 != $excel_surveys[$i]->unitH->H2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitH->H2 . '||' . $excel_surveys[$i]->unitH->H2; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitH->H3 != $excel_surveys[$i]->unitH->H3 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitH->H3 . '||' . $excel_surveys[$i]->unitH->H3; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitH->H4 != $excel_surveys[$i]->unitH->H4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitH->H4 . '||' . $excel_surveys[$i]->unitH->H4; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitI->I1[0] != $excel_surveys[$i]->unitI->I1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[0] . '||' . $excel_surveys[$i]->unitI->I1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[1] != $excel_surveys[$i]->unitI->I1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[1] . '||' . $excel_surveys[$i]->unitI->I1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[2] != $excel_surveys[$i]->unitI->I1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[2] . '||' . $excel_surveys[$i]->unitI->I1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[3] != $excel_surveys[$i]->unitI->I1[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[3] . '||' . $excel_surveys[$i]->unitI->I1[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[4] != $excel_surveys[$i]->unitI->I1[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[4] . '||' . $excel_surveys[$i]->unitI->I1[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[5] != $excel_surveys[$i]->unitI->I1[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[5] . '||' . $excel_surveys[$i]->unitI->I1[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[6] != $excel_surveys[$i]->unitI->I1[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[6] . '||' . $excel_surveys[$i]->unitI->I1[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[7] != $excel_surveys[$i]->unitI->I1[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[7] . '||' . $excel_surveys[$i]->unitI->I1[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[8] != $excel_surveys[$i]->unitI->I1[8] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[8] . '||' . $excel_surveys[$i]->unitI->I1[8]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[9] != $excel_surveys[$i]->unitI->I1[9] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[9] . '||' . $excel_surveys[$i]->unitI->I1[9]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[10] != $excel_surveys[$i]->unitI->I1[10] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[10] . '||' . $excel_surveys[$i]->unitI->I1[10]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[11] != $excel_surveys[$i]->unitI->I1[11] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[11] . '||' . $excel_surveys[$i]->unitI->I1[11]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[12] != $excel_surveys[$i]->unitI->I1[12] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[12] . '||' . $excel_surveys[$i]->unitI->I1[12]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[13] != $excel_surveys[$i]->unitI->I1[13] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[13] . '||' . $excel_surveys[$i]->unitI->I1[13]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[14] != $excel_surveys[$i]->unitI->I1[14] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[14] . '||' . $excel_surveys[$i]->unitI->I1[14]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[15] != $excel_surveys[$i]->unitI->I1[15] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[15] . '||' . $excel_surveys[$i]->unitI->I1[15]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[16] != $excel_surveys[$i]->unitI->I1[16] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[16] . '||' . $excel_surveys[$i]->unitI->I1[16]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[17] != $excel_surveys[$i]->unitI->I1[17] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[17] . '||' . $excel_surveys[$i]->unitI->I1[17]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[18] != $excel_surveys[$i]->unitI->I1[18] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[18] . '||' . $excel_surveys[$i]->unitI->I1[18]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[19] != $excel_surveys[$i]->unitI->I1[19] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[19] . '||' . $excel_surveys[$i]->unitI->I1[19]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitI->I1[20] != $excel_surveys[$i]->unitI->I1[20] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitI->I1[20] . '||' . $excel_surveys[$i]->unitI->I1[20]; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitJ->J1 != $excel_surveys[$i]->unitJ->J1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J1 . '||' . $excel_surveys[$i]->unitJ->J1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J2 != $excel_surveys[$i]->unitJ->J2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J2 . '||' . $excel_surveys[$i]->unitJ->J2; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[0] != $excel_surveys[$i]->unitJ->J3[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[0] . '||' . $excel_surveys[$i]->unitJ->J3[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[1] != $excel_surveys[$i]->unitJ->J3[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[1] . '||' . $excel_surveys[$i]->unitJ->J3[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[2] != $excel_surveys[$i]->unitJ->J3[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[2] . '||' . $excel_surveys[$i]->unitJ->J3[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[3] != $excel_surveys[$i]->unitJ->J3[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[3] . '||' . $excel_surveys[$i]->unitJ->J3[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[4] != $excel_surveys[$i]->unitJ->J3[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[4] . '||' . $excel_surveys[$i]->unitJ->J3[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[5] != $excel_surveys[$i]->unitJ->J3[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[5] . '||' . $excel_surveys[$i]->unitJ->J3[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[6] != $excel_surveys[$i]->unitJ->J3[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[6] . '||' . $excel_surveys[$i]->unitJ->J3[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[7] != $excel_surveys[$i]->unitJ->J3[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[7] . '||' . $excel_surveys[$i]->unitJ->J3[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[8] != $excel_surveys[$i]->unitJ->J3[8] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[8] . '||' . $excel_surveys[$i]->unitJ->J3[8]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[9] != $excel_surveys[$i]->unitJ->J3[9] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[9] . '||' . $excel_surveys[$i]->unitJ->J3[9]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[10] != $excel_surveys[$i]->unitJ->J3[10] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[10] . '||' . $excel_surveys[$i]->unitJ->J3[10]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[11] != $excel_surveys[$i]->unitJ->J3[11] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[11] . '||' . $excel_surveys[$i]->unitJ->J3[11]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[12] != $excel_surveys[$i]->unitJ->J3[12] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[12] . '||' . $excel_surveys[$i]->unitJ->J3[12]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[13] != $excel_surveys[$i]->unitJ->J3[13] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[13] . '||' . $excel_surveys[$i]->unitJ->J3[13]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[14] != $excel_surveys[$i]->unitJ->J3[14] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[14] . '||' . $excel_surveys[$i]->unitJ->J3[14]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[15] != $excel_surveys[$i]->unitJ->J3[15] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[15] . '||' . $excel_surveys[$i]->unitJ->J3[15]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[16] != $excel_surveys[$i]->unitJ->J3[16] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[16] . '||' . $excel_surveys[$i]->unitJ->J3[16]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[17] != $excel_surveys[$i]->unitJ->J3[17] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[17] . '||' . $excel_surveys[$i]->unitJ->J3[17]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[18] != $excel_surveys[$i]->unitJ->J3[18] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[18] . '||' . $excel_surveys[$i]->unitJ->J3[18]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[19] != $excel_surveys[$i]->unitJ->J3[19] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[19] . '||' . $excel_surveys[$i]->unitJ->J3[19]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J3[20] != $excel_surveys[$i]->unitJ->J3[20] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J3[20] . '||' . $excel_surveys[$i]->unitJ->J3[20]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J4 != $excel_surveys[$i]->unitJ->J4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J4 . '||' . $excel_surveys[$i]->unitJ->J4; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J5 != $excel_surveys[$i]->unitJ->J5 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J5 . '||' . $excel_surveys[$i]->unitJ->J5; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J6[0] != $excel_surveys[$i]->unitJ->J6[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J6[0] . '||' . $excel_surveys[$i]->unitJ->J6[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J6[1] != $excel_surveys[$i]->unitJ->J6[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J6[1] . '||' . $excel_surveys[$i]->unitJ->J6[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J6[2] != $excel_surveys[$i]->unitJ->J6[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J6[2] . '||' . $excel_surveys[$i]->unitJ->J6[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J6[3] != $excel_surveys[$i]->unitJ->J6[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J6[3] . '||' . $excel_surveys[$i]->unitJ->J6[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J6[4] != $excel_surveys[$i]->unitJ->J6[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J6[4] . '||' . $excel_surveys[$i]->unitJ->J6[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J7[0] != $excel_surveys[$i]->unitJ->J7[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J7[0] . '||' . $excel_surveys[$i]->unitJ->J7[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J7[1] != $excel_surveys[$i]->unitJ->J7[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J7[1] . '||' . $excel_surveys[$i]->unitJ->J7[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J7[2] != $excel_surveys[$i]->unitJ->J7[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J7[2] . '||' . $excel_surveys[$i]->unitJ->J7[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J8 != $excel_surveys[$i]->unitJ->J8 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J8 . '||' . $excel_surveys[$i]->unitJ->J8; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J9[0] != $excel_surveys[$i]->unitJ->J9[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J9[0] . '||' . $excel_surveys[$i]->unitJ->J9[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitJ->J9[1] != $excel_surveys[$i]->unitJ->J9[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitJ->J9[1] . '||' . $excel_surveys[$i]->unitJ->J9[1]; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitK->K1[0] != $excel_surveys[$i]->unitK->K1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K1[0] . '||' . $excel_surveys[$i]->unitK->K1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K1[1] != $excel_surveys[$i]->unitK->K1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K1[1] . '||' . $excel_surveys[$i]->unitK->K1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K2[0] != $excel_surveys[$i]->unitK->K2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K2[0] . '||' . $excel_surveys[$i]->unitK->K2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K2[1] != $excel_surveys[$i]->unitK->K2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K2[1] . '||' . $excel_surveys[$i]->unitK->K2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K2[2] != $excel_surveys[$i]->unitK->K2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K2[2] . '||' . $excel_surveys[$i]->unitK->K2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K2[3] != $excel_surveys[$i]->unitK->K2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K2[3] . '||' . $excel_surveys[$i]->unitK->K2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K3 != $excel_surveys[$i]->unitK->K3 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K3 . '||' . $excel_surveys[$i]->unitK->K3; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K4 != $excel_surveys[$i]->unitK->K4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K4 . '||' . $excel_surveys[$i]->unitK->K4; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K5[0] != $excel_surveys[$i]->unitK->K5[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K5[0] . '||' . $excel_surveys[$i]->unitK->K5[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K5[1] != $excel_surveys[$i]->unitK->K5[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K5[1] . '||' . $excel_surveys[$i]->unitK->K5[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K5[2] != $excel_surveys[$i]->unitK->K5[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K5[2] . '||' . $excel_surveys[$i]->unitK->K5[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K5[3] != $excel_surveys[$i]->unitK->K5[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K5[3] . '||' . $excel_surveys[$i]->unitK->K5[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K5[4] != $excel_surveys[$i]->unitK->K5[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K5[4] . '||' . $excel_surveys[$i]->unitK->K5[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitK->K5[5] != $excel_surveys[$i]->unitK->K5[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitK->K5[5] . '||' . $excel_surveys[$i]->unitK->K5[5]; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitL->L1 != $excel_surveys[$i]->unitL->L1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L1 . '||' . $excel_surveys[$i]->unitL->L1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitL->L2 != $excel_surveys[$i]->unitL->L2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L2 . '||' . $excel_surveys[$i]->unitL->L2; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitL->L3 != $excel_surveys[$i]->unitL->L3 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L3 . '||' . $excel_surveys[$i]->unitL->L3; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitL->L4 != $excel_surveys[$i]->unitL->L4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L4 . '||' . $excel_surveys[$i]->unitL->L4; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitL->L5 != $excel_surveys[$i]->unitL->L5 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L5 . '||' . $excel_surveys[$i]->unitL->L5; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitL->L6 != $excel_surveys[$i]->unitL->L6 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L6 . '||' . $excel_surveys[$i]->unitL->L6; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitL->L7 != $excel_surveys[$i]->unitL->L7 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitL->L7 . '||' . $excel_surveys[$i]->unitL->L7; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitM->M1 != $excel_surveys[$i]->unitM->M1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M1 . '||' . $excel_surveys[$i]->unitM->M1; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[0] != $excel_surveys[$i]->unitM->M2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[0] . '||' . $excel_surveys[$i]->unitM->M2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[1] != $excel_surveys[$i]->unitM->M2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[1] . '||' . $excel_surveys[$i]->unitM->M2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[2] != $excel_surveys[$i]->unitM->M2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[2] . '||' . $excel_surveys[$i]->unitM->M2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[3] != $excel_surveys[$i]->unitM->M2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[3] . '||' . $excel_surveys[$i]->unitM->M2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[4] != $excel_surveys[$i]->unitM->M2[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[4] . '||' . $excel_surveys[$i]->unitM->M2[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[5] != $excel_surveys[$i]->unitM->M2[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[5] . '||' . $excel_surveys[$i]->unitM->M2[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[6] != $excel_surveys[$i]->unitM->M2[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[6] . '||' . $excel_surveys[$i]->unitM->M2[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[7] != $excel_surveys[$i]->unitM->M2[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[7] . '||' . $excel_surveys[$i]->unitM->M2[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[8] != $excel_surveys[$i]->unitM->M2[8] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[8] . '||' . $excel_surveys[$i]->unitM->M2[8]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[9] != $excel_surveys[$i]->unitM->M2[9] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[9] . '||' . $excel_surveys[$i]->unitM->M2[9]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[10] != $excel_surveys[$i]->unitM->M2[10] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[10] . '||' . $excel_surveys[$i]->unitM->M2[10]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[11] != $excel_surveys[$i]->unitM->M2[11] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[11] . '||' . $excel_surveys[$i]->unitM->M2[11]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[12] != $excel_surveys[$i]->unitM->M2[12] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[12] . '||' . $excel_surveys[$i]->unitM->M2[12]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[13] != $excel_surveys[$i]->unitM->M2[13] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[13] . '||' . $excel_surveys[$i]->unitM->M2[13]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[14] != $excel_surveys[$i]->unitM->M2[14] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[14] . '||' . $excel_surveys[$i]->unitM->M2[14]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M2[15] != $excel_surveys[$i]->unitM->M2[15] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M2[15] . '||' . $excel_surveys[$i]->unitM->M2[15]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitM->M3 != $excel_surveys[$i]->unitM->M3 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitM->M3 . '||' . $excel_surveys[$i]->unitM->M3; ?>
                    </td>


                    <td class="<?= $surveys[$i]->unitN->N2 != $excel_surveys[$i]->unitN->N2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitN->N2 . '||' . $excel_surveys[$i]->unitN->N2; ?>
                    </td>


                    <td class="<?= $surveys[$i]->unitO->O1[0] != $excel_surveys[$i]->unitO->O1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[0] . '||' . $excel_surveys[$i]->unitO->O1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[1] != $excel_surveys[$i]->unitO->O1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[1] . '||' . $excel_surveys[$i]->unitO->O1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[2] != $excel_surveys[$i]->unitO->O1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[2] . '||' . $excel_surveys[$i]->unitO->O1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[3] != $excel_surveys[$i]->unitO->O1[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[3] . '||' . $excel_surveys[$i]->unitO->O1[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[4] != $excel_surveys[$i]->unitO->O1[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[4] . '||' . $excel_surveys[$i]->unitO->O1[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[5] != $excel_surveys[$i]->unitO->O1[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[5] . '||' . $excel_surveys[$i]->unitO->O1[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[6] != $excel_surveys[$i]->unitO->O1[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[6] . '||' . $excel_surveys[$i]->unitO->O1[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O1[7] != $excel_surveys[$i]->unitO->O1[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O1[7] . '||' . $excel_surveys[$i]->unitO->O1[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[0] != $excel_surveys[$i]->unitO->O2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[0] . '||' . $excel_surveys[$i]->unitO->O2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[1] != $excel_surveys[$i]->unitO->O2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[1] . '||' . $excel_surveys[$i]->unitO->O2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[2] != $excel_surveys[$i]->unitO->O2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[2] . '||' . $excel_surveys[$i]->unitO->O2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[3] != $excel_surveys[$i]->unitO->O2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[3] . '||' . $excel_surveys[$i]->unitO->O2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[4] != $excel_surveys[$i]->unitO->O2[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[4] . '||' . $excel_surveys[$i]->unitO->O2[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[5] != $excel_surveys[$i]->unitO->O2[5] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[5] . '||' . $excel_surveys[$i]->unitO->O2[5]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[6] != $excel_surveys[$i]->unitO->O2[6] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[6] . '||' . $excel_surveys[$i]->unitO->O2[6]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[7] != $excel_surveys[$i]->unitO->O2[7] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[7] . '||' . $excel_surveys[$i]->unitO->O2[7]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[8] != $excel_surveys[$i]->unitO->O2[8] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[8] . '||' . $excel_surveys[$i]->unitO->O2[8]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[9] != $excel_surveys[$i]->unitO->O2[9] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[9] . '||' . $excel_surveys[$i]->unitO->O2[9]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[10] != $excel_surveys[$i]->unitO->O2[10] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[10] . '||' . $excel_surveys[$i]->unitO->O2[10]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[11] != $excel_surveys[$i]->unitO->O2[11] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[11] . '||' . $excel_surveys[$i]->unitO->O2[11]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[12] != $excel_surveys[$i]->unitO->O2[12] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[12] . '||' . $excel_surveys[$i]->unitO->O2[12]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O2[13] != $excel_surveys[$i]->unitO->O2[13] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O2[13] . '||' . $excel_surveys[$i]->unitO->O2[13]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[0][0] != $excel_surveys[$i]->unitO->O3[0][0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[0][0] . '||' . $excel_surveys[$i]->unitO->O3[0][0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[0][1] != $excel_surveys[$i]->unitO->O3[0][1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[0][1] . '||' . $excel_surveys[$i]->unitO->O3[0][1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[0][2] != $excel_surveys[$i]->unitO->O3[0][2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[0][2] . '||' . $excel_surveys[$i]->unitO->O3[0][2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[1][0] != $excel_surveys[$i]->unitO->O3[1][0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[1][0] . '||' . $excel_surveys[$i]->unitO->O3[1][0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[1][1] != $excel_surveys[$i]->unitO->O3[1][1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[1][1] . '||' . $excel_surveys[$i]->unitO->O3[1][1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[1][2] != $excel_surveys[$i]->unitO->O3[1][2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[1][2] . '||' . $excel_surveys[$i]->unitO->O3[1][2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[2][0] != $excel_surveys[$i]->unitO->O3[2][0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[2][0] . '||' . $excel_surveys[$i]->unitO->O3[2][0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[2][1] != $excel_surveys[$i]->unitO->O3[2][1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[2][1] . '||' . $excel_surveys[$i]->unitO->O3[2][1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[2][2] != $excel_surveys[$i]->unitO->O3[2][2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[2][2] . '||' . $excel_surveys[$i]->unitO->O3[2][2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[3][0] != $excel_surveys[$i]->unitO->O3[3][0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[3][0] . '||' . $excel_surveys[$i]->unitO->O3[3][0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[3][1] != $excel_surveys[$i]->unitO->O3[3][1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[3][1] . '||' . $excel_surveys[$i]->unitO->O3[3][1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[3][2] != $excel_surveys[$i]->unitO->O3[3][2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[3][2] . '||' . $excel_surveys[$i]->unitO->O3[3][2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[4][0] != $excel_surveys[$i]->unitO->O3[4][0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[4][0] . '||' . $excel_surveys[$i]->unitO->O3[4][0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[4][1] != $excel_surveys[$i]->unitO->O3[4][1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[4][1] . '||' . $excel_surveys[$i]->unitO->O3[4][1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[4][2] != $excel_surveys[$i]->unitO->O3[4][2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[4][2] . '||' . $excel_surveys[$i]->unitO->O3[4][2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[5][0] != $excel_surveys[$i]->unitO->O3[5][0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[5][0] . '||' . $excel_surveys[$i]->unitO->O3[5][0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[5][1] != $excel_surveys[$i]->unitO->O3[5][1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[5][1] . '||' . $excel_surveys[$i]->unitO->O3[5][1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O3[5][2] != $excel_surveys[$i]->unitO->O3[5][2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O3[5][2] . '||' . $excel_surveys[$i]->unitO->O3[5][2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O4[0] != $excel_surveys[$i]->unitO->O4[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O4[0] . '||' . $excel_surveys[$i]->unitO->O4[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O4[1] != $excel_surveys[$i]->unitO->O4[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O4[1] . '||' . $excel_surveys[$i]->unitO->O4[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O5 != $excel_surveys[$i]->unitO->O5 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O5 . '||' . $excel_surveys[$i]->unitO->O5; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O6 != $excel_surveys[$i]->unitO->O6 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O6 . '||' . $excel_surveys[$i]->unitO->O6; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O7[0] != $excel_surveys[$i]->unitO->O7[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O7[0] . '||' . $excel_surveys[$i]->unitO->O7[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O7[1] != $excel_surveys[$i]->unitO->O7[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O7[1] . '||' . $excel_surveys[$i]->unitO->O7[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitO->O7[2] != $excel_surveys[$i]->unitO->O7[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitO->O7[2] . '||' . $excel_surveys[$i]->unitO->O7[2]; ?>
                    </td>



                    <td class="<?= $surveys[$i]->unitP->P1[0] != $excel_surveys[$i]->unitP->P1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P1[0] . '||' . $excel_surveys[$i]->unitP->P1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P1[1] != $excel_surveys[$i]->unitP->P1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P1[1] . '||' . $excel_surveys[$i]->unitP->P1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P1[2] != $excel_surveys[$i]->unitP->P1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P1[2] . '||' . $excel_surveys[$i]->unitP->P1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P1[3] != $excel_surveys[$i]->unitP->P1[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P1[3] . '||' . $excel_surveys[$i]->unitP->P1[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P1[4] != $excel_surveys[$i]->unitP->P1[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P1[4] . '||' . $excel_surveys[$i]->unitP->P1[4]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P2[0] != $excel_surveys[$i]->unitP->P2[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P2[0] . '||' . $excel_surveys[$i]->unitP->P2[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P2[1] != $excel_surveys[$i]->unitP->P2[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P2[1] . '||' . $excel_surveys[$i]->unitP->P2[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P2[2] != $excel_surveys[$i]->unitP->P2[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P2[2] . '||' . $excel_surveys[$i]->unitP->P2[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P2[3] != $excel_surveys[$i]->unitP->P2[3] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P2[3] . '||' . $excel_surveys[$i]->unitP->P2[3]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitP->P2[4] != $excel_surveys[$i]->unitP->P2[4] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitP->P2[4] . '||' . $excel_surveys[$i]->unitP->P2[4]; ?>
                    </td>


                    <td class="<?= $surveys[$i]->unitQ->Q1[0] != $excel_surveys[$i]->unitQ->Q1[0] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitQ->Q1[0] . '||' . $excel_surveys[$i]->unitQ->Q1[0]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitQ->Q1[1] != $excel_surveys[$i]->unitQ->Q1[1] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitQ->Q1[1] . '||' . $excel_surveys[$i]->unitQ->Q1[1]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitQ->Q1[2] != $excel_surveys[$i]->unitQ->Q1[2] ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitQ->Q1[2] . '||' . $excel_surveys[$i]->unitQ->Q1[2]; ?>
                    </td>
                    <td class="<?= $surveys[$i]->unitQ->Q2 != $excel_surveys[$i]->unitQ->Q2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $surveys[$i]->unitQ->Q2 . '||' . $excel_surveys[$i]->unitQ->Q2; ?>
                    </td>





                    <td class="<?= $raiscales[$i]->PURS != $excel_raiscales[$i]->PURS ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->PURS . '||' . $excel_raiscales[$i]->PURS; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->CPS != $excel_raiscales[$i]->CPS ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->CPS . '||' . $excel_raiscales[$i]->CPS; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->BMI != $excel_raiscales[$i]->BMI ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->BMI . '||' . $excel_raiscales[$i]->BMI; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->SRD != $excel_raiscales[$i]->SRD ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->SRD . '||' . $excel_raiscales[$i]->SRD; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->DRS != $excel_raiscales[$i]->DRS ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->DRS . '||' . $excel_raiscales[$i]->DRS; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->Pain != $excel_raiscales[$i]->Pain ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->Pain . '||' . $excel_raiscales[$i]->Pain; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->COMM != $excel_raiscales[$i]->COMM ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->COMM . '||' . $excel_raiscales[$i]->COMM; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->CHESS != $excel_raiscales[$i]->CHESS ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->CHESS . '||' . $excel_raiscales[$i]->CHESS; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->ADLH != $excel_raiscales[$i]->ADLH ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->ADLH . '||' . $excel_raiscales[$i]->ADLH; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->ABS != $excel_raiscales[$i]->ABS ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->ABS . '||' . $excel_raiscales[$i]->ABS; ?>
                    </td>
                    <td class="<?= $raiscales[$i]->ADLLF != $excel_raiscales[$i]->ADLLF ? 'text-danger text-bold' : ''; ?>">
                        <?= $raiscales[$i]->ADLLF . '||' . $excel_raiscales[$i]->ADLLF; ?>
                    </td>





                    <td class="<?= $protocols[$i]->P1 != $excel_protocols[$i]->P1 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P1 . '||' . $excel_protocols[$i]->P1; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P2 != $excel_protocols[$i]->P2 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P2 . '||' . $excel_protocols[$i]->P2; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P3 != $excel_protocols[$i]->P3 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P3 . '||' . $excel_protocols[$i]->P3; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P4 != $excel_protocols[$i]->P4 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P4 . '||' . $excel_protocols[$i]->P4; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P5 != $excel_protocols[$i]->P5 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P5 . '||' . $excel_protocols[$i]->P5; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P6 != $excel_protocols[$i]->P6 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P6 . '||' . $excel_protocols[$i]->P6; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P7 != $excel_protocols[$i]->P7 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P7 . '||' . $excel_protocols[$i]->P7; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P8 != $excel_protocols[$i]->P8 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P8 . '||' . $excel_protocols[$i]->P8; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P9 != $excel_protocols[$i]->P9 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P9 . '||' . $excel_protocols[$i]->P9; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P10 != $excel_protocols[$i]->P10 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P10 . '||' . $excel_protocols[$i]->P10; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P11 != $excel_protocols[$i]->P11 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P11 . '||' . $excel_protocols[$i]->P11; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P12 != $excel_protocols[$i]->P12 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P12 . '||' . $excel_protocols[$i]->P12; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P13 != $excel_protocols[$i]->P13 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P13 . '||' . $excel_protocols[$i]->P13; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P14 != $excel_protocols[$i]->P14 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P14 . '||' . $excel_protocols[$i]->P14; ?>
                    </td>
                    <td class="<?= $protocols[$i]->P15 != $excel_protocols[$i]->P15 ? 'text-danger text-bold' : ''; ?>">
                        <?= $protocols[$i]->P15 . '||' . $excel_protocols[$i]->P15; ?>
                    </td>

                </tr>
            <? endfor; ?>

        </tbody>
    </table>

</body>

</html>


