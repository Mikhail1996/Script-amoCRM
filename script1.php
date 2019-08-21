<?php

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Запрос сделок
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$subdomain = 'sokolproduction'; #Наш аккаунт - поддомен

/* Для начала нам необходимо инициализировать данные, необходимые для составления запроса. */
$link = 'https://' . $subdomain . '.amocrm.ru/api/v2/leads';

$date = new DateTime();
$date->modify('-1 month');

/* Нам необходимо инициировать запрос к серверу. Воспользуемся библиотекой cURL (поставляется в составе PHP). Подробнее о
работе с этой
библиотекой Вы можете прочитать в мануале. */
$curl = curl_init();
/* Устанавливаем необходимые опции для сеанса cURL */
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
/* Вы также можете передать дополнительный HTTP-заголовок IF-MODIFIED-SINCE, в котором указывается дата в формате D, d M Y
H:i:s. При
передаче этого заголовка будут возвращены сделки, изменённые позже этой даты. */
curl_setopt($curl, CURLOPT_HTTPHEADER, array('IF-MODIFIED-SINCE: ' . $date->format('r')));
/* Выполняем запрос к серверу. */
$out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
curl_close($curl);
/* Теперь мы можем обработать ответ, полученный от сервера. Это пример. Вы можете обработать данные своим способом. */
$code = (int) $code;
$errors = array(
    301 => 'Moved permanently',
    400 => 'Bad request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not found',
    500 => 'Internal server error',
    502 => 'Bad gateway',
    503 => 'Service unavailable',
);
try
{
    /* Если код ответа не равен 200 или 204 - возвращаем сообщение об ошибке */
    if ($code != 200 && $code != 204) {
        throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undescribed error', $code);
    }
} catch (Exception $E) {
    die('Ошибка: ' . $E->getMessage() . PHP_EOL . 'Код ошибки: ' . $E->getCode());
}
/*
Данные получаем в формате JSON, поэтому, для получения читаемых данных,
нам придётся перевести ответ в формат, понятный PHP
 */
$Response = json_decode($out, true);
$Response = $Response['_embedded']['items'];

print_r('<tr><td>Id сделки</td><td>Название сделки</td><td>Бюджет</td></tr>');

foreach ($Response as $v) {
    if (is_array($v)) {
        print_r('<tr><td>' . $v['id'] . '</td><td>' . $v['name'] . '</td><td>' . $v['sale'] . '</td></tr>');
    }
}

?>