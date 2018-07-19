$(document).ready(function() {
    $('.active').removeClass('active');
    $('#comida').addClass('active');
    $('#comida').parents('.droplink').addClass('open');
    $('#comida').parents('.sub-menu').css('display', 'block');
    date();
});

function date() {
    $('.date-picker').datepicker({
        orientation: "top auto",
        autoclose: true,
        daysOfWeekDisabled: "0,6"
    });
}
