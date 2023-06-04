<style>
	#loading {
		position: fixed;
		z-index: 999;
		height: 2em;
		width: 2em;
		overflow: show;
		margin: auto;
		top: 0;
		left: 0;
		bottom: 0;
		right: 0;
		pointer-events: none;
		opacity: 0;
		animation: op .2s forwards;
		animation-delay: .5s;
	}

	/* Transparent overlay */
	#loading:before {
		content: '';
		display: block;
		position: fixed;
		z-index: 998;
		background-color: rgba(0, 0, 0, 0.3);
		height: 100%;
		width: 100%;
		top: 0;
		left: 0;
	}

	/* White background spinner */
	#loading-img {
		content: '';
		display: block;
		position: fixed;
		z-index: 999;
		background-repeat: no-repeat;
		background-position: center center;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
	}

	@keyframes op {
		0% {
			opacity: 0;
		}

		100% {
			opacity: 1;
		}
	}
</style>



<div id="loading" loading="eager">
	<img src="img/loading.gif" alt="Крутящаяса собака загрузки" loading="eager" id="loading-img">
</div>
<script>
	window.addEventListener('load', function() {
		var loading = document.getElementById('loading');
		loading.style.display = 'none';
	})
</script>
<?php
/**
 * Класс для создания ссылок
 */
class ul
{
	/**
	 * @param string $text текст ссылки
	 * @param string $icons иконка
	 * @param string $link ссылка
	 * @param int $select_user На какой сейчас ссылке сидит юзер
	 * @param int $nav_select ссылка в списке для выделения
	 * @param string $Theme_Dark текст ссылки для тёмной темы
	 * @param string $Theme_Light текст ссылки для белой темы
	 */

	public static function mobailBurger($text)
	{ ?>
		<li class="logo"> <!-- Логотип -->
			<div class="nav_burger"> <!-- Бургер -->
				<span></span> <!-- Линии бургера -->
				<span></span> <!-- Линии бургера -->
				<span></span> <!-- Линии бургера -->
			</div>
			<div class="div-img-logo"> <!-- Контейнер для логотипа -->
				<img class="img-logo" src="icons/logo.png"> <!-- Изображение логотипа -->
			</div>
			<div class="logo-text"> <!-- Текст логотипа -->
				<?= $text ?> <!-- Название сайта -->
			</div>
		</li>
	<?php }

	public static function li(
		$text,
		$icons,
		$link,
		$select_user,
		$nav_select
	) { ?>
		<li <?= ($nav_select == $select_user) ? "class='select'" : "" ?> onclick="window.location.href = '<?= $link ?>';">
			<a href="#"> <!-- Ссылка на страницу чисто ради css стилей здесь висит-->
				<div class="li-div-logo"><!-- Контейнер для иконки -->
					<img src="<?= $icons ?>" class="li-icon"><!-- Иконка -->
				</div>
				<div class="a-div">
					<?= $text ?> <!-- Текст ссылки -->
				</div>
			</a>
		</li><?php
			}

			public static function language()
			{
				if (!isset($_COOKIE['language']) || $_COOKIE['language'] != 'eng') { ?>
			<li onclick="document.cookie = 'language=eng; path=/'; location.reload();"> <!-- Кнопка смены языка -->
				<a href="">
					<div class="li-div-logo"><img src="icons/rus2.png" class="li-icon not-black"></div> <!-- Иконка -->
					<div class="a-div">Русский</div> <!-- Текст ссылки -->
				</a>
			</li>
		<?php
				} else { ?>
			<li onclick="document.cookie = 'language=ru; path=/'; location.reload();"><a href=""> <!-- Кнопка смены языка -->
					<div class="li-div-logo"><img src="icons/eng2.png" class="li-icon not-black"></div> <!-- Иконка -->
					<div class="a-div">English</div> <!-- Текст ссылки -->
				</a>
			</li><?php
				}
			}


			public static function DarkMode($Theme_Dark, $Theme_Light)
			{
				if (isset($_COOKIE['isDarkMode']) && $_COOKIE['isDarkMode'] == 'true') {
					?>
			<li onclick="document.cookie = 'isDarkMode=false; path=/'; location.reload();"><!-- Кнопка смены темы с тёмной на БЕЛУЮ -->
				<a href="">
					<div class="li-div-logo"><img src="icons/white.png" class="li-icon"></div> <!-- Иконка -->
					<div class="a-div"> <?= $Theme_Dark ?> </div> <!-- Текст ссылки -->
				</a>
			</li>
		<?php
				} else {
		?>
			<li onclick="document.cookie = 'isDarkMode=true; path=/'; location.reload();"> <!-- Кнопка смены темы с белой на ТЁМНУЮ -->
				<a href="">
					<div class="li-div-logo"><img src="icons/white.png" class="li-icon"></div> <!-- Иконка -->
					<div class="a-div"><?= $Theme_Light ?></div> <!-- Текст ссылки -->
				</a>
			</li>
		<?php
				}
			}


			public static function logOff($text)
			{ ?>
		<li onclick="document.cookie = 'login=;'; ;location.reload('/');"><a href="#"> <!-- Кнопка выхода -->
				<div class="li-div-logo"><img src="icons/exit3.png" class="li-icon not-black"></div> <!-- Иконка -->
				<div class="a-div"><?= $text ?></div> <!-- Текст ссылки -->
			</a></li><?php
					}
				}
						?>

<?php
##############################################################################################################
//Панель работника наркологии
##############################################################################################################
if ($user['Account-type'] == 0) {    ?> <!-- Если пользователь работник наркологии -->
	<nav class="lock"> <!-- Боковое меню -->
		<?php ul::mobailBurger($loc['AS']); ?>
		<ul> <!-- Список ссылок -->
			<?php
			ul::li($loc['Booking'], 'icons/truck7.png', '/', 1, $nav_select); // Ссылка на главную страницу Бронирования автомобилей
			ul::li($loc['Booked_trips'], 'icons/truck2.png', 'BookedTrips_worker_narcology.php', 2, $nav_select);  // Ссылка на страницу с поездками забронированными этим пользователем
			ul::li($loc['Новая заявка'], 'icons/New_application2.png', 'TopicForDiscussion__worker_narcology.php', 2.5, $nav_select);  // Ссылка на страницу с поездками забронированными этим пользователем
			ul::li($loc['Все заявки'], 'icons/All_new_application6.png', 'BookedTopic__worker_narcology.php', 2.7, $nav_select);  //Ссылка на страницу Всех заявок
			ul::li($loc['Edit_Profile'], 'icons/prof2.png', 'Edit Profile.php', 3, $nav_select);   // Ссылка на страницу редактирования профиля
			ul::language();
			ul::DarkMode($loc['Theme: Dark'], $loc['Theme: Light']);
			ul::logOff($loc['Exit']);
			?>
		</ul>
	</nav>
<?php

	##############################################################################################################
	//Начальник административно хозяйственного отдела
	##############################################################################################################
} else if ($user['Account-type'] == 1) {    ?> <!-- Если пользователь является начальником административно хозяйственного отдела -->
	<nav class="lock"> <!-- Боковое меню -->
		<?php ul::mobailBurger($loc['AS']); ?>
		<ul> <!-- Список ссылок -->
			<?php
			ul::li($loc['Новые заявки'], 'icons/truck7.png', '/', 1, $nav_select);  //Ссылка на страницу Новых заявок 
			ul::li($loc['Активные маршруты'], 'icons/truck2.png', 'active_routes__HeadOfFacilities.php', 2, $nav_select);   //Ссылка на страницу Активных маршрутов
			ul::li($loc['Все заявки'], 'icons/list3.png', 'all_Bookeds.php', 2.5, $nav_select);  //Ссылка на страницу Всех заявок			
			ul::li($loc['Edit_Profile'], 'icons/prof2.png', 'Edit Profile.php', 3, $nav_select);    //Ссылка на страницу редактирования профиля
			ul::language();
			ul::DarkMode($loc['Theme: Dark'], $loc['Theme: Light']);
			ul::logOff($loc['Exit']);
			?>
		</ul>
	</nav>
<?php

	##############################################################################################################
	//Работник административно хозяйственного отдела
	##############################################################################################################
} else if ($user['Account-type'] == 2) {    ?> <!-- Если пользователь - Работник административно хозяйственного отдела -->
	<nav class="lock"> <!-- Боковое меню -->
		<?php ul::mobailBurger($loc['AS']); ?>
		<ul>
			<?php
			ul::li($loc['Booking'], 'icons/truck7.png', '/', 1, $nav_select);  //Ссылка на страницу Бронирования автомобилей
			ul::li($loc['Booked_trips'], 'icons/list3.png', 'BookedTrips_worker_narcology.php', 2, $nav_select);   //Ссылка на страницу с поездками забронированными этим пользователем
			ul::li($loc['Активные маршруты'], 'icons/truck2.png', 'active_routes__HeadOfFacilities.php', 2.5, $nav_select);   //Ссылка на страницу Активных маршрутов
			ul::li($loc['Новые заявки'], 'icons/truck7.png', 'panel_HeadOfFacilities.php', 2.6, $nav_select);   //Ссылка на страницу Активных маршрутов			
			ul::li($loc['Все заявки'], 'icons/All_new_application6.png', 'BookedTopic__worker_narcology.php', 2.7, $nav_select);  //Ссылка на страницу Всех заявок
			ul::li($loc['Edit_Profile'], 'icons/prof2.png', 'Edit Profile.php', 3, $nav_select);    //Ссылка на страницу редактирования профиля
			ul::language();
			ul::DarkMode($loc['Theme: Dark'], $loc['Theme: Light']);
			ul::logOff($loc['Exit']);
			?>
		</ul>
	</nav>
<?php

	##############################################################################################################
	//Водитель
	##############################################################################################################
} else if ($user['Account-type'] == 3) {    ?>
	<nav class="lock">
		<?php ul::mobailBurger($loc['AS']); ?>
		<ul>
			<?php
			ul::li($loc['Активные маршруты'], 'icons/truck2.png', 'active_routes__HeadOfFacilities.php', 2.5, $nav_select); // Ссылка на страницу Активных маршрутов у водителя
			ul::li($loc['Edit_Profile'], 'icons/prof2.png', 'Edit Profile.php', 3, $nav_select); // Ссылка на страницу редактирования профиля
			ul::language();
			ul::DarkMode($loc['Theme: Dark'], $loc['Theme: Light']);
			ul::logOff($loc['Exit']);
			?>
		</ul>
	</nav>
<?php

	##############################################################################################################
	//Системный-администратор
	##############################################################################################################
} else if ($user['Account-type'] == 4) {    ?>
	<nav class="lock">
		<?php ul::mobailBurger($loc['AS']); ?>
		<ul>
			<?php
			ul::li($loc['Общие настройки'], 'icons/settings1.png', '/', 1, $nav_select);    //Ссылка на страницу общих настроек
			ul::li($loc['Управление пользователями'], 'icons/User_management1.png', 'manage_users.php', 2, $nav_select);    //Ссылка на страницу управления пользователями
			ul::li($loc['Управление автомобилями'], 'icons/Car_management4.png', 'cars_list.php', 2.2, $nav_select);   //Ссылка на страницу управления автомобилями
			//ul::li($loc['Управление водителями'], 'icons/Driver_management1.png', 'drivers_list.php', 2.3, $nav_select);  //Ссылка на страницу управления водителями
			ul::li($loc['Edit_Profile'], 'icons/prof2.png', 'Edit Profile.php', 3, $nav_select);    //Ссылка на страницу редактирования профиля
			ul::language();
			ul::DarkMode($loc['Theme: Dark'], $loc['Theme: Light']);
			ul::logOff($loc['Exit']);
			?>
		</ul>
	</nav>
<?php
} ?>
<script>
	//Скрипт для бургера
	$(document).ready(function() { //При загрузке страницы
		$('.nav_burger').click(function(event) { //При нажатии на бургер
			$('nav').toggleClass('lock');
			$('nav').toggleClass('active');
			$('nav ul').toggleClass('active');
			$('.nav_burger').toggleClass('active');
			$('body').toggleClass('lock');
		});
	});
	window.console.log("%cВнимание! Эта функция предназначена для разработчиков. Не вставляйте сюда никакой код, который вам дали другие люди. Это может привести к компрометации вашей учетной записи или другим негативным последствиям. Пожалуйста, не вставляйте здесь никакой код, если вы не являетесь администратором. ", "font-weight: bold; font-size: 14px;")
	console.log('%c ОСТАНОВИСЬ! ', 'background-color: #007bff; color: #fff; font-size: 16px; font-weight: bold; padding: 8px 12px; border-radius: 5px; border: 2px solid #000; margin: 10px 0;');
	console.log("%cНЕ ДЕЛАЙ ЭТОГО! ", "color: #007bff; font-size: 72px; -webkit-text-stroke: 1px black; padding: 10px;");
	console.warn("ВНИМАНИЕ! Если кто-то попросил вас скопировать/вставить что-то здесь, то с вероятностью 11/10 это мошенники.");
</script>