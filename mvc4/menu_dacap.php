<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<style>
.xt-ct-menu {
        position: relative;
        display: inline-block;
		background-color: #4CAF50;
		margin-left:550px;

    }

    .xtlab-ctmenu-item {
        background-color: #4CAF50;
        color: white;
        padding: 14px;
        font-size: 20px;
        border: none;
        cursor: pointer;
    }
    .xtlab-ctmenu-item:hover, .xtlab-ctmenu-item:focus {
        background-color: #9c3328;
    }

    .xtlab-ctmenu-sub {
        display: none;
        position: absolute;
        background-color: #3e8e41;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    }
    .xtlab-ctmenu-sub a {
        color: white;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }
    .xtlab-ctmenu-sub a:hover {
        background-color: orange;
        border: none;

    }
</style>
<script language="javascript" src="http://code.jquery.com/jquery-3.0.0.min.js"></script>
<script language="javascript">
jQuery.fn.extend({
    setMenu:function () {
        return this.each(function() {
            var containermenu = $(this);

            var itemmenu = containermenu.find('.xtlab-ctmenu-item');
            itemmenu.click(function () {
                var submenuitem = containermenu.find('.xtlab-ctmenu-sub');
                submenuitem.slideToggle(500);

            });

            $(document).click(function (e) {
                if (!containermenu.is(e.target) &&
                    containermenu.has(e.target).length === 0) {
                     var isopened =
                        containermenu.find('.xtlab-ctmenu-sub').css("display");

                     if (isopened == 'block') {
                         containermenu.find('.xtlab-ctmenu-sub').slideToggle(500);
                     }
                }
            });



        });
    },

});

$('.xt-ct-menu').setMenu();
</script>
<div class="menu2 xt-ct-menu">
    <div class="xtlab-ctmenu-item">Quản lý đơn vị</div>
    <div class="xtlab-ctmenu-sub">
        <a href="#">Link 1</a>
        <a href="#">Link 2</a>
        <a href="#">Link 3</a>
    </div>
</div>
