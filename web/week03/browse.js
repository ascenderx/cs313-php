$(document).ready(() => {
    let $btnsItemInc = $('[ident="itemCountInc"]');
    let $btnsItemDec = $('[ident="itemCountDec"]');
    let $txtsItemCount = $('[ident="itemCount"]');
    
    $btnsItemInc.each((index) => {
        let $txt = $txtsItemCount.get(index);
        let $btn = $btnsItemInc.get(index);
        
        $btn.addEventListener('click', () => {
            let count = parseInt($txt.value);
            if (isNaN(count)) {
                count = 0;
            }
            $txt.value = ++count;
        });
    });
    
    $btnsItemDec.each((index) => {
        let $txt = $txtsItemCount.get(index);
        let $btn = $btnsItemDec.get(index);
        
        $btn.addEventListener('click', () => {
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