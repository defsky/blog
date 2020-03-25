<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=GBK">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script src="js/Calendar.js" type="text/javascript"></script>
    <script type="text/javascript">
        function onloadDate() {
        document.getElementById("SimpleDate").innerHTML =GetSimpleDate() + " " + GetWeekDay(); ;
    }
    </script>
</head>
<body onload="onloadDate()">
<div class="header">
    <div>
        <table>
            <tbody><tr>
                <td><img alt="成都市双虎实业有限公司" src="img/logo-2.png"></td>
                <td align="right"><span id="SimpleDate" style="color: #808080;"></span></td>
            </tr>
        </tbody></table>
    </div>
</div>

@yield('content')

<div class="footer">
    Copyright &#169; 2020 sun-hoo.cn(双虎集团系统公共平台) All Rights Reserved. <!--a target="_blank" href="http://www.miitbeian.gov.cn/">蜀ICP备11072976号-15</a-->
</div>
</body>
</html>