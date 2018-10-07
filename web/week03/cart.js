$(document).ready(() => {
    let $divsItem = $('[ident="itemDiv"]');
    let $btnsItemRemove = $('[ident="itemRemove"]');
    let $txtsItemCount = $('[ident="itemCount"]');
    
    $btnsItemRemove.each((index) => {
        let $txt = $txtsItemCount.get(index);
        let $div = $divsItem.get(index);
        let $btn = $btnsItemRemove.get(index);
        
        $btn.addEventListener('click', () => {
            let answer = confirm('Are you sure you want to remove this item?');
            if (!answer) {
                return;
            }
            console.log('clicked');
            $txt.value = 0;
            $div.style.display = 'none';
        });
    });
});