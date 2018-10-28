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
    let rowNum = 0;
    data.forEach((datum) => {
        let row = table.insertRow();
        let col = 0;
        for (let key in datum) {
            let value = datum[key];
            let cell = row.insertCell();
            let title = rowh.cells[col].innerText.toLowerCase();
            let label = document.createElement('label');
            if (title != 'id' && title != 'assignment') {
                $(label).dblclick(() => {
                    editCell(rowNum, key, cell);
                });
            }
            label.innerText = (isSet(value)) ? value : 'null';
            cell.appendChild(label);
            col++;
        }
        rowNum++;
    });

    table.style.borderCollapse = 'collapse';

    return table;
}

function editCell(rowNum, columnName, cell) {
    let text = cell.children[0].innerText;
    let input = document.createElement('input');
    input.style.width = '90%';
    if (!text || text.toLowerCase() == 'null') {
        text = '';
    } else {
        input.value = text;
    }
    // cell.removeChild(cell.childNodes[0]);
    cell.children[0].style.display = 'none';
    cell.appendChild(input);

    $(input).focus();
    $(input).blur(() => {
        updateCell(rowNum, columnName, cell);
    });
}

function updateCell(rowNum, columnName, cell) {
    let input = cell.children[1];
    let text = input.value;
    cell.removeChild(input);
    let label = cell.children[0];
    label.style.display = 'initial';
    label.innerText = text;
}

function initDialog(table) {
    let $btDialogDone = $('.u-dialog-done');
    let $btDialogEdit = $('.u-dialog-edit');
    let $btDialogNew = $('.u-dialog-new');

    $btDialogDone.css('display', 'none');
    $btDialogEdit.css('display', 'initial');
    $btDialogNew.css('display', 'none');
}