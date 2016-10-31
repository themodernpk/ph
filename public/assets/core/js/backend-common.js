(function ($) {
    $("body").on("click", ".slide-panel", function (e) {
        e.preventDefault();
        $(this).slidePanel('show');
    });
    //-----------------------------------------------------------
    $("body").on("click", ".slide-panel-close", function (e) {
        e.preventDefault();
        $(this).slidePanel('hide');
    });
    //-----------------------------------------------------------
    $(document).on('slidePanel::afterLoad', function (e) {
        var $el = $('.slidePanel-inner');
        var scrollTop = $(this).scrollTop();
        var scrollBot = scrollTop + $(this).height();
        var elTop = $el.offset().top;
        var elBottom = elTop + $el.outerHeight();
        var visibleTop = elTop < scrollTop ? scrollTop : elTop;
        var visibleBottom = elBottom > scrollBot ? scrollBot : elBottom;
        var height = visibleBottom - visibleTop - 50;
        $(".scrollable").css("height", height);
        $('.scrollable').asScrollable({
            contentSelector: ">",
            containerSelector: ">"
        });
    });
    //-----------------------------------------------------------
    alertify.logPosition("bottom right");
    //-----------------------------------------------------------
    //-----------------------------------------------------------
})(jQuery);// end of jquery



