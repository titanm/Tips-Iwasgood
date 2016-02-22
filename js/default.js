$(function() {
	$('form > div').mouseover(function() {
		$(this).find('.error').fadeOut();
	});
	$('.error').mouseover(function() {
		$(this).fadeOut();
	});
	$('.flashmsg').mouseover(function() {
		$(this).slideUp();
	});
	window.setTimeout(function() {
		$('.flashmsg').slideUp();
	}, 5000);
	$('#add-wish').click(function() {
		$(this).hide();
		$('#add-wish-form').slideDown();
	});
	$('input[type=file]').change(function() {
		$(this).closest('label').find('div').html($(this).val());
	});
});