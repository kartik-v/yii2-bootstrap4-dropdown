/*!
 * @package   yii2-bootstrap4-dropdown
 * @author    Kartik Visweswaran <kartikv2@gmail.com>
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2015 - 2018
 * @version   1.0.0
 *
 * Bootstrap 4 Dropdown Nested Submenu Script
 * 
 * For more JQuery plugins visit http://plugins.krajee.com
 * For more Yii related demos visit http://demos.krajee.com
 **/
(function ($) {
    $('.dropdown-menu a.dropdown-toggle').on('click', function (e) {
        var $el = $(this), $parent = $el.offsetParent(".dropdown-menu"), $subMenu;
        if (!$el.next().hasClass('show')) {
            $el.parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        $subMenu = $el.next(".dropdown-menu"); 
        $subMenu.toggleClass('show');
        $subMenu.closest('.dropdown').toggleClass('is-expanded');
        $el.parent("li.nav-item").toggleClass('show');
        $el.parents('li.nav-item.dropdown.show').one('hidden.bs.dropdown', function (e) {
            $('.dropdown-menu .show').removeClass("show");
        });
        $el.next().css({ "top": $el[0].offsetTop, "left": $parent.outerWidth() - 4});
        return false;
    });
})(window.jQuery);