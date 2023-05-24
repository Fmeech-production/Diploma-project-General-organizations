<?php
function table_admin2($SQL_zapros, $mysql)
{
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
		<?php

		$userS = $mysql->query($SQL_zapros);  // Запрос на получение заявок
		$количествоПользователей = mysqli_num_rows($userS);  // Получение количества заявок
		$schetchick = 1;    // Счетчик для отображения номера заявки
		$user = $userS->fetch_assoc();  // Получение первой заявки
		?>




































		<div class="block1">
			<!-- Вставьте ваш код для компактного режима здесь -->
			<input type="text" id="search" placeholder="Что ищете?" aria-controls="users-table">
			<style>
				#search {
					width: calc(100% - 20px - 22px);
					margin-left: 10px;
					margin-bottom: 5px;
					padding: 10px;
					font-size: 16px;
					border: 1px solid #ccc;
					border-radius: 4px;
					background-color: #fff;
					outline: none;
					transition: all 0.3s ease;
				}

				#search:focus {
					box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
					border-color: #999;
				}

				#search::placeholder {
					color: #999;
				}
			</style>








			<?php

			while ($user != null) {   // Цикл для отображения всех пользователей
				switch ($user['Account-type']) {
					case 0:
						$account_type = "Сотрудник наркологии";
						break;
					case 1:
						$account_type = "Начальник отдела хозяйственной части";
						break;
					case 2:
						$account_type = "Сотрудник отдела хозяйственной части";
						break;
					case 3:
						$account_type = "Водитель";
						break;
					case 4:
						$account_type = "Системный-администратор";
						break;
					default:
						$account_type = "Неизвестный тип аккаунта";
				}
			?>
				<div class="user-info" data-fullname="<?= $user['id'] . " " . $user['Login']. " "  . $user['SName'] . " " . $user['Name'] . " " . $user['PName'] . " " . $account_type . " " . $user['Email'] . " " . $user['Phone'] ?>">
					<div class="zaivka  <?php if ($количествоПользователей == $schetchick) echo "zaivka-edit"; ?>" onclick="window.location.href = 'user_details.php?id=<?= $user['id'] ?>';"> <!-- Карточка юзера -->
						<div class="zaivka-status-div-img avatar-user">
							<img class="zaivka-status-img avatar-user-img" src="<?= get_avatar($user) ?>">
						</div>
						<div class="text-user">
							<div class="zaivka-top"> <!-- Верхняя часть карточки -->
								<!--ФИО юзера -->
								<span class="mini-circle"></span>
								<div class="zaivka-time"> <?= $user['SName'] . " " . $user['Name'] . " " . $user['PName'] ?> </div>
							</div>
							<div class="zaivka-status">

								<span class="black-circle
						<?php
						switch ($user['Account-type']) {
							case 0:
								echo "black-circle-0";
								break;
							case 1:
								echo "black-circle-1";
								break;
							case 2:
								echo "black-circle-2";
								break;
							case 3:
								echo "black-circle-3";
								break;
							case 4:
								echo "black-circle-4";
								break;
							default:
								echo "black-circle-0";
						}
						?>
						"></span> <!-- Круг с цветом статуса -->

								<div class='<?php
											switch ($user['Account-type']) {
												case 0:
													echo "account-type-0'>Сотрудник наркологии";
													break;
												case 1:
													echo "account-type-1'>Начальник отдела хозяйственной части";
													break;
												case 2:
													echo "account-type-2'>Сотрудник отдела хозяйственной части";
													break;
												case 3:
													echo "account-type-3'>Водитель";
													break;
												case 4:
													echo "account-type-4'>Системный-администратор";
													break;
												default:
													echo "'>Неизвестный тип аккаунта";
											}
											?>
							</div>
						</div> <!-- Текст статуса -->
					</div>
				</div>
				</div>
			<?php
				$schetchick++;  // Увеличение счетчика
				$user = $userS->fetch_assoc();  // Получение следующей заявки
			}
			?>



		</div>





		<script>
    $(document).ready(function () {
        $(' #search').on('keyup', function () { let searchTerm=$(this).val().toLowerCase(); $('.user-info').each(function () { let fullname=$(this).data('fullname').toLowerCase(); if (fullname.includes(searchTerm)) { $(this).show(); } else { $(this).hide(); } }); }); }); </script>





























									<div class="block2 hidden">
										<!-- Ваш код таблицы существующего расширенного режима -->
										<!-- Создайте таблицу для отображения списка пользователей -->
										<table id="users-table" class="display">
											<thead>
												<tr>
													<th class="id-column">ID</th>
													<th>Аватар</th>
													<th>Логин</th>
													<th>Имя</th>
													<th>Фамилия</th>
													<th>Отчество</th>
													<th>Почта</th>
													<th>Телефон</th>
													<th>Тип аккаунта</th>
													<th>Действия</th>
												</tr>
											</thead>
											<tbody>
												<?php

												// Выполните запрос на получение списка пользователей
												$result = mysqli_query($mysql, $SQL_zapros);

												// Выведите результат в виде таблицы
												while ($row = mysqli_fetch_assoc($result)) {
													echo "<tr>";
													echo "<td class='id-column'>" . $row['id'] . "</td>";
													echo "<td>
						
						<div class='zaivka-status-div-img avatar-user-block2'>
						<img class='zaivka-status-img avatar-user-img' src=" . get_avatar($row) . ">
					</div>

						
						</td>";
													echo "<td>" . $row['Login'] . "</td>";
													echo "<td>" . $row['Name'] . "</td>";
													echo "<td>" . $row['SName'] . "</td>";
													echo "<td>" . $row['PName'] . "</td>";
													echo "<td>" . $row['Email'] . "</td>";
													echo "<td>" . $row['Phone'] . "</td>";
													echo "<td class='";
													switch ($row['Account-type']) {
														case 0:
															echo "account-type-0'>Сотрудник наркологии";
															break;
														case 1:
															echo "account-type-1'>Начальник отдела хозяйственной части";
															break;
														case 2:
															echo "account-type-2'>Сотрудник отдела хозяйственной части";
															break;
														case 3:
															echo "account-type-3'>Водитель";
															break;
														case 4:
															echo "account-type-4'>Системный-администратор";
															break;
														default:
															echo "'>Неизвестный тип аккаунта";
													}
													echo "</td>";

													echo '<td class="id-column"  style="display: flex;">';
												?>
													<button class="edit-user" onclick="window.location.href = 'user_details.php?id=<?= $row['id'] ?>'">
														<div>
															<img src="icons/edit3.png" alt="Редактировать" title="Редактировать" class="cover">
														</div>
													</button>
													<?php
													echo '<button class="delete-user">';
													?>
													<div>
														<img src="icons/Basket3.png" alt="Удалить" title="Удалить" class="cover">
													</div>
												<?php
													echo '</button></td>';
													echo "</tr>";
												}
												?>
											</tbody>
										</table>



									</div>





































									<script>
										// Инициализация DataTables с русским языком
										$(document).ready(function() {
											$("#users-table").DataTable({
												language: {
													url: "ImportedLibraries/datatables/datatables-ru.json",
												},
												columns: [{
														width: "16px"
													}, // Фиксированная ширина столбца ID
													{
														width: "60px"
													}, // Фиксированная ширина столбца аватара
													null, // Остальные столбцы будут автоматически подстраиваться
													null,
													null,
													null,
													null,
													null,
													null,
													{
														width: "120px"
													},
												],
												autoWidth: false, // Отключить автоматическое изменение ширины столбцов
											});
										});
									</script>
									<style>
										td {
											text-align: left;
										}
									</style>
									<style>
										table {
											table-layout: fixed;
											width: 100%;
										}

										table th,
										table td {
											word-wrap: break-word;
											overflow-wrap: break-word;
											white-space: normal;
										}

										.id-column {
											text-align: center;
											justify-content: center;
										}

										.avatar-user-block2 {
											width: 100%;
											height: 50px;
											align-items: center;
											background-color: transparent;
											background-color: rgba(0, 0, 0, 0)
										}
										.dataTables_length{
											margin-left: 15px;
										}
										#users-table_filter{
											margin-right: 27px;
										}
										.dataTables_info{
											margin-left: 15px;
										}										
									</style>

	</main>
	<style>
		.black-circle {
			margin-left: 7.5px;
		}

		.text-user {
			width: calc(100% - 50px);
		}

		.avatar-user {
			width: 50px;
			height: 50px;
			margin-top: 2px;
		}

		.avatar-user-img {
			width: 50px;
			height: 50px;
			object-fit: cover;
			border-radius: 50%;
		}


	</style>
<?php }
