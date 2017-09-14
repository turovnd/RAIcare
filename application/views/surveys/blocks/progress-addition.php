
<div class="block" >
    <div class="block__body">

        <table id="surveyProgress">
            <thead>
                <tr>
                    <th class="text-center" width="20%">Раздел</th>
                    <th width="50%" data-sortable="false">Название</th>
                    <th class="text-center" width="30%" data-type="number">Прогресс</th>
                </tr>
            </thead>
            <tbody>

                <tr onclick="window.location.assign('#unitA')" class="cursor-pointer">
                    <td class="text-center">A</td>
                    <td>Персональная информация</td>
                    <td class="text-center">
                        <?= !empty($survey->unitA->progress) ? $survey->unitA->progress : 0; ?>%
                    </td>
                </tr>
                
                <? if ($survey->type == 1) : ?>
                    
                    <tr onclick="window.location.assign('#unitB')" class="cursor-pointer">
                        <td class="text-center">B</td>
                        <td>Первоначальная история</td>
                        <td class="text-center">
                            <?= !empty($survey->unitB->progress) ? $survey->unitB->progress : 0; ?>%
                        </td>
                    </tr>
                    
                <? endif; ?>

                <tr onclick="window.location.assign('#unitC')" class="cursor-pointer">
                    <td class="text-center">C</td>
                    <td>Когнитивные способности</td>
                    <td class="text-center">
                        <?= !empty($survey->unitC->progress) ? $survey->unitC->progress : 0; ?>%
                    </td>
                </tr>

                <? if ($survey->unitC->C1 != 5) : ?>
                    
                    <tr onclick="window.location.assign('#unitD')" class="cursor-pointer">
                        <td class="text-center">D</td>
                        <td>Коммуникация и зрение</td>
                        <td class="text-center">
                            <?= !empty($survey->unitD->progress) ? $survey->unitD->progress : 0; ?>%
                        </td>
                    </tr>

                    <tr onclick="window.location.assign('#unitE')" class="cursor-pointer">
                        <td class="text-center">E</td>
                        <td>Настроение и поведение</td>
                        <td class="text-center">
                            <?= !empty($survey->unitE->progress) ? $survey->unitE->progress : 0; ?>%
                        </td>
                    </tr>

                    <tr onclick="window.location.assign('#unitF')" class="cursor-pointer">
                        <td class="text-center">F</td>
                        <td>Психосоциальное благополучие</td>
                        <td class="text-center">
                            <?= !empty($survey->unitF->progress) ? $survey->unitF->progress : 0; ?>%
                        </td>
                    </tr>
                
                <? endif; ?>

                <tr onclick="window.location.assign('#unitG')" class="cursor-pointer">
                    <td class="text-center">G</td>
                    <td>Функциональное состояние</td>
                    <td class="text-center">
                        <?= !empty($survey->unitG->progress) ? $survey->unitG->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitH')" class="cursor-pointer">
                    <td class="text-center">H</td>
                    <td>Недержание</td>
                    <td class="text-center">
                        <?= !empty($survey->unitH->progress) ? $survey->unitH->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitI')" class="cursor-pointer">
                    <td class="text-center">I</td>
                    <td>Диагнозы</td>
                    <td class="text-center">
                        <?= !empty($survey->unitI->progress) ? $survey->unitI->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitJ')" class="cursor-pointer">
                    <td class="text-center">J</td>
                    <td>Нарушения состояния здоровья</td>
                    <td class="text-center">
                        <?= !empty($survey->unitJ->progress) ? $survey->unitJ->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitK')" class="cursor-pointer">
                    <td class="text-center">K</td>
                    <td>Вопросы питания и состояние ротовой области</td>
                    <td class="text-center">
                        <?= !empty($survey->unitK->progress) ? $survey->unitK->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitL')" class="cursor-pointer">
                    <td class="text-center">L</td>
                    <td>Состояние кожи</td>
                    <td class="text-center">
                        <?= !empty($survey->unitL->progress) ? $survey->unitL->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitM')" class="cursor-pointer">
                    <td class="text-center">M</td>
                    <td>Досуг</td>
                    <td class="text-center">
                        <?= !empty($survey->unitM->progress) ? $survey->unitM->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitN')" class="cursor-pointer">
                    <td class="text-center">N</td>
                    <td>Лекарственные средства</td>
                    <td class="text-center">
                        <?= !empty($survey->unitN->progress) ? $survey->unitN->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitO')" class="cursor-pointer">
                    <td class="text-center">O</td>
                    <td>Лечебные мероприятия и процедуры</td>
                    <td class="text-center">
                        <?= !empty($survey->unitO->progress) ? $survey->unitO->progress : 0; ?>%
                    </td>
                </tr>

                <tr onclick="window.location.assign('#unitP')" class="cursor-pointer">
                    <td class="text-center">P</td>
                    <td>Правовая ответственность и распоряжения</td>
                    <td class="text-center">
                        <?= !empty($survey->unitP->progress) ? $survey->unitP->progress : 0; ?>%
                    </td>
                </tr>

                <? if ($survey->type != 5) : ?>

                    <tr onclick="window.location.assign('#unitQ')" class="cursor-pointer">
                        <td class="text-center">Q</td>
                        <td>Перспективы выписки</td>
                        <td class="text-center">
                            <?= !empty($survey->unitQ->progress) ? $survey->unitQ->progress : 0; ?>%
                        </td>
                    </tr>

                <? else: ?>

                    <tr onclick="window.location.assign('#unitR')" class="cursor-pointer">
                        <td class="text-center">R</td>
                        <td>Выписка</td>
                        <td class="text-center">
                            <?= !empty($survey->unitR->progress) ? $survey->unitR->progress : 0; ?>%
                        </td>
                    </tr>

                <? endif; ?>
            
            </tbody>
            <tfoot>
                <tr>
                    <th class="text-center">Раздел</th>
                    <th>Название</th>
                    <th class="text-center">Прогресс</th>
                </tr>
            </tfoot>
        </table>

    </div>
</div>