<?php
require_once(PATH . '/assets/medoo/medoo.php');
require_once(PATH . '/config.php');

/**
* Возвращает SEO параметры страницы
* 
* @param string $page - страница
* @return array
*/
function getSeoOptions($page='')
{
	switch ($page) 
	{
		case '':
			$result['title'] = 'Главная и единственная';
			$result['description'] = 'форма обратной связи';
			break;
		
		default:
			$result['title'] = '404';
			$result['description'] = '404';
			break;
	}
	return $result;
}

/**
* Запись данных с формы в БД
* 
* @param string $page - страница
* @param object $db - объект БД
* @return int
*/
function saveOrder(array $data, $db)
{
	if (empty($data))
		return false;

	if (!checkTime($data['order_time']))
		return 'time_error';

	$data = filter_var_array($data, FILTER_SANITIZE_STRING);

	$data['date'] = date('Y-m-d', strtotime($data['date']));
	$data['send_date'] = date('Y-m-d');

	if (!sendMail($data))
    	return 'mail_error';
	
	$data = synchronizeArrayToTable($data, "feedback", $db);
    $insert = $db->insert("feedback", $data);

    return $insert->rowCount();
}

/**
* Синхронизация ключей массива и полей таблицы
* 
* @param array $data - массив данных
* @param string $table - имя таблицы
* @param object $db - объект БД
* @return array
*/
function synchronizeArrayToTable(array $data, $table, Medoo\Medoo $db)
{
	$columns = getTableFields($table, $db);
	if (empty($columns)) return false;

	foreach ($data as $key => $value) 
		if (!in_array($key, $columns)) unset($data[$key]);

	foreach ($columns as $value) 
		if (!array_key_exists($value, $data)) $data[$value] = '';

	return $data;
}

// Получить все поля таблицы
/**
* Возвращает имена полей таблицы
* 
* @param string $table - имя таблицы
* @param object $db - объект БД
* @return array
*/
function getTableFields($table, Medoo\Medoo $db)
{
	$columns = array();
	$query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '" . $table . "'";
	$temp = $db->query($query)->fetchAll();

	foreach ($temp as $column)
		$columns[] = $column['COLUMN_NAME'];

    return $columns;
}

/**
* Отправляет письмо
* 
* @param array $data - массив данных для вставки в письмо
* @return bollean
*/
function sendMail(array $data)
{
	    $headers[]  = 'MIME-Version: 1.0' . "\r\n";
		$headers[] 	= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		$headers[] 	= 'From: bt@mail.com';

	    $to 		= 'managers@mail.com';
	    $subject 	= 'Заполнена форма обратой связи';

	    $message    = '<h1>Сообщение с сайта</h1><br>\r\n';
	    $message    .= '<b>Сообщение</b>: ' . $data['extra'] . ' <br>\r\n';
	    $message    .= '<b>ФИО</b>: ' . $data['FIO'] . ' <br>\r\n';
	    $message    .= '<b>Телефон</b>: ' . $data['phone'] . ' <br>\r\n';
	    $message    .= '<b>Дата</b>: ' . $data['date'] . ' <br>\r\n';
	    $message    .= '<b>Время</b>: ' . $data['order_time'] . ' <br>\r\n';

	    return mail($to, $subject, $message, implode("\r\n", $headers));
}

/**
* Проверяет диапазон времени
* 
* @param $time - время(H:m)
* @return bollean
*/
function checkTime($time)
{
	if (empty($time))
		return false;

	$temp = explode(':', $time);

	$hour 	= (int)$temp[0];
	$min 	= (int)$temp[1];

	if ( ($hour < 8) || ($hour > 20) )
		return false;
	elseif ( ($hour == 20) && ($min > 0) )
		return false;

	return true;
}


?>