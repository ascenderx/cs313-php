function viewAssign(id) {
    let form = document.forms.namedItem(`form-${id}`);
    let data = new FormData(form);
    ajaxGet('view-assign.php', data)
    .then((text) => {
        // let obj = JSON.parse(text);
        console.log("Success: 200");
        console.log(text);
    })
    .catch((status, text) => {
        console.log(`Error: ${status} | ${text}`);
    });
}