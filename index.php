<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
        <link rel="apple-touch-icon" href="apple-touch-icon.png">
        <!-- Place favicon.ico in the root directory -->

        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <div class="switch">
            <a class="action" href="#">&#9776;</a>
            <ul class="inner">
                <?php 
                $dash = array('_','-');
                $dir    = 'img';
                $files = array_values(array_diff(scandir($dir), array('..', '.')));
                foreach ($files as $key ) {
                    echo '<li><a href="img/'.$key.'" class="item">'.str_replace($dash, ' ', substr($key, 0, strpos($key, "."))).'</a></li>';
                }
                ?>
            </ul>
        </div>
        <img id="content" src="img/<?php echo $files[0]; ?>" alt="">
    </body>
    <script>
    jQuery(document).ready(function($) {
        function getUrlVars() {
            var vars = {};
            var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
            vars[key] = value;
            });
        return vars;
        }

        $('.action').click(function (e) {
            e.preventDefault();
            $('.switch').toggleClass('open');
        });

        $('.item').click(function (e) {
            e.preventDefault();
            url = $(this).attr('href');
            $('#content').attr('src', url);
            if(history.pushState) {
                history.pushState(null, null, '?i='+url); // URL is now /inbox/N
              }
        });


        var sent = getUrlVars()["i"];
        if (typeof sent != 'undefined') { // sent exists
           $('#content').attr('src', sent);
        }

    });
    </script>
</html>
