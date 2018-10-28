<style>
    .u-page-mask {
        background-color: rgba(0, 0, 0, 0.5);
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        display: none;
    }

    .u-dialog {
        position: fixed;
        top: 20%;
        right: 25%;
        left: 25%;
        padding: 10px;
        background-color: #def;
        box-shadow: 0 5px #58c;
        border-radius: 5px;
        word-wrap: break-word;
        display: none;
    }

    .u-dialog-table {
        border-collapse: collapse;
        width: 100%;
    }

    .u-dialog-table th, .u-dialog-table td {
        padding: 5px;
    }

    .u-dialog-table td {
        border: 1px solid #000;
    }

    .u-dialog-table th {
        font-weight: bold;
        border-bottom: 2px solid #000;
    }
</style>
<script type="application/javascript">
    function showDialog(header, content) {
        $('.u-page-mask').css({
            'display': 'inherit',
        });
        $('.u-dialog').css({
            'display': 'inherit',
        });
        $('.u-dialog-header').text(header);
        $('.u-dialog-content').html(content);

        $('.u-dialog-close').click(hideDialog);
        $('.u-page-mask').click(hideDialog);
    }

    function hideDialog() {
        $('.u-page-mask').css({
            'display': 'none',
        });
        $('.u-dialog').css({
            'display': 'none',
        });
        $('.u-dialog-header').text(null);
        $('.u-dialog-content').text(null);
    }
</script>