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
    $('.dropdown-menu a.dropdown-toggle').on('click', function(e) {
        var $menu = $(this);
        if (!$menu.next().hasClass('show')) {
            $menu.parents('.dropdown-menu').first().find('.show').removeClass('show');
        }
        $menu.next(".dropdown-menu").toggleClass('show');
        $menu.parents('li.nav-item.dropdown.show').one('hidden.bs.dropdown', function(e) {
            $('.dropdown-submenu .show').removeClass("show");
        });
        return false;
    });
})(window.jQuery);