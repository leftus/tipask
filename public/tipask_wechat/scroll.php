<!DOCTYPE=html>  
<html>  
<head>  
<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
  
   <script type="text/javascript">  
    $(document).ready(function(){  
        var range = 50;             //距下边界长度/单位px  
        var elemt = 500;           //插入元素高度/单位px  
        var maxnum = 20;            //设置加载最多次数  
        var num = 1;  
        var totalheight = 0;   
        var main = $("#content");                     //主体元素  
        $(window).scroll(function(){  
            var srollPos = $(window).scrollTop();    //滚动条距顶部距离(页面超出窗口的高度)  
              
            //console.log("滚动条到顶部的垂直高度: "+$(document).scrollTop());  
            //console.log("页面的文档高度 ："+$(document).height());  
            //console.log('浏览器的高度：'+$(window).height());  
              
            totalheight = parseFloat($(window).height()) + parseFloat(srollPos);  
            if(($(document).height()-range) <= totalheight ) {  
                main.append("<div style='border:1px solid tomato;margin-top:20px;color:#ac"+(num%20)+(num%20)+";height:"+elemt+"' >hello world"+srollPos+"---"+num+"</div>");  
                num++;  
            }  
        });  
    });  
    </script>  
</head>  
<body>  
    <div id="content" style="height:960px">  
        <div id="follow">this is a scroll test;<br/>    页面下拉自动加载内容</div>  
        <div style='border:1px solid tomato;margin-top:20px;color:#ac1;height:800' >hello world test DIV</div>  
          
    </div>  
</body>  
</html>