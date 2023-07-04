(function ($) {
    $(document).ready(function ($) {
      $("#gateway_button").click(function (e) {
        e.preventDefault();
	
	//Выполняем запрос к backend"у сайта	  
        $.ajax({
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
          },
          success: function (results) {

          },
  
        });
      });
    });
  })(jQuery);
