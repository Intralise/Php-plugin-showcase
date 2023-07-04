(function ($) {
    $(document).ready(function ($) {
      $("#gateway_button").click(function (e) {
        e.preventDefault();
	
	//Выполняем запрос к backend"у сайта
	//Важно чтобы у вас уже был готовый backend php код
        $.ajax({
	  //обязательные настройки 
          url: "/wp-admin/admin-ajax.php",
          type: 'POST',
          cache: false,
          headers: {
            "Cache-Control": "no-cache, no-store, must-revalidate",
            Pragma: "no-cache",
            Expires: "0",
          },
	 //конкретно здесь мы говорим что обращаемся к такой-то функции в backend"е
          data: { 
            action: 'paymtech_process_payments',
	    //здесь же можно передать какие-либо значения
            //Например предположим что выше мы создали переменную myText, тогда передать её в backend можно следующим образом
	    //orderId: orderId,
          },
          success: function (results) {
		//Код который сработает в случае успешного запроса. Может вывести данные на страницу и что угодно ещё
          },
  
        });
      });
    });
  })(jQuery);
