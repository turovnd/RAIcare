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

    <table class="tablesaw" data-tablesaw-mode="columntoggle" data-tablesaw-minimap>
        <thead>
            <tr>
                <th>id</th>
                <? for($i = 236; $i <= 261; $i++) : ?>
                    <th scope="col"  data-tablesaw-priority="<?= $i; ?>">
                        <?= $headers[$i]->value; ?>
                    </th>
                <? endfor; ?>
            </tr>
        </thead>
        <tbody>

            <? for($i = 0; $i < count($protocols); $i++) : ?>
                <tr>
                    <td>
                        <?= $protocols[$i]->id; ?>
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


