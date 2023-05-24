<!-- Редактор аватара и обложки -->
<div class="avatar-editor"> <!-- Контейнер для редактора аватара и обложки -->
    <div class="avatar-editor-fon"> <!-- Контейнер для обложки -->
        <img class="avatar-editor-fon-img" src="/users/<?= $user['Login'] ?>/img/<?= $user['cover'] ?>"> <!--Изображение обложки-->
    </div>
    <div class="editor-background-greey"></div> <!-- Фон для редактора -->
    <form action="php_form/img_loader.php" method="post" id="ava-form" class="ava-form" enctype="multipart/form-data" style="display: none;"> <!-- Форма для редактора аватара -->
        <div class="backgroung-black-active" onclick="exzit_edit()"></div> <!-- Затемнёный фон для редактора аватарки-->
        <div class="ava-form-popup" id="ava_form1"> <!-- Контейнер для редактора аватара -->
            <div class="ava-text1"> <!-- Заголовок редактора -->
                <div>
                    <?= $loc['Uploading_a_new_photo'] ?> <!-- Текст заголовока редактора -->
                </div>
                <img src="icons/close.png" class="close-new-ava" onclick="exzit_edit()"> <!-- Кнопка закрытия редактора -->
            </div>
            <div class="ava-text2"> <!-- Контейнер для текста редактора -->
                <?= $loc['It_will_be_easier_for_an_employee_to_recognize_you_if_you_upload_your_real_photo'] ?> <!-- Текст редактора -->
            </div>
            <label for="new_ava" type="button" class="new_ava_lable select"><?= $loc['Select_a_file'] ?> </label> <!-- Кнопка выбора файла -->
            <input name="img_loader" type="file" id="new_ava"> <!-- Поле выбора файла -->

            <div class="ava-text3"> <!-- Контейнер для текста редактора -->
                <?= $loc['If_you_are_having_problems_uploading_try_choosing_a_different_photo'] ?> <!-- Текст редактора -->
            </div>
        </div>
        <div class="ava-form-popup" id="ava_form2" style="display: none;"> <!-- Контейнер для редактора аватара -->
            <div class="ava-text1"> <!-- Заголовок редактора -->
                <div>
                    <?= $loc['Uploading_a_new_photo'] ?> <!-- Текст заголовока редактора -->
                </div>
                <img src="icons/close.png" class="close-new-ava" onclick="exzit_edit()"> <!-- Кнопка закрытия редактора -->
            </div>
            <div class="ava-text2-2"> <!-- Контейнер для текста редактора -->
                <?= $loc['The_selected_thumbnail_will_be_used_in_the_profile_and_applications'] ?> <!-- Текст редактора -->
            </div>
            <div class="red-ava-rezult" id="ava_rezult"> <!-- Контейнер для результата редактора аватарки-->
            </div>
            <div class="bnt_box_ed_st"> <!-- Контейнер для редактора размера аватарки -->
                <input id="range_img_ava" name="range_img" type="range" min="0" max="100" value="0" class="slider"> <!-- Ползунок редактора размера аватарки -->
            </div>
            <div class="bnt_box_ed_st"> <!-- Контейнер для кнопок редактора -->
                <button class="save_rez" type="submit"> <?= $loc['Save_and_continue'] ?></button> <!-- Кнопка сохранения результата редактора -->
                <button class="not_save_rez" onclick="nazad_red_ava()" type="button"><?= $loc['Go_back'] ?></button> <!-- Кнопка отмены результата редактора -->
            </div>
        </div>
        <script>
            let ava_form = document.getElementById("ava-form").style;
            let ava_form1 = document.getElementById("ava_form1").style;
            let ava_form2 = document.getElementById("ava_form2").style;

            $('#new_ava').change(function() { // При изменении файла в поле выбора файла
                let file = this.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    ava_form1.display = "none";
                    ava_form2.display = "block";
                    $('#ava_rezult').empty();
                    $('#ava_rezult').append('<img class="red-ava-rezult-img" src="' + e.target.result + '"/>');
                };
                reader.readAsDataURL(file);
            });

            function nazad_red_ava() {
                ava_form1.display = "block";
                ava_form2.display = "none";
            }

            function nazad_red_cover() {
                cover_form1.display = "block";
                cover_form2.display = "none";
            }

            function exzit_edit() {
                ava_form.display = "none";
                ava_form1.display = "none";
                ava_form2.display = "none";
                cover_form.display = "none";
                cover_form1.display = "none";
                cover_form2.display = "none";
            }

            function start_edit() {
                ava_form.display = "block";
                ava_form1.display = "block";
                ava_form2.display = "none";
            }

            function start_edit_cover() {
                cover_form.display = "block";
                cover_form1.display = "block";
                cover_form2.display = "none";
            }


            $(document).ready(function() {
                $('#range_img_ava').on('input', function() { // Код, выполняемый при изменении значения ползунка
                    var value = $(this).val();
                    var image = $('.red-ava-rezult-img');
                    image.css({
                        'transform': 'scale(' + (1 + value / 100) + ')'
                    });
                });
            });
        </script>
    </form>




    <form action="php_form/img_loader_cover.php" method="post" id="cover-form" class="ava-form" enctype="multipart/form-data" style="display: none;"> <!-- Контейнер для редактора обложки -->
        <div class="backgroung-black-active" onclick="exzit_edit()"></div> <!-- Затемнёный фон для редактора обложки -->
        <div class="ava-form-popup" id="cover_form1"> <!-- Контейнер для редактора обложки -->
            <div class="ava-text1"> <!-- Заголовок редактора -->
                <div>
                    <?= $loc['Adding_a_cover'] ?> <!-- Текст заголовока редактора -->
                </div>
                <img src="icons/close.png" class="close-new-ava" onclick="exzit_edit()"> <!-- Кнопка закрытия редактора -->
            </div>
            <label for="new_cover2" type="button" class="new_ava_lable label_new_ava2"> <!-- Кнопка выбора файла -->
                <img src="icons/plus.png" class="plus_new_ava" style="width: 30px; height:30px; margin-top:auto;"> <!-- Иконка кнопки выбора файла -->
                <div style="width: 100%;margin-bottom:auto; text-align: center;"><?= $loc['Select_a_file'] ?></div> <!-- Текст кнопки выбора файла -->
            </label>
            <input name="img_loader" type="file" id="new_cover2"> <!-- Поле выбора файла -->
            <div class="ava-text3"> <!-- Контейнер для текста редактора -->
                <?= $loc['If_you_are_having_problems_uploading_try_choosing_a_different_photo'] ?> <!-- Текст редактора -->
            </div>
        </div>
        <div class="ava-form-popup" id="cover_form2"> <!-- Контейнер для редактора обложки -->
            <div class="ava-text1"> <!-- Заголовок редактора -->
                <div> <!-- Текст заголовока редактора -->
                    <?= $loc['Preview_of_the_cover'] ?> <!-- Текст заголовока редактора -->
                </div>
                <img src="icons/close.png" class="close-new-ava" onclick="exzit_edit()"> <!-- Кнопка закрытия редактора -->
            </div>
            <div class="ava-text2-2"> <!-- Контейнер для текста редактора -->
                <?= $loc['The_cover_you_have_chosen_will_be_visible_in_your_profile'] ?> <!-- Текст редактора -->
            </div>
            <div class="avatar-editor" style="margin: auto; margin-bottom: 30px;"> <!-- Контейнер для редактора обложки -->
                <div class="avatar-editor-fon" id="cover_rezult"> <!-- Контейнер для результата редактора обложки -->
                </div>
                <div class="editor-background-greey"></div> <!-- Затемнёный фон для редактора обложки -->
                <div>
                    <div class="my-ava-div" id="id-ava-div"> <!-- Контейнер для аватарки -->
                        <img class="my-ava-img" src="/users/<?= $user['Login'] ?>/img/<?= $user['ava'] ?>" id="cover_edit_ava"> <!-- Аватарка -->
                    </div>
                    <div class="info_acc_text1"><?= $user['SName'] . " " . $user['Name'] . " " . $user['PName'] ?></div> <!-- Имя пользователя -->
                    <script>
                        $(document).ready(function() { // Код, выполняемый после загрузки страницы
                            var image = $('#cover_edit_ava');
                            image.css({
                                'transform': 'scale(' + <?= $user['range_img'] ?> + ')'
                            });
                        });
                    </script>
                </div>
            </div>
            <div class="bnt_box_ed_st"> <!-- Контейнер для кнопок редактора -->
                <button class="save_rez" type="submit"><?= $loc['Save_and_continue'] ?></button> <!-- Кнопка сохранения результата редактора -->
                <button class="not_save_cover" onclick="nazad_red_cover()" type="button"><?= $loc['Go_back'] ?></button> <!-- Кнопка отмены редактирования -->
            </div>
        </div>
        <script>
            let cover_form = document.getElementById("cover-form").style;
            let cover_form1 = document.getElementById("cover_form1").style;
            let cover_form2 = document.getElementById("cover_form2").style;

            $('#new_cover2').change(function() {
                let file = this.files[0];
                let reader = new FileReader();
                reader.onload = function(e) {
                    cover_form1.display = "none";
                    cover_form2.display = "block";
                    $('#cover_rezult').empty();
                    $('#cover_rezult').append('<img class="avatar-editor-fon-img" src="' + e.target.result + '"/>');
                };
                reader.readAsDataURL(file);
            });
        </script>
    </form>




    <div class="mobail-avatar"> <!-- Контейнер для мобильной версии -->
        <div class="my-ava-div" id="id-ava-div"> <!-- Контейнер для аватарки -->
            <img class="my-ava-img" src="/users/<?= $user['Login'] ?>/img/<?= $user['ava'] ?>" id="edit_ava"> <!-- Аватарка -->
        </div>
        <div class="my-ava-div bcg-div" onclick="start_edit()"></div> <!-- Контейнер для аватарки -->
        <img class="my-ava-div bcg" src="img/load.png" onclick="start_edit()"> <!-- Аватарка -->
        <div class="info_acc_text1"><?= $user['SName'] . " " . $user['Name'] . " " . $user['PName'] ?></div> <!-- Имя пользователя -->
        <div class="background-color-black-opacity info_acc_text2" onclick="start_edit_cover()"><?= $loc['Change_the_cover'] ?> </div> <!-- Кнопка изменения обложки -->
        <script>
            $(document).ready(function() { // Код, выполняемый после загрузки страницы      
                var image = $('#edit_ava');
                image.css({
                    'transform': 'scale(' + <?= $user['range_img'] ?> + ')'
                });
            });
        </script>
    </div>
</div>
