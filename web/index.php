<!DOCTYPE html>
<html lang="en-US">
    <head>
        <title>Jimmy Downer</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="./top.css" />
        <link rel="shortcut icon" type="image/png" href="./assets/images/php-512.png" />
        
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    </head>
    <body>
        <div class="u-side-bar-toggle" id="btToggleSideOn">
            &gt;
        </div>
        <div class="u-side-bar-toggle" id="btToggleSideOff">
            &lt;
        </div>
        <div class="u-side-bar">
            <div class="u-heading-3">Navigation</div>
            <hr class="dark-rule" />
        </div>
        <div class="u-container">
            <div class="u-header">
                <div class="u-heading-1 code">Jimmy Downer @ Heroku</div>
            </div>

            <!-- <div class="u-content">
                <a href="#">
                    <div class="u-button">Home</div>  
                </a>
            </div> -->

            <div class="u-content">
                <div class="u-heading-2">Your OS Info</div>
                <hr />
                <div class="code"><?php include "osinfo.php" ?></div>
            </div>
        </div>
        
        <script src="./top.js"></script>
    </body>
</html>
