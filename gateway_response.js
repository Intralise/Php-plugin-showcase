(function ($) {
    $(document).ready(function ($) {
      $("#gateway_button").click(function (e) {
        e.preventDefault();
  
		  console.log('test')
		  
        $.ajax({
          url: "/wp-admin/admin-ajax.php",
          type: 'POST',
          cache: false,
          headers: {
            "Cache-Control": "no-cache, no-store, must-revalidate",
            Pragma: "no-cache",
            Expires: "0",
          },
          data: {
            action: 'paymtech_process_payments',
          },
          success: function (results) {

          },
  
        });
      });
    });
  })(jQuery);

  (function ($) {
    $(document).ready(function ($) {
      $("#order_id_check_button").click(function (e) {
        e.preventDefault();
        orderId=78428319430488138;
		  console.log('test2');
      console.log(orderId);
		  
      $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        cache: false,
        headers: {
          "Cache-Control": "no-cache, no-store, must-revalidate",
          Pragma: "no-cache",
          Expires: "0",
        },
        data: {
          action: 'paymtech_check_order_status',
          orderId: orderId,
        },
        success: function (results) {

        },

      });

      });
    });
  })(jQuery);
  
  (function ($) {
  document.addEventListener("DOMContentLoaded", function() {
    var urlParams = new URLSearchParams(window.location.search);
    var orderId = urlParams.get("order_id");
    console.log("Заказ с идентификатором", orderId, "присутствует в URL");

    

    if (orderId) {
      // Выполнить определенные действия, связанные с orderid
      console.log("Заказ с идентификатором", orderId, "присутствует в URL");

      $.ajax({
        url: "/wp-admin/admin-ajax.php",
        type: 'POST',
        cache: false,
        headers: {
          "Cache-Control": "no-cache, no-store, must-revalidate",
          Pragma: "no-cache",
          Expires: "0",
        },
        data: {
          action: 'paymtech_check_order_status',
          orderId: orderId,
        },
        success: function (results) {

        },

      });
    


    }
  });
})(jQuery);