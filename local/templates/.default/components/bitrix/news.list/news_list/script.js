$(function(){
	$('.desktopNews__list ul').on('click', 'li', function(){$(this).find('form').submit();})
});