$(document).ready(() => {
    let $frmMain = $('#frm-main');
    let $txtAddrStreet = $('[name="addr-street"]');
    let $txtAddr2 = $('[name="addr-2"]');
    let $txtAddrCity = $('[name="addr-city"]');
    let $txtAddrState = $('[name="addr-state"]');
    let $txtAddrZip = $('[name="addr-zip"]');
    let $txtAddrCountry = $('[name="addr-country"]');
    let $btSubmit = $('#bt-submit');
    
    $txtAddrStreet.val(sessionStorage.getItem('addr-street') || '');
    $txtAddr2.val(sessionStorage.getItem('addr-2') || '');
    $txtAddrCity.val(sessionStorage.getItem('addr-city') || '');
    $txtAddrState.val(sessionStorage.getItem('addr-state') || '');
    $txtAddrZip.val(sessionStorage.getItem('addr-zip') || '');
    $txtAddrCountry.val(sessionStorage.getItem('addr-country') || '');
    
    function frmMainChange() {
        $txtAddrStreet.val($txtAddrStreet.val().trim());
        $txtAddr2.val($txtAddr2.val().trim());
        $txtAddrCity.val($txtAddrCity.val().trim());
        $txtAddrState.val($txtAddrState.val().trim());
        $txtAddrZip.val($txtAddrZip.val().trim());
        $txtAddrCountry.val($txtAddrCountry.val().trim());
        
        sessionStorage.setItem('addr-street', $txtAddrStreet.val());
        sessionStorage.setItem('addr-2', $txtAddr2.val());
        sessionStorage.setItem('addr-city', $txtAddrCity.val());
        sessionStorage.setItem('addr-state', $txtAddrState.val());
        sessionStorage.setItem('addr-zip', $txtAddrZip.val());
        sessionStorage.setItem('addr-country', $txtAddrCountry.val());
        
        // TODO: replace with regex
        let chk1 = $txtAddrStreet.val().length > 0;
        //let chk2 = $txtAddr2.val().length > 0;
        let chk3 = $txtAddrCity.val().length > 0;
        let chk4 = $txtAddrState.val().length > 0;
        let chk5 = $txtAddrZip.val().length > 0;
        //let chk6 = $txtAddrCountry.val().length > 0;
        
        // TODO: Fix CSS to replace these .css() calls
        if (chk1 && chk3 && chk4 && chk5) {
            $btSubmit.attr('disabled', false);
            
            $btSubmit.css('color', '#fff');
            $btSubmit.css('background-color', '#07a');
            $btSubmit.css('box-shadow', '0 5px #059');
        } else {
            $btSubmit.attr('disabled', true);
            
            $btSubmit.css('color', '#000');
            $btSubmit.css('background-color', '#aaa');
            $btSubmit.css('box-shadow', '0 5px #777');
        }
    }
    
    frmMainChange();
    $('#frm-main').change(frmMainChange);
});