$(document).ready(() => {
    let $btnsItemInc = $('#itemCountInc');
    let $btnsItemDec = $('#itemCountDec');
    let $txtsItemCount = $('#itemCount');
    
    $btnsItemInc.each((index) => {
        let $txt = $txtsItemCount.get(index);
        $txt.value = 0;
        
        $btnsItemInc.get(index).addEventListener('click', (event) => {
            let count = parseInt($txt.value);
            if (isNaN(count)) {
                count = 0;
            }
            $txt.value = ++count;
        });
    });
    
    $btnsItemDec.each((index) => {
        let $txt = $txtsItemCount.get(index);
        $txt.value = 0;
        
        $btnsItemDec.get(index).addEventListener('click', (event) => {
            let count = parseInt($txt.value);
            if (isNaN(count)) {
                count = 0;
            }
            if (count > 0) {
                $txt.value = --count;
            }
        }); 
    });
});