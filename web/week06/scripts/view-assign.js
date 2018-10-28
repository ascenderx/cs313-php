function toSentenceCase(text) {
    text = text.toString();
    let textNew = text.charAt(0).toUpperCase();
    for (let c = 1; c < text.length; c++) {
        textNew += text[c];
    }
    return textNew;
}

function isSet(val) {
    return (val !== undefined && val !== null);
}

function viewAssign(id) {
    let form = document.forms.namedItem(`form-${id}`);
    let data = new FormData(form);
    let dataObj = {};
    for (let datum of data) {
        let key = datum[0];
        let value = datum[1];
        dataObj[key] = value;
    }

    $.ajax({
        url: 'view-tasks.php',
        method: 'get',
        data: dataObj,
        statusCode: {
            200: function(data) {
                let obj = JSON.parse(data);
                
                let table = generateTaskTable(obj);
                initDialog(table);
                showDialog(`Tasks for Assignment #${id}`, table);
            },
            204: function() {
                initDialog();
                showDialog(`Tasks for Assignment #${id}`, 'No records found');
            },
            406: function() {
                initDialog();
                showDialog('Error', 'Invalid request');
            }
        }
    });
}

function generateTaskTable(data) {
    let table = document.createElement('table');
    table.className = 'u-dialog-table';

    // create table header
    let theader = table.createTHead();
    let rowh = theader.insertRow();
    for (let key in data[0]) {
        // let cell = rowh.insertCell();
        let cell = document.createElement('th');
        cell.innerText = toSentenceCase(key);
        rowh.appendChild(cell);
    }

    // create table body
    data.forEach((datum) => {
        let row = table.insertRow();
        for (let key in datum) {
            let value = datum[key];
            let cell = row.insertCell();
            cell.innerText = (isSet(value)) ? toSentenceCase(value) : 'null';
        }
    });

    table.style.borderCollapse = 'collapse';

    return table;
}

function initDialog(table) {
    let $btDialogDone = $('.u-dialog-done');
    let $btDialogEdit = $('.u-dialog-edit');
    let $btDialogNew = $('.u-dialog-new');

    $btDialogDone.css('display', 'none');
    $btDialogEdit.css('display', 'initial');
    $btDialogNew.css('display', 'none');

    $btDialogEdit.click(() => {
        $btDialogEdit.css('display', 'none');
        $btDialogDone.css('display', 'initial');
        $btDialogNew.css('display', 'initial');

        let header = table.rows[0];
        for (let r = 1; r < table.rows.length; r++) {
            let row = table.rows[r];
            for (let c = 0; c < row.cells.length; c++) {
                let cell = row.cells[c];
                let title = header.cells[c].innerText.toLowerCase();
                if (title != 'id' && title != 'assignment') {
                    let text = cell.innerText;
                    let input = document.createElement('input');
                    input.style.width = '90%';
                    input.value = text;
                    cell.innerHTML = '';
                    cell.appendChild(input);
                }
            }
        }
    });

    $btDialogDone.click(() => {

    });
}