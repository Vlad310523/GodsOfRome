$(document).ready(function() {
	$('.login').click(function(event) {
		$('.form-register').addClass('disable');
		$('.form-login').removeClass('disable');
	});
	$('.register').click(function(event) {
		$('.form-login').addClass('disable');
		$('.form-register').removeClass('disable');
	});
	$('.img_sort').click(function() {
		$('.img_sort').addClass('img_sort_reverse');
		$('.img_sort').removeClass('img_sort');
	});
	$('.img_sort_reverse').click(function() {
		$('.img_sort_reverse').addClass('img_sort');
		$('.img_sort_reverse').removeClass('img_sort_reverse');
	});
	$('#closewindow').click(function() {
		$('.dialog').addClass('none');
	});
	$('#closesellwindow').click(function() {
		$('.dialog_sell').addClass('none');
	});
	$('.openwindow').click(function() {
		$('.dialog').removeClass('none');
	});
	$('#closewindowbuy').click(function() {
		$('.dialog_buy').addClass('none');
	});
	$('#closewindowstorage').click(function() {
		$('.dialog_storage').addClass('none');
	});
	$('#closewindowtrader').click(function() {
		$('.dialog_trader').addClass('none');
	});
	$('#closewindowtree').click(function() {
		$('.dialog_tree').addClass('none');
	});
	$('.island_house').click(function() {
		$('.dialog_storage').removeClass('none');
	});
	$('.island_trader').click(function() {
		$('.dialog_trader').removeClass('none');
	});
	$('#closewindowsellfruits').click(function() {
		$('.dialog').addClass('none');
	});
});