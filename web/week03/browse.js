$(document).ready(() => {
    let $btnsItemInc = $('[ident="itemCountInc"]');
    let $btnsItemDec = $('[ident="itemCountDec"]');
    let $txtsItemCount = $('[ident="itemCount"]');
    
    $btnsItemInc.each((index) => {
        let $txt = $txtsItemCount.get(index);
        
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