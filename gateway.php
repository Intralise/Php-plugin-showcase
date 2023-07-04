<?php

//Здесь идёт описание вашего плагина для WordPress
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

//Здесь ваш js файл подключается к файлам проекта. Иначе WP не сможет исполнять js файл
function gateway_response_load()
{
  wp_enqueue_script('gateway_response', get_site_url(null, '', 'https') . '/wp-content/plugins/gateway/gateway_response.js?ver=' . time(), ['jquery'], time(), true);
}
//хук чтобы привязать новый файл скриптов
add_action('wp_enqueue_scripts', 'new_alpha_logic_response_load');


//Вебхуки для привязки php скрипта к фронтенду. После добавления этих хуков любой внешний скрипт может обратиться к вашему php коду
//Поэтому важно писать префиксы, выделяющие ваш код. В данном случае это paymtech. 
//Префиксы обеспечат вам что внешние плагины не смогут обратиться к этой функции
//Т.к. например метод check_order_status может содержаться в плагине онлайн магазина
//Если вы вместо вашего заказа вызовите метод вообще чужого плагина, это может полностью убить этот самый плагин
add_action('wp_ajax_nopriv_paymtech_check_order_status', 'paymtech_check_order_status');
add_action('wp_ajax_paymtech_check_order_status', 'paymtech_check_order_status');

//А здесь идёт описание логики самой функции
function paymtech_check_order_status( ) {

	//Если нам передали внешние данные, мы можем их записать следующим орбазом
	//$myText = $_POST['myText'];
	//внутренняя логика

	//Возвращаем данные на фронт
	//return 'Мой новый текст
}





