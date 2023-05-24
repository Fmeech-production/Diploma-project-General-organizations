<?php 
function table($SQL_zapros, $mysql){ 
    /**
     * @param string $SQL_zapros sql запрос 
     * @param mysqli $mysql подключение к базе данных
     */
?>
    <main style="padding-top: 10px;" class="table_organizer"> <!-- Основной контент -->
            <div class="slider-box">
                <div class="phone-switch">
                    <label for="phone-switch-toggle" class="phone-switch-background"></label>
                    <input type="checkbox" id="phone-switch-toggle" class="phone-switch-toggle">
                    <label for="phone-switch-toggle" class="phone-switch-label"></label>
                </div>
                <div class="slider-text block1">Компактный режим</div>
                <div class="slider-text-2 block2 hidden">Расширенный режим</div>
            </div>

            <div class="block1">
                <?php
                $заявкИ = $mysql->query($SQL_zapros);  // Запрос на получение заявок
                $количествоЗаявок = mysqli_num_rows($заявкИ);  // Получение количества заявок
                $schetchick = 1;    // Счетчик для отображения номера заявки
                $Заявка = $заявкИ->fetch_assoc();  // Получение первой заявки
                while ($Заявка != null) {   // Цикл для отображения всех заявок
                    if ($Заявка['Statys'] == 1) {   // Определение статуса заявки
                        $statys_text = "На рассмотрении";   // Текст статуса
                        $img_patch = "icons/consideration1.png";    // Путь к изображению статуса
                        $color_circle = "color-icons-grey"; // Цвет круга статуса
                    } else if ($Заявка['Statys'] == 2) {
                        $statys_text = "Одобрена";
                        $img_patch = "icons/confirmed1.png";
                        $color_circle = "color-icons-green";
                    } else if ($Заявка['Statys'] == 3) {
                        $statys_text = "Завершена";
                        $img_patch = "icons/completed1.png";
                        $color_circle = "color-icons-blue";
                    } else if ($Заявка['Statys'] == 4) {
                        $statys_text = "Отклонена";
                        $img_patch = "icons/rejected2.png";
                        $color_circle = "color-icons-red";
                    }

                    $time_has_passed = time() - $Заявка['Time_of_change'];  // Определение времени с момента изменения статуса заявки

                    if ($time_has_passed > 60 * 60 * 24)    // Определение единиц измерения времени
                        $time_has_passed = floor($time_has_passed / 60 / 60 / 24) . " дней назад";
                    else if ($time_has_passed > 60 * 60)
                        $time_has_passed = floor($time_has_passed / 60 / 60) . " часов назад";
                    else if ($time_has_passed > 60)
                        $time_has_passed = floor($time_has_passed / 60) . " минут назад";
                    else if ($time_has_passed > 0)
                        $time_has_passed = $time_has_passed . " секунд назад";
                ?>
                    <div class="zaivka  <?php if ($количествоЗаявок == $schetchick) echo "zaivka-edit"; ?>" onclick="window.location.href = 'info_Bookeds__HeadOfFacilities.php?id=<?= $Заявка['id'] ?>';"> <!-- Карточка заявки -->
                        <div class="zaivka-top"> <!-- Верхняя часть карточки -->
                            <span class="black-circle <?= $color_circle ?>"></span> <!-- Круг с цветом статуса -->
                            <div class="zaivka-time">Заявка <?= substr($Заявка['Day'], 8, 2) . "." . substr($Заявка['Day'], 5, 2) ?> в <?= $Заявка['Start_time'] ?></div> <!-- Время заявки -->
                            <div class="zaivka-status-div-img <?= $color_circle ?>"> <!-- Картинка статуса -->
                                <img class="zaivka-status-img" src="<?= $img_patch ?>">
                            </div>
                        </div>
                        <div class="zaivka-status"><?= $statys_text ?> <span class="mini-circle"></span><?= $time_has_passed ?></div> <!-- Текст статуса -->
                    </div>
                <?php
                    $schetchick++;  // Увеличение счетчика
                    $Заявка = $заявкИ->fetch_assoc();  // Получение следующей заявки
                }
                ?>
            </div>
            <div class="block2 hidden">
                <?php

                $заявкИ = $mysql->query($SQL_zapros);   // Запрос на получение заявок

                echo "<table style='table-layout: auto;'>";
                echo "<tr><th>Номер заявки</th><th>Ф.И.О.</th><th>Место отправления</th><th>Место прибытия</th><th>Дата отправки</th><th>Время отправки</th><th>Время возвращения</th><th>Количество пассажиров</th><th>Время изменения заявки</th><th>Статус заявки</th><th>Действия</th></tr>";

                while ($Заявка = $заявкИ->fetch_assoc()) {  // Цикл для отображения всех заявок
                    $id_user_booking =  $Заявка['IdUser'];
                    $PeopleS = $mysql->query("SELECT * FROM `users` WHERE `id` = '$id_user_booking'");
                    $People = $PeopleS->fetch_assoc();

                    if ($Заявка['Statys'] == 1) {   // Определение статуса заявки
                        $statys_text = "На рассмотрении";   // Текст статуса
                        $img_patch = "icons/consideration1.png";    // Путь к изображению статуса
                        $color_circle = "color-icons-grey"; // Цвет круга статуса
                    } else if ($Заявка['Statys'] == 2) {
                        $statys_text = "Одобрена";
                        $img_patch = "icons/confirmed1.png";
                        $color_circle = "color-icons-green";
                    } else if ($Заявка['Statys'] == 3) {
                        $statys_text = "Завершена";
                        $img_patch = "icons/completed1.png";
                        $color_circle = "color-icons-blue";
                    } else if ($Заявка['Statys'] == 4) {
                        $statys_text = "Отклонена";
                        $img_patch = "icons/rejected2.png";
                        $color_circle = "color-icons-red";
                    }

                    $time_has_passed = time() - $Заявка['Time_of_change'];  // Определение времени с момента изменения статуса заявки

                    if ($time_has_passed > 60 * 60 * 24)    // Определение единиц измерения времени
                        $time_has_passed = floor($time_has_passed / 60 / 60 / 24) . " дней назад";
                    else if ($time_has_passed > 60 * 60)
                        $time_has_passed = floor($time_has_passed / 60 / 60) . " часов назад";
                    else if ($time_has_passed > 60)
                        $time_has_passed = floor($time_has_passed / 60) . " минут назад";
                    else if ($time_has_passed > 0)
                        $time_has_passed = $time_has_passed . " секунд назад";

                    echo "<tr>";
                    echo "<td>" . $Заявка['id'] . "</td>";
                    echo "<td>" . $People['SName'] . " " . $People['Name'] . " " . $People['PName']  . "</td>";
                    echo "<td>" . $Заявка['Start_road'] . "</td>";
                    echo "<td>" . $Заявка['End_road'] . "</td>";
                    echo "<td>" . substr($Заявка['Day'],8,2).".".substr($Заявка['Day'],5,2).".".substr($Заявка['Day'],0,4) . "</td>";
                    echo "<td>" . $Заявка['Start_time'] . "</td>";
                    echo "<td>" . $Заявка['End_time'] . "</td>";
                    echo "<td>" . $Заявка['Number_people'] . "</td>";
                    echo "<td>" . $time_has_passed  . "</td>";
                    echo "<td style='padding:0 10px;' class='$color_circle'>" . $statys_text . "</td>";
                    echo "<td><a href='info_Bookeds__HeadOfFacilities.php?id=" . $Заявка['id'] . "' class='table-btn'>Подробнее</a></td>";
                    echo "</tr>";
                }

                echo "</table>";

                $mysql->close();
                ?>
            </div>
        </main>
<?php }