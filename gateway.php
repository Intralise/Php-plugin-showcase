<?php

//*******//
//Здесь у нас важные комментарии для плагина
/**
 * Plugin Name: paymtech Payment for Woocommerce
 * Plugin URI: 
 * Author Name: Andrei
 * Author URI: 
 * Description: This plugin allows for local content payment systems.
 * Version: 0.1.0
 * License: 0.1.0
 * License URL: 
 * text-domain: paymtech-pay-woo
*/ 

//*******//
//Здесь мы подключаем файл gateway_response.js
function new_alpha_logic_response_load()
{
  wp_enqueue_script('gateway_response', get_site_url(null, '', 'https') . '/wp-content/plugins/gateway/gateway_response.js?ver=' . time(), ['jquery'], time(), true);
}


add_action('wp_enqueue_scripts', 'new_alpha_logic_response_load');
//*******//

//Здесь мы говорим php что его могут вызвать из js кода
//Фактически после add_action внешние js файлы напрямую могут обратиться к бэку
//Поэтому важно добавлять префиксы к названию метода, чтобы php код не обратился к ф-ции check_order_status другого плагина
//paymtech здесь это название платёжной системы, у вас будет другой префикс
add_action('wp_ajax_nopriv_paymtech_check_order_status', 'paymtech_check_order_status');
add_action('wp_ajax_paymtech_check_order_status', 'paymtech_check_order_status');

function paymtech_check_order_status( ) {

	//тут внутри что-то происходит
	//Если с frontend'a передали какую-либо переменную, то её можно извлечь следующим образом
	//$myText = $_POST['myText'];

	//Допустим мы хотим вернуть текст, тогда используем следующий код
	//return 'Я изменил ваш текст'
}






