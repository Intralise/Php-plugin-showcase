<?php


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


function new_alpha_logic_response_load()
{
  wp_enqueue_script('gateway_response', get_site_url(null, '', 'https') . '/wp-content/plugins/gateway/gateway_response.js?ver=' . time(), ['jquery'], time(), true);
}


add_action('wp_enqueue_scripts', 'new_alpha_logic_response_load');


add_action('wp_ajax_nopriv_paymtech_process_payments', 'paymtech_process_payments');
add_action('wp_ajax_paymtech_process_payments', 'paymtech_process_payments');


function paymtech_process_payments( ) {




    $data = array(
        'amount' => 1
    );
    
	//$url = 'http://project:alpha_achievers@api.box:5001/orders/create';
    /*
    $headers  = array(
        'Authorization' => 'Basic ' . base64_encode( 'alpha_achievers' . 'eNr4+WvR1BXqqrm0'),
        'Host' => 'api.box:5001',
		 'Content-Type' => 'application/json',
    );*/
	
	 $url = 'https://sandboxapi.paymtech.kz/orders/create';
	
	$headers = array(
    'Authorization: Basic ' . base64_encode('alpha_achievers:eNr4+WvR1BXqqrm0'),
    'Host: sandboxapi.paymtech.kz',
    'Content-Type: application/json',
    );

    LogTXT('*****', '****');
    LogTXT('*****', '****');
    LogTXT('*****', '****');
    LogTXT('*****', '****');
    LogTXT('*****', '****');
    LogTXT('Headers', $headers);

	$certificate =  "/var/www/u2037853/data/www/longacademy.ru/wp-content/plugins/gateway/alpha.cer";
	$certPassword = 'ux8bnyOtAO/N'; // Пароль для сертификата

    //Проверка на читабельность файла
    $pem=realpath("/var/www/u2037853/data/www/longacademy.ru/wp-content/plugins/gateway/alpha_achievers.pem");
    if(!$pem || !is_readable($pem)){
        LogTXT("error: myfile.pem is not readable! ", "qwe");
    }
    else { LogTXT("SUCCESS", "qwe");}

	$ch = curl_init();
	
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);

	LogTXT('FILE', '/var/www/u2037853/data/www/longacademy.ru/wp-content/plugins/gateway/lpha_achievers.pem' . ' ' . $certPassword);
    LogTXT('FILE', __DIR__ . '/alpha_achievers.pem' . ' ' . $certPassword);


    curl_setopt($ch, CURLOPT_SSLCERT, __DIR__ . '/alpha_achievers.pem');
    curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPassword);

    curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 2);

    $result = curl_exec($ch);
    $error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

	
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        LogTXT('Ошибка ', $error);
    }
    else { 	LogTXT('Без ошибки ', $result); }

    $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $header = substr($result, 0, $headerSize);

    curl_close($ch);
    $response = json_decode($result, true);
    $error = json_decode($error, true);
    $http_code = json_decode($http_code, true);



    LogTXT('Заголовки ', $header);

    $locationHeader = '';
    if (preg_match('/Location: (.+)/', $header, $matches)) {
        $locationHeader = $matches[1];
    }
    
    $convertedString = stripslashes($locationHeader);

    header('Location: ' . $convertedString);


    LogTXT('Location ', $locationHeader);


    LogTXT('HTTP CODE ', $http_code);
	
	LogTXT('Raw Response ', $result);


}


add_action('wp_ajax_nopriv_paymtech_check_order_status', 'paymtech_check_order_status');
add_action('wp_ajax_paymtech_check_order_status', 'paymtech_check_order_status');


function paymtech_check_order_status( ) {

	if (is_user_logged_in()) {
		$user_id = get_current_user_id();

		$orderId = $_POST['orderId'];

        $url = 'https://sandboxapi.paymtech.kz/orders/' . $orderId;
	

        $headers = array(
        'Authorization: Basic ' . base64_encode('alpha_achievers:eNr4+WvR1BXqqrm0'),
        'Host: sandboxapi.paymtech.kz',
        'Content-Type: application/json',
        );
    
        $certPassword = 'ux8bnyOtAO/N'; // Пароль для сертификата
  
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        curl_setopt($ch, CURLOPT_SSLCERT, "/var/www/u2037853/data/www/longacademy.ru/wp-content/plugins/gateway/alpha_achievers.pem");
        curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $certPassword);
    
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, 2);
    
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    

    
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $header = substr($result, 0, $headerSize);
    
        curl_close($ch);
        $response = json_decode($result, true);
        $error = json_decode($error, true);
        $http_code = json_decode($http_code, true);
    
    
        $locationHeader = '';
        if (preg_match('/Status: (.+)/', $header, $matches)) {
            $locationHeader = $matches[1];
        }
        
        $convertedString = stripslashes($locationHeader);

        $regex = '/"status":"([^"]+)"/';
        $status_id=0;
        if (preg_match($regex, $result, $matches)) {
            $status_id = $matches[1];

        } else {

        }


        LogTXT('Status: ' , $status_id);
    
        LogTXT('HTTP CODE ', $http_code);
	
        LogTXT('Raw Response ', $result);

    }
}



















function LogTXT($message, $data)
{
	//111
    file_put_contents(__DIR__ . '/log14.txt', $message . PHP_EOL, FILE_APPEND);
	$log = date('Y-m-d H:i:s') . ' ' . json_encode($data);
	file_put_contents(__DIR__ . '/log14.txt', $log . PHP_EOL, FILE_APPEND);
}



