$(document).ready(() => {
    let $blkRed = $('#blkRed');
    let $blkBlue = $('#blkBlue');
    
    let colorDefault = $blkRed.css('background-color');
    let textDefault = $blkRed.text();
    let blueVisible = true;
    
    $('#btClickMe').click(() => {
       alert('Clicked!');
    });
    
    $('#btChangeColor').click(() => {
        let $blkRed = $('#blkRed');
        let color = $('#txtColor').val().trim();
       
        if (color.length == 0) {
            $blkRed.css('background-color', colorDefault);
            $blkRed.text(textDefault);
        } else {
            $blkRed.css('background-color', color);
            $blkRed.text(color);
        }
    });
    
    $('#txtColor').change(() => {
        let $this = $('#txtColor');
        $this.val($this.val().trim());
    });
    
    $('#btToggleVisible').click(() => {
        blueVisible = !blueVisible;
        if (blueVisible) {
            $('#blkBlue').fadeIn();
        } else {
            $('#blkBlue').fadeOut();
        }
    });
});
