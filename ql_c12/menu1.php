<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Freetuts.net - Menu Dropdow Use CSS & JQUERY</title>
        
        <script language="javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        
        <style>
            /*VIẾT CSS TẠI ĐÂY*/
            ul li{ list-style-type: none;}
            a{ text-decoration: none;}
            ul a{ display: block; width: 125px; background: orange; border-bottom: 1px solid #ccc;  padding-left: 25px; line-height: 30px; color: white;}
            ul li .submenu{ display: none;}
            ul li.selected .submenu{ display: block;}
            .submenu ul{ margin: 0px; padding: 0px;}
            .submenu ul a{ background: blue;}
            .submenu ul a:hover{ background: silver;}
        </style>

        <script language="javascript">
            /*VIẾT JAVASCRIPT TẠI ĐÂY*/
            $(document).ready(function() {
                $("ul li a").click(function() 
                {
                    var li = $(this).parent();

                    // Kiểm tra có phải click vào menu đã active ko
                    // nếu phải thì ko làm gì, ngược lại sẽ xử lý xổ menu con ra
                    if (li.hasClass("selected")) {
                        return false;
                    } 
                    else {
                        // Xóa class selected khỏi các thẻ li khác
                        $('ul li').removeClass('selected');
                        // Thêm class selected vào thẻ li hiện tại
                        li.addClass("selected");
                    }
                    
                    // return false nghĩa là cho trang đứng im
                    return false; 

                });
            });
        </script>
    </head>

    <body>
        <ul>
            <li><a  href="#">Home</a>
                <div class="submenu">
                    <ul>
                        <li><a href="#">About US</a></li>
                        <li><a href="#">Sale Off</a></li>
                        <li><a href="#">News</a></li>
                    </ul>	
                </div>
            </li>
            <li><a  href="#">Promotion</a>
                <div class="submenu">
                    <ul>
                        <li><a href="#">Money</a></li>
                        <li><a href="#">Hot Deal</a></li>
                        <li><a href="#">Chewry Junior</a></li>
                    </ul>	
                </div>
            </li>
            <li><a  href="#">Product</a>
                <div class="submenu">
                    <ul>
                        <li><a href="#">Product Random</a></li>
                        <li><a href="#">New Product</a></li>
                        <li><a href="#">Febtured Product</a></li>
                    </ul>	
                </div>
            </li>
        </ul>
    </body>
</html>