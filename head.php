<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-PJH7VBG');</script>
    <!-- End Google Tag Manager -->

    <style type="text/css">
        .js #fouc {display: none;}
    </style>
    <script type="text/javascript">
        document.documentElement.className = 'js';
        console.log("Adding .js class to html element");
    </script>

    <title><?php wp_title(''); ?></title>
    <?php
    wp_head();
    global $current_user;
    ?>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0 maximum-scale=1.0">
    <!--<script src="https://use.typekit.net/dsz5fve.js"></script>-->
    <script>try{Typekit.load({ async: true });}catch(e){}</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <!--<link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">-->
    <!--<link href="https://fonts.googleapis.com/css2?family=Arimo:wght@500;600&family=Merriweather:wght@300;400;700;900&display=swap" rel="stylesheet">-->
    <!-- Font: Playfair Display -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <!-- Font: Work Sans -->
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:ital@0;1&display=swap" rel="stylesheet">
    <!-- Font: Tinos (equivalent to Georgia) -->
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">

    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo(get_template_directory_uri())?>/favicon/apple-touch-icon.png">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta name="copyright" content="">
    <meta name="google-site-verification" content="DMhoe3uKxPI_ZseNUmb43TFD3cPqyNnCCGxJUIx1rAw" />

    <!-- <link rel="stylesheet" href="<?php echo(get_template_directory_uri())?>/stylesheet/css-reset-min.css"> -->
    <!-- <link rel="stylesheet" href="<?php echo(get_template_directory_uri())?>/stylesheet/style23.css"> -->
    <link rel="stylesheet" href="<?php echo(get_template_directory_uri())?>/css/trb.css">


    <?php $title = the_title('','',false);
    if ($title == "Contact" || $title == "Newsletter"): ?>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC3kjwSNbYXMctpJ1Blu78VEsXLEnLNyDA&extension=.js"></script>
        <script src='<?php echo(get_template_directory_uri())?>/js/maps.js'></script>-->
    <?php endif; ?>
</head>