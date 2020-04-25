@extends('layouts.portal')

@section('content')
<div class="main">
        <div><img alt="" src="img/sunhoo-adv-2.png"></div>
        <table width="100%" style="margin-left:20px;">
            <tbody>
                <tr><td colspan="5" style=" height : 30px; font-size :16px; color:#00b816;">官网类</td></tr>
                <tr>
                    <td><a href="http://www.sun-hoo.cn/" target="_blank">集团官网中文版</a></td>

                </tr>
            </tbody>
        </table>
        
        <div class="hx"></div>

        <table width="100%" style="margin-left:20px;">
            <tbody>
                <tr><td colspan="5" style="height : 30px; font-size :16px; color:#00b816;">商城类</td></tr>
                <tr>
                    <td><a href="https://sunhoo.tmall.com/" target="_blank">官方旗舰店（天猫）</a></td>
                    <td><a href="https://mall.jd.com/index-138065.html" target="_blank">官方旗舰店（京东）</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
        <div class="hx"></div>
            
            <table width="100%" style="margin-left:20px;">
            <tbody>
                <tr><td colspan="5" style="height:30px; font-size :16px; color:#00b816;">订单类</td></tr>
                <tr>
                    <td><a href="http://www.sun-hoo.cn:6677/sunhooshop2/" target="_blank">门店前台订单系统</a></td>
                    <td><a href="http://192.168.100.59/sunhoo2/" target="_blank">门店管理系统-后台(内)</a></td>
                    <td><a href="http://192.168.100.51:4900/" target="_blank">整装后台管理-测试(内)</a></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><a href="http://192.168.100.59/sunhooshop2/" target="_blank">门店前台订单系统(内)</a></td>
                    <td><a href="http://192.168.100.59:8080/" target="_blank">门店管理系统(内)</a></td>
                    <td><a href="http://192.168.100.146:4900/" target="_blank">整装后台管理(内)</a></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        
        <div class="hx"></div>
        
        <table width="100%" style="margin-left:20px;">
            <tbody>
                <tr><td colspan="5" style="height : 30px; font-size :16px; color:#00b816;">办公类</td></tr>
                <tr>
                    
                    <td><a href="http://www.sun-hoo.cn:3333/" target="_blank">协同办公(OA)</a></td>
                    <td><a href="http:///www.sun-hoo.cn:8484/" target="_blank">人资管理(eHR)</a></td>
                    <td><a href="http://192.168.100.119:9000" target="_blank">双虎电子阅览室(内)</a></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><a href="http://192.168.100.31/" target="_blank">协同办公(OA)(内)</a></td>
                    <td><a href="http://192.168.100.84/" target="_blank">人资管理(eHR)(内)</a></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <div class="hx"></div>
        
        <table width="100%" style="margin-left:20px;">
            <tbody>
                <tr><td colspan="5" style="height : 30px; font-size :16px; color:#00b816;">其他类</td></tr>
                <tr>
                    <td><a href="http://192.168.100.124/" target="_blank">图纸查看系统(内)</a></td>
                    <td><a id="u92" href="http://www.sun-hoo.cn:8097/" target="_blank">用友U9系统</a></td>
                    <td><a href="#" id="app1" data-toggle="popover" data-placement="top" data-original-title="" title="">双虎集团公众号</a></td>
                    <td><a href="http://192.168.100.210:9002/minio" target="_blank">Minio Browser</a></td>
                    <td><a href="http://192.168.100.119:8000/dashboard" target="_blank">Dashboard</a></td>
                </tr>
                <tr>
                    <td><a href="http://www.sun-hoo.cn:6688" target="_blank">营销管理系统</a></td>
                    <td><a id="u91" href="http://192.168.100.75/" target="_blank">用友U9系统(内)</a></td>
                    <td><a href="#" id="app2" data-toggle="popover" data-placement="top" data-original-title="" title="">双虎集团微博</a></td>
                    <td><a href="http://192.168.100.119:8888/" target="_blank">Jupyter Notebook</a></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
</div>

<script type="text/javascript">
    $('#app1').popover({
        trigger: 'hover', //鼠标以上时触发弹出提示框
        html: true, //开启html 为true的话，data-content里就能放html代码了
        content: "<img src='img/qr-wx.jpg' alt='双虎集团公众号' style='width:100px;height:100px;' />"
    });

    $('#app2').popover({
        trigger: 'hover',
        html: true,
        content: "<img src='img/qr-sina.jpg' alt='双虎集团微博' style='width:100px;height:100px;' />"

    });
    $('#u91').popover({
        trigger: 'hover',
        html: true,
        content: "请使用IE浏览器打开"

    });
    $('#u92').popover({
        trigger: 'hover',
        html: true,
        content: "请使用IE浏览器打开"

    });
</script>

@endsection