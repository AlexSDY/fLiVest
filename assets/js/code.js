jQuery('#enterForm').on('shown.bs.modal', function () {
	var myDatepicker = jQuery('#enterForm #date').datepicker().data('datepicker');
	var disabledDays = [0, 6];
	jQuery('#date').datepicker({
    	onRenderCell: function (date, cellType) {
        if (cellType == 'day') {
            var day = date.getDay(),
                isDisabled = disabledDays.indexOf(day) != -1;

            return {
                disabled: isDisabled
            }
        }
    },
    onSelect: function(formattedDate, date, inst) {
		myDatepicker.hide();
    },
    	minDate: new Date()
	});

	jQuery("#phone").mask("8(000) 000-0000", {clearIfNotMatch: true});
	jQuery("#time").mask("99:99");
	jQuery("#p_time").mask("99:99");
});


jQuery(document).on("click", "#check152",
	function()
	{
		var elem 	= jQuery(this);
		var button 	= jQuery("#enterForm .save_order");

		if (!elem.prop("checked"))
			button.attr('disabled', 'disabled');
		else
			button.removeAttr('disabled');
	});

jQuery(document).on("click", ".form_clear",
	function()
	{
		var elem 	= jQuery(this);
		var form 	= elem.closest("form");

		form.trigger('reset');
	});


jQuery(document).on("click", "#enterForm .save_order", 
	function()
	{
		var form = jQuery("#enterForm form");

		jQuery.ajax({
		  url: "/functions/ajax.php",
		  method: "POST",
		  data: form.serialize(),
		  dataType: 'json'
		})
		.done(function(data) {
			var info_class 	= 'alert alert-danger';

			if (data === false)
				var message = "Заполните, пожалуйста, поля анкеты";
			else if (data == 'time_error')
			{
				var message = "Диапазон времени от 8:00 до 20:00";
				jQuery("#enterForm #time").val('');
			}
			else if ( (data == 'mail_error') || (data == 0) )
			{
				var message = "Данные не были корректно сохранены.<br>" +
					"Пожалуйста, повторите попытку или свяжитесь с нами по телефону.";
			}
			else if (data == 1)
			{
				var message = "Спасибо. Ваша заявка успешно принята.";
				info_class  = 'alert alert-success';
			}

			jQuery("#enterForm #info")
				.html(message)
				.removeAttr('class')
				.addClass(info_class)
				.slideDown();
		});
	});
