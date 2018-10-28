/**
 * CONVERT TO SENTENCE CASE
 */
function toSentenceCase(text) {
    text = text.toString();
    let textNew = text.charAt(0).toUpperCase();
    for (let c = 1; c < text.length; c++) {
        textNew += text[c];
    }
    return textNew;
}

/**
 * IS VALUE SET
 */
function isSet(val) {
    return (val !== undefined && val !== null);
}

/**
 * VIEW ASSIGNMENT
 */
function viewAssign(id) {
    let form = document.forms.namedItem(`form-${id}`);
    let data = new FormData(form);
    let dataObj = { 'force-if-empty': true };
    for (let datum of data) {
        let key = datum[0];
        let value = datum[1];
        dataObj[key] = value;
    }

    $.ajax({
        url: './modules/view-tasks.php',
        method: 'get',
        data: dataObj,
        statusCode: {
            200: function(data) {
                let obj = JSON.parse(data);
                let table = generateTaskTable(id, obj);
                initDialog(table);
                showDialog(`Tasks for Assignment #${id}`, table);
            },
            204: function() {
                showNoTasks(id);
            },
            404: function() {
                console.log('Page not found');  
            },
            406: function() {
                initDialog();
                showDialog('Error', 'Invalid request');
            }
        }
    });
}

/**
 * SHOW ASSUMING NO TASKS FOUND
 */
function showNoTasks(id) {
    $.ajax({
        url: './modules/get-tasks-columns.php',
        method: 'get',
        statusCode: {
            200: function(data) {
                let cols = JSON.parse(data);
                let table = generateTaskTable(id, cols, true);
                initDialog(table);
                showDialog(`Tasks for Assignment #${id}`, table);
            },
            404: function() {
                console.log('Page not found');  
            },
            406: function() {
                initDialog();
                showDialog('Error', 'Invalid request');
            }
        }
    });
}

/**
 * UPDATE TASK
 */
function updateTask(assignID, row, column, value) {
    $.ajax({
        url: './modules/update-task.php',
        method: 'post',
        data: {
            'task-id': row,
            'column': column,
            'value': value
        },
        statusCode: {
            200: function(xhr) {
                console.log('Update success');
                console.log(xhr.responseText);
                viewAssign(assignID);
            },
            404: function() {
                console.log('Page not found');  
            },
            406: function(xhr) {
                console.log('Invalid request');
                console.log(xhr.responseText);
            },
            409: function(xhr) {
                console.log('Update conflict');
                console.log(xhr.responseText);
            }
        }
    });
}

/**
 * ADD TASK
 */
function addTask(assignID, values) {
    $.ajax({
        url: './modules/add-task.php',
        method: 'post',
        data: values,
        statusCode: {
            200: function(xhr) {
                console.log('Update success');
                console.log(xhr.responseText);
                viewAssign(assignID);
            },
            404: function() {
                console.log('Page not found');  
            },
            406: function(xhr) {
                console.log('Invalid request');
                console.log(xhr.responseText);
            },
            409: function(xhr) {
                console.log('Update conflict');
                console.log(xhr.responseText);
            }
        }
    });
}

/**
 * DELETE TASK
 */
function deleteTask(taskId, assignID) {
    let answer = confirm(`Are you sure you want to delete task #${taskId}?`);
    if (!answer) {
        return;
    }

    $.ajax({
        url: './modules/delete-task.php',
        method: 'post',
        data: {
            'task-id': taskId
        },
        statusCode: {
            200: function(xhr) {
                console.log('Update success');
                console.log(xhr.responseText);
                // refresh the dialog
                viewAssign(assignID);
            },
            404: function() {
                console.log('Page not found');
            },
            406: function(xhr) {
                console.log('Invalid request');
                console.log(xhr.responseText);
            },
            409: function(xhr) {
                console.log('Update conflict');
                console.log(xhr.responseText);
            }
        }
    });
}

/**
 * GENERATE TASK TABLE
 */
function generateTaskTable(assignID, data, assumeEmpty) {
    let div = document.createElement('div');
    let br = document.createElement('br');
    let table = document.createElement('table');
    div.appendChild(br);
    div.appendChild(table);
    
    table.className = 'u-dialog-table';
    table.style.borderCollapse = 'collapse';

    // create table header
    let theader = table.createTHead();
    let rowh = theader.insertRow();

    $btDialogNew = $('.u-dialog-new');
    $btDialogAdd = $('.u-dialog-add');
    $btDialogCancel = $('.u-dialog-cancel');
    
    // click listener for the "New" button
    $btDialogNew[0].onclick = () => {
        $btDialogNew.css('display', 'none');
        $btDialogAdd.css('display', 'initial');
        $btDialogCancel.css('display', 'initial');
        
        let row = table.insertRow();
        row.insertCell();
        let cellsH = table.tHead.rows[0].cells;
        for (let c = 1; c < cellsH.length - 2; c++) {
            let col = cellsH[c].innerText.toLowerCase();
            let cell = row.insertCell();
            let input = document.createElement('input');
            input.id = col;
            input.name = 'data-add';
            input.style.width = '90%';
            cell.appendChild(input);
        }
        let cellAssign = row.insertCell();
        cellAssign.innerText = assignID;
        row.insertCell();
    };

    // click listener for the "Apply"/"Add" button
    $btDialogAdd[0].onclick = () => {
        let inputs = document.getElementsByName('data-add');
        let obj = {'assign-id': assignID};
        for (let input of inputs) {
            let col = input.id;
            let value = input.value;
            obj[col] = value;
        }

        addTask(assignID, obj);
    };

    // click listener for the "Cancel" button
    $btDialogCancel[0].onclick = () => {
        viewAssign(assignID);
    };

    // if assuming the desired data was empty, then we'll
    // treat the "data" object as a row of columns and
    // return a different table
    if (assumeEmpty) {
        // insert a header for each column
        data.forEach((col) => {
            let cell = document.createElement('th');
            cell.innerText = toSentenceCase(col);
            rowh.appendChild(cell);
        });

        // insert a blank header for the "delete" row
        let dellCellH = document.createElement('th');
        rowh.append(dellCellH);

        return table;
    }

    // insert a header for each column
    for (let key in data[0]) {
        let cell = document.createElement('th');
        cell.innerText = toSentenceCase(key);
        rowh.appendChild(cell);
    }

    // insert a blank header for the "delete" row
    let dellCellH = document.createElement('th');
    rowh.append(dellCellH);

    // create table body
    data.forEach((datum) => {
        let row = table.insertRow();
        let col = 0;
        let rowID = datum['id'];

        // add each field
        for (let key in datum) {
            let value = datum[key];
            let cell = row.insertCell();
            let title = rowh.cells[col].innerText.toLowerCase();
            let label = document.createElement('label');
            if (title != 'id' && title != 'assignment') {
                $(label).dblclick(() => {
                    editCell(assignID, rowID, key, cell);
                });
            }
            if (!isSet(value)) {
                value = 'null';
            } else {
                value = ('' + value).trim();
            }
            label.innerText = (value) ? value : 'null';
            cell.appendChild(label);
            col++;
        }

        // add a delete button
        let delCell = row.insertCell();
        let btDel = document.createElement('div');
        btDel.className = 'u-button';
        btDel.innerText = 'Delete';
        $(btDel).click(() => {
            deleteTask(rowID, assignID);
        });
        delCell.appendChild(btDel);
    });

    return table;
}

/**
 * EDIT CELL
 */
function editCell(assignID, rowID, columnName, cell) {
    let text = cell.children[0].innerText;
    let input = document.createElement('input');
    if (!text || text.toLowerCase() == 'null') {
        text = '';
    } else {
        input.value = text;
    }
    cell.children[0].style.display = 'none';
    cell.appendChild(input);

    $(input).focus();
    $(input).blur(() => {
        updateCell(assignID, rowID, columnName, cell);
    });
}

/**
 * UPDATE CELL
 */
function updateCell(assignID, rowID, columnName, cell) {
    let input = cell.children[1];
    let text = input.value.trim();
    cell.removeChild(input);
    let label = cell.children[0];
    label.style.display = 'initial';
    updateTask(assignID, rowID, columnName, text);
}

/**
 * INITIALIZE DIALOG
 */
function initDialog(table) {
    let $btDialogNew = $('.u-dialog-new');
    let $btDialogAdd = $('.u-dialog-add');
    let $btDialogCancel = $('.u-dialog-cancel');

    $btDialogNew.css('display', 'initial');
    $btDialogAdd.css('display', 'none');
    $btDialogCancel.css('display', 'none');
}