<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Module Core</title>

        <!--common css-->
        <link rel="stylesheet" href="{{assetsCoreGlobal()}}/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{assetsCoreGlobal()}}/css/bootstrap-extend.min.css">
        <link rel="stylesheet" href="{{assetsCoreMmenu()}}/css/site.min.css">
        <link rel="stylesheet" href="{{assetsCoreGlobalVendor()}}/animsition/animsition.css">
        <link rel="stylesheet" href="{{assetsCoreGlobalVendor()}}/asscrollable/asScrollable.css">
        <link rel="stylesheet" href="{{assetsCoreGlobalVendor()}}/switchery/switchery.css">
        <link rel="stylesheet" href="{{assetsCoreGlobalVendor()}}/slidepanel/slidePanel.css">
        <link rel="stylesheet" href="{{assetsCoreGlobalVendor()}}/flag-icon-css/flag-icon.css">
        <!--/common css-->

        <!--[if lt IE 9]>
        <script src="{{assetsCoreGlobalVendor()}}/html5shiv/html5shiv.min.js"></script>
        <![endif]-->
        <!--[if lt IE 10]>
        <script src="{{assetsCoreGlobalVendor()}}/media-match/media.match.min.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/respond/respond.min.js"></script>
        <![endif]-->

        <script src="{{assetsCoreGlobalVendor()}}/modernizr/modernizr.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/breakpoints/breakpoints.js"></script>
        <script>
            Breakpoints();
        </script>

    </head>
    <body>


        @yield('content')



        <!--common js-->
        <!--Core and plugin dependencies-->
        <script src="{{assetsCoreGlobalVendor()}}/jquery/jquery.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/bootstrap/bootstrap.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/animsition/animsition.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/asscroll/jquery-asScroll.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/mousewheel/jquery.mousewheel.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/asscrollable/jquery.asScrollable.all.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/ashoverscroll/jquery-asHoverScroll.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/switchery/switchery.min.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/screenfull/screenfull.js"></script>
        <script src="{{assetsCoreGlobalVendor()}}/slidepanel/jquery-slidePanel.js"></script>


        <!--Template relating scripts-->
        <script src="{{assetsCoreGlobal()}}/js/core.js"></script>
        <script src="{{assetsCoreMmenu()}}/js/site.js"></script>
        <script src="{{assetsCoreMmenu()}}/js/sections/menu.js"></script>
        <script src="{{assetsCoreMmenu()}}/js/sections/menubar.js"></script>
        <script src="{{assetsCoreMmenu()}}/js/sections/gridmenu.js"></script>
        <script src="{{assetsCoreMmenu()}}/js/sections/sidebar.js"></script>

        <!--Template config scripts-->
        <script src="{{assetsCoreGlobal()}}/js/configs/config-colors.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/asscrollable.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/animsition.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/slidepanel.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/switchery.js"></script>


        <!--Template config scripts-->
        <script src="{{assetsCoreGlobal()}}/js/configs/config-colors.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/asscrollable.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/animsition.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/slidepanel.js"></script>
        <script src="{{assetsCoreGlobal()}}/js/components/switchery.js"></script>

        <!--Template initialise script-->
        <script>
            (function(document, window, $) {
                'use strict';
                var Site = window.Site;
                $(document).ready(function() {
                    Site.run();
                });
            })(document, window, jQuery);
        </script>

        <!--/common js-->

    </body>
</html>
