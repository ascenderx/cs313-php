$(document).ready(() => {
    $('#btToggleSideOn').click(() => {
        $('.u-side-bar').css('visibility', 'visible');
        $('#btToggleSideOff').css('visibility', 'visible');
    });

    $('#btToggleSideOff').click(() => {
        $('.u-side-bar').css('visibility', 'hidden');
        $('#btToggleSideOff').css('visibility', 'hidden');
    });
});