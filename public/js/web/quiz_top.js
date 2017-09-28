$('.index').css('z-index', '999');
$('.playerDecide').css('z-index', '-1');

$('.start').on('click', function() {
    $('.index').css('z-index', '-1');
    $('.playerDecide').css('z-index', '999');
});