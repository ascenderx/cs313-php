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
</style>
<div class="u-page-mask"></div>
<div class="u-dialog">
    <div class="u-dialog-header u-heading-2"></div>
    <hr />
    <div class="u-dialog-content"></div>
    <div class="u-button u-dialog-close">Close</div>
</div>
<script type="application/javascript">
    function showDialog(header, content) {
        $('.u-page-mask').css({
            'display': 'inherit',
        });
        $('.u-dialog').css({
            'display': 'inherit',
        });
        $('.u-dialog-header').text(header);
        $('.u-dialog-content').text(content);
    }

    $('.u-dialog-close').click(() => {
        $('.u-page-mask').css({
            'display': 'none',
        });
        $('.u-dialog').css({
            'display': 'none',
        });
        $('.u-dialog-header').text(null);
        $('.u-dialog-content').text(null);
    })
</script>