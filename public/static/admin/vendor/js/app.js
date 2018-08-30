$(function () {
    var pagestyle = function () {
        var iframe = $("#workspace");
        var h = $(window).height() - iframe.offset().top;
        var w = $(window).width() - iframe.offset().left;
        if (h < 300) h = 300;
        if (w < 960) w = 960;
        iframe.height(h);
        iframe.width(w);
    };
    pagestyle();
    $(window).resize(pagestyle);

    var menu = $('#app-first-sidebar-nav-ul li');
    var menubox = $('#app-second-sidebar');
    var submenu = $('#app-second-sidebar .sub-nav');
    var container = $('#app-container');
    menu.click(function () {
        layer.load(2);

        $(this).addClass('active').siblings().removeClass('active');

        var current = $(this).index();
        if (current == 0) {
            menubox.hide();
            container.css('margin-left', '90px');
        } else {
            menubox.show();
            container.css('margin-left', '200px');
        }
        pagestyle();

        submenu.eq(current - 1).show().siblings().hide();

        var first = submenu.eq(current - 1).find('a').first();
        $('#workspace').attr('src', first.attr('href'));
    });

    var nav = $('#app-second-sidebar nav ul li');
    nav.click(function () {
        layer.load(2);

        $(this).addClass('active').siblings().removeClass('active');
    });

    $('#workspace').load(function () {
        layer.closeAll('loading');
    });
});