<?php
/*
Plugin Name: no-wp-admin
Plugin URI: https://github.com/julieeeeeee/no-wp-admin/
Description: A simple theme for wp-admin that uses your logo and color schemes instead of WordPress
Version: 1.0.0
Author: Julie Kim
Author URI: https://github.com/julieeeeeee/
License: GPLv2 or later
Text Domain: no-wp-admin
*/

// change default wordpress email address
function wpb_sender_email($original_email_address) {
	return get_option('admin_email');
}
function wpb_sender_name($original_email_from) {
	return get_option('blogname');
}
add_filter('wp_mail_from','wpb_sender_email');
add_filter('wp_mail_from_name','wpb_sender_name');

// disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

// replace howdy
function goodbye_howdy ($wp_admin_bar) {
	$avatar = get_avatar(get_current_user_id(),16);
	if (!$wp_admin_bar->get_node('my-account')) return;
	$wp_admin_bar->add_node(array(
		'id' => 'my-account',
		'title' => sprintf(wp_get_current_user()->display_name) . $avatar
    ));
}
add_action('admin_bar_menu','goodbye_howdy');

// convert hexdec color string to rgba
function hex2rgba($color, $opacity = false) {
	$default = 'rgb(0,0,0)';
	if(empty($color)) return $default;
	if ($color[0] == '#' ) {$color = substr( $color, 1 );}
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }
        $rgb =  array_map('hexdec', $hex);
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }
        return $output;
}

// adds custom css for wp-admin
add_action('admin_head','add_custom_css_for_admin');
function add_custom_css_for_admin () {

$check_jkwhmhh_color_1 = get_option('jkwhmhh_color_1');
if (empty($check_jkwhmhh_color_1)) { $jkwhmhh_color_1 = '#0005FF'; $secondary_color = '#0050ff'; }
else { $jkwhmhh_color_1 = get_option('jkwhmhh_color_1'); $secondary_color = hex2rgba($jkwhmhh_color_1,0.7); }

$check_jkwhmhh_color_2 = get_option('jkwhmhh_color_2');
if (empty($check_jkwhmhh_color_2)) {
	$jkwhmhh_color_2_pre = '#3f444c';
	$jkwhmhh_color_2 = hex2rgba($jkwhmhh_color_2_pre,0.85);
}
else {
	$jkwhmhh_color_2_pre = get_option('jkwhmhh_color_2');
	$jkwhmhh_color_2 = hex2rgba($jkwhmhh_color_2_pre,0.85); 
}
echo '
<meta name="msapplication-TileColor" content="' . $jkwhmhh_color_1 . '">
<meta name="theme-color" content="' . $jkwhmhh_color_1 . '">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css">
<style>
.wpt-form-textarea {
	height: 130px;
}
#wp-content-editor-tools {
    background-color: #f7f8fa;
}
.wp-core-ui .button-primary.active, .wp-core-ui .button-primary.active:focus, .wp-core-ui .button-primary.active:hover, .wp-core-ui .button-primary:active {
    background: ' . $jkwhmhh_color_1 . ';
    border-color: transparent;
    box-shadow: inset 0 2px 0 ' . $jkwhmhh_color_1 . ';
}
.notice-info {
    border-left-color: ' . $jkwhmhh_color_1 . ';
}
.theme-browser .theme.active .theme-name {
    background: ' . $jkwhmhh_color_2_pre . '; box-shadow: none;
}
.theme-browser .theme.active .theme-actions {
    background: ' . $jkwhmhh_color_2 . ';
}
.filter-count .count, .title-count {
    background: ' . $jkwhmhh_color_2 . ';
}
.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary:focus {
    box-shadow: 0 1px 0 rgba(0, 0, 0, 0.04), 0 0 2px 1px rgba(0, 0, 0, 0.2);
}
.tablenav {
	height: 0;
}
.login-action-register #login {
	padding: 5% 1% 5% 1%;
}
#welcome-panel, #wp-version-message, #dashboard_primary, label[for=dashboard_primary-hide], label[for=wp_welcome_panel-hide] {
    display: none!important;
}
#minor-publishing-actions .button {
	color: #fff;
	background-color: ' . $secondary_color . ';
	border-color: ' . $secondary_color . ';
	-webkit-box-shadow: 0 1px 0 #ccc;
	box-shadow: 0 1px 0 #ccc;
	vertical-align: top;
}
#minor-publishing-actions .button:hover {
	background: ' . $jkwhmhh_color_1 . ';
	border-color: ' . $jkwhmhh_color_1 . ';
}
.view-switch a.current:before {
    color: ' . $jkwhmhh_color_1 . ';
}
.column-comments .post-com-count-approved:focus .comment-count-approved, .column-comments .post-com-count-approved:hover .comment-count-approved, .column-response .post-com-count-approved:focus .comment-count-approved, .column-response .post-com-count-approved:hover .comment-count-approved {
    background: ' . $jkwhmhh_color_1 . ';
}
.column-comments .post-com-count-approved:focus:after, .column-comments .post-com-count-approved:hover:after, .column-response .post-com-count-approved:focus:after, .column-response .post-com-count-approved:hover:after {
    border-top-color: ' . $jkwhmhh_color_1 . ';
}
#adminmenu .wp-has-current-submenu ul>li>a, .folded #adminmenu li.menu-top .wp-submenu>li>a {
	padding: 6px 0px 6px 37px;
	margin: 0;
}
#adminmenu .wp-submenu li {
	overflow: visible;
}
.wp-first-item a {
	margin-left: 0!important;
}
.wp-core-ui .button-primary-disabled, .wp-core-ui .button-primary.disabled, .wp-core-ui .button-primary:disabled, .wp-core-ui .button-primary[disabled] {
	color: #d2d2d2!important;
	background: ' . $secondary_color . '!important;
	border-color: transparent!important;
}
#reg_passmail {
	display: none;
}
.default-password-nag {
	display: none;
}
#wp-auth-check-wrap #wp-auth-check {
	background-color: #e6e7e8;
}
.plugin-install #the-list td, .plugins .active td, .plugins .active th, .plugins .inactive td, .plugins .inactive th, .upgrade .plugins td, .upgrade .plugins th {
	-webkit-box-shadow: none;
	box-shadow: none;
}
.user-profile-picture {
	display: none;
}
#wpadminbar #wp-admin-bar-my-account.with-avatar>.ab-empty-item img, #wpadminbar #wp-admin-bar-my-account.with-avatar>a img {
	border: none;
}
#wpadminbar .ab-icon, #wpadminbar .ab-item:before, #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default .ab-icon {
	padding: 0px 0;
}
#adminmenu li>a.menu-top:focus {
	position: relative;
	background-color: ' . $jkwhmhh_color_2 . ';
	color: #fff;
}
#adminmenu {
	margin: 0px 0;
}
#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a, #wpadminbar .quicklinks .menupop ul li a:focus, #wpadminbar .quicklinks .menupop ul li a:focus strong, #wpadminbar .quicklinks .menupop ul li a:hover, #wpadminbar .quicklinks .menupop ul li a:hover strong, #wpadminbar .quicklinks .menupop.hover ul li a:focus, #wpadminbar .quicklinks .menupop.hover ul li a:hover, #wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:focus, #wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:hover, #wpadminbar li #adminbarsearch.adminbar-focused:before, #wpadminbar li .ab-item:focus .ab-icon:before, #wpadminbar li .ab-item:focus:before, #wpadminbar li a:focus .ab-icon:before, #wpadminbar li.hover .ab-icon:before, #wpadminbar li.hover .ab-item:before, #wpadminbar li:hover #adminbarsearch:before, #wpadminbar li:hover .ab-icon:before, #wpadminbar li:hover .ab-item:before, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
	color: #98999c;
}
#wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item, #wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus {
	background: #23282d;
	color: #f7f8fa;
}
@media screen and (max-width: 782px) {
	.wp-responsive-open #wpadminbar #wp-admin-bar-menu-toggle a {
		background: #23282d;
	}
	.wp-responsive-open #wpadminbar #wp-admin-bar-menu-toggle .ab-icon:before {
		color: #98999c;
	}
}
#adminmenu li a:focus div.wp-menu-image:before, #adminmenu li:focus div.wp-menu-image:before {
	color: #ffffff!important;
}
@media screen and (max-width: 782px) {
	#wpadminbar li#wp-admin-bar-comments, #wpadminbar li#wp-admin-bar-customize, #wpadminbar li#wp-admin-bar-edit, #wpadminbar li#wp-admin-bar-my-sites, #wpadminbar li#wp-admin-bar-new-content, #wpadminbar li#wp-admin-bar-updates, #wpadminbar li#wp-admin-bar-wp-logo {
		display: none;
	}
}
#wpadminbar #wp-admin-bar-my-sites a.ab-item, #wpadminbar #wp-admin-bar-site-name a.ab-item {
	overflow: visible;
}
#wpadminbar #wp-admin-bar-site-name>.ab-item {
	width: 0;
}
html.wp-toolbar {
	padding-top: 40px;
}
@media screen and (max-width: 600px) {
	html.wp-toolbar {
		padding-top: 0!important;
	}
}
#wp-admin-bar-my-account li a {
	font-size: 14px;
}
#wpadminbar * {
	font-family: "Source Sans Pro", Tahoma, Arial, sans-serif;
}
#wpadminbar, #wpadminbar * {
	font-weight: 400;
	font-size: 18px;
	line-height: 40px;
	color: #98999c !important;
}
.wp-admin #wpadminbar #wp-admin-bar-site-name>.ab-item:before {
	content: "";
}
#wpadminbar {
	height: 40px;
}
#wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
	height: 40px;
}
#adminmenu li.wp-menu-separator {
	display: none;
}
body {
	background-color: #f7f8fa;
	color: #4d4d4d;
	font-family: "Source Sans Pro", Tahoma, Arial, sans-serif;
	font-size: 14px;
	line-height: 1.4em;
}
input[type=radio]:checked:before {
	background-color: ' . $jkwhmhh_color_1 . ';
}
input[type=checkbox]:checked:before {
	color: ' . $jkwhmhh_color_1 . ';
}
.postbox .inside h2, .wrap [class$=icon32]+h2, .wrap h1, .wrap>h2:first-child {
	margin: 0;
	padding: 20px 0 20px;
	font-weight: 300;
	font-size: 42px;
	line-height: 1;
}
.plugin-update {
	display: none;
}
.plugins .active td, .plugins .active th {
	background-color: #ffffff;
}
h1, h2, h3 {
	color: #000;
}
.plugin-update-tr.active td, .plugins .active th.check-column {
	border-left: 4px solid ' . $jkwhmhh_color_1 . ';
}
#menu-management .menu-edit, #menu-settings-column .accordion-container, .comment-ays, .feature-filter, .imgedit-group, .manage-menus, .menu-item-handle, .popular-tags, .stuffbox, .widget-inside, .widget-top, .widgets-holder-wrap, .wp-editor-container, p.popular-tags, table.widefat {
	border: inherit;
	-webkit-box-shadow: none;
	box-shadow: none;
	border-top: 1px solid #dddddd;
	border-left: 1px solid #dddddd;
	border-right: 1px solid #dddddd;
	border-bottom: 1px solid #dddddd;
}
.alternate, .striped>tbody>:nth-child(odd), ul.striped>:nth-child(odd) {
	background-color: #fff;
}
#adminmenu .wp-has-current-submenu .wp-submenu .wp-submenu-head, #adminmenu .wp-menu-arrow, #adminmenu .wp-menu-arrow div, #adminmenu li.current a.menu-top, #adminmenu li.wp-has-current-submenu a.wp-has-current-submenu, .folded #adminmenu li.current.menu-top, .folded #adminmenu li.wp-has-current-submenu {
	background: ' . $jkwhmhh_color_2 . ';
	color: #ffffff;
}
#adminmenu, #adminmenu .wp-submenu, #adminmenuback, #adminmenuwrap {
	background-color: #e6e7e8;
}
#adminmenu a {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu .wp-submenu a {
	color: rgba(63, 68, 76, 0.7);
}
#adminmenu .wp-has-current-submenu .wp-submenu, #adminmenu .wp-has-current-submenu .wp-submenu.sub-open, #adminmenu .wp-has-current-submenu.opensub .wp-submenu, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu, .no-js li.wp-has-current-submenu:hover .wp-submenu {
	background-color: #dfe0e2;
}
#adminmenu div.wp-menu-image:before {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu .wp-submenu .wp-submenu-head {
	color: rgba(63, 68, 76, 0.7);
	font-weight: 400;
	font-size: 14px;
	line-height: 1.4;
	padding: 8px 0px 7px 37px;
	margin: 0;
}
#adminmenu li a.wp-has-current-submenu .update-plugins, #adminmenu li.current a .awaiting-mod {
	background-color: rgb(230, 231, 232);
	color: ' . $jkwhmhh_color_2 . ';
}
.wp-core-ui .button-primary {
	background: ' . $secondary_color . ';
	border-color: transparent;
	-webkit-box-shadow: none;
	box-shadow: none;
	color: #fff;
	text-decoration: none;
	text-shadow: none;
}
a:active, a:hover {
	color: ' . $jkwhmhh_color_1 . ';
	text-decoration: underline;
}
a {
	color: ' . $jkwhmhh_color_1 . ';
}
.wrap .add-new-h2, .wrap .add-new-h2:active, .wrap .page-title-action, .wrap .page-title-action:active {
	color: ' . $jkwhmhh_color_1 . ';
}
.theme-browser .theme.add-new-theme a:focus span:after, .theme-browser .theme.add-new-theme a:hover span:after {
	background: #fff;
	color: ' . $jkwhmhh_color_1 . ';
}
.wp-core-ui .button-primary.focus, .wp-core-ui .button-primary.hover, .wp-core-ui .button-primary:focus, .wp-core-ui .button-primary:hover {
	background: ' . $jkwhmhh_color_1 . ';
	border-color: transparent;
}
.theme-browser .theme.add-new-theme a:focus:after, .theme-browser .theme.add-new-theme a:hover:after {
	background: ' . $jkwhmhh_color_1 . ';
}
#wpfooter {
	display: none;
}
.wrap .add-new-h2:hover, .wrap .page-title-action:hover {
	border-color: ' . $jkwhmhh_color_1 . ';
	background: ' . $jkwhmhh_color_1 . ';
	color: #fff;
}
#wp-admin-bar-wp-logo, #wp-admin-bar-updates, #wp-admin-bar-comments, #wp-admin-bar-new-content, #wp-admin-bar-site-name-default, #wp-admin-bar-customize, #wp-admin-bar-edit, #wp-admin-bar-appearance, #wp-admin-bar-archive, #wp-admin-bar-search, #wp-admin-bar-view {
	display: none;
}
#adminmenu li a:focus div.wp-menu-image:before, #adminmenu li:focus div.wp-menu-image:before {
	color: inherit!important
}
#wpadminbar #wp-admin-bar-site-name>.ab-item:before {
	content: "";
}
#adminmenu li.menu-top:hover {
	position: relative;
	background-color: #d2d3d6;
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu .wp-submenu a:focus, #adminmenu .wp-submenu a:hover, #adminmenu a:hover {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu .wp-submenu li:hover, #adminmenu li.opensub>a.menu-top  {
	background-color: #d2d3d6;
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu .opensub .wp-submenu li.current a, #adminmenu .wp-submenu li.current, #adminmenu .wp-submenu li.current a, #adminmenu .wp-submenu li.current a:focus, #adminmenu .wp-submenu li.current a:hover, #adminmenu a.wp-has-current-submenu:focus+.wp-submenu li.current a {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu .awaiting-mod, #adminmenu .update-plugins {
	background-color: ' . $jkwhmhh_color_2 . ';
}
#collapse-button {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#wpadminbar.mobile .quicklinks .hover .ab-icon:before, #wpadminbar.mobile .quicklinks .hover .ab-item:before {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#adminmenu li a:focus div.wp-menu-image:before, #adminmenu li.opensub div.wp-menu-image:before, #adminmenu li:hover div.wp-menu-image:before {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#collapse-button:focus, #collapse-button:hover {
	background-color: #d2d3d6;
	color: ' . $jkwhmhh_color_2_pre . ';
	box-shadow: inset -1px 0 0 0 rgba(0, 0, 0, 0.1);
}
.bar {
	background-color: #e8e8e8;
	border-right-color: transparent;
}
.wp-pointer-left .wp-pointer-arrow-inner {
	left: 1px;
	margin-left: -13px;
	margin-top: -13px;
	border: 13px solid transparent;
	border-right-color: transparent;
	display: block;
	content: " ";
}
.wp-pointer-left .wp-pointer-arrow {
	left: 0;
	border-width: 13px 13px 13px 0;
	border-right-color: transparent;
}
#adminmenu li.wp-has-submenu.wp-not-current-submenu.opensub:hover:after {
	border-right-color: transparent;
}
ul#adminmenu a.wp-has-current-submenu:after, ul#adminmenu>li.current>a.current:after {
	right: 0;
	border: 8px solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
	border-right-color: #e6e7e8;
	top: 50%;
	margin-top: -8px;
}
li#toplevel_page_wpcf-cpt div.wp-menu-image:before, li#toplevel_page_wpcf-cpt .dashicons-admin-generic:before, li#toplevel_page_toolset-dashboard div.wp-menu-image:before, li#toplevel_page_toolset-dashboard .dashicons-admin-generic:before, li#toolset_page_dd_layouts div.wp-menu-image:before, li#toplevel_page_dd_layouts .dashicons-admin-generic:before, li#toplevel_page_embedded-views div.wp-menu-image:before, li#toplevel_page_views div.wp-menu-image:before, li#toplevel_page_ModuleManager_Modules div.wp-menu-image:before, li#toplevel_page_CRED_Forms div.wp-menu-image:before, li#toplevel_page_wpcf div.wp-menu-image:before, li#toplevel_page_types_access div.wp-menu-image:before, li#toplevel_page_CRED_Commerce div.wp-menu-image:before, li#toplevel_page_toolset-packager div.wp-menu-image:before, li#toplevel_page_toolset-settings div.wp-menu-image:before {
	font-family: "onthegosystems-icons"!important;
	content: "\f12a";
	font-size: 14px!important;
	width: 14px;
	padding-left: 3px;
	padding-top: 11px;
}
#adminmenu .wp-submenu, .folded #adminmenu .wp-has-current-submenu .wp-submenu, .folded #adminmenu a.wp-has-current-submenu:focus+.wp-submenu {
	padding: 0px 0 0px;
	-webkit-box-shadow: none;
	box-shadow: none;
}
#adminmenu .wp-submenu a {
	font-size: 14px;
	line-height: 1.4;
	padding: 8px 0;
}
.dashicons, .dashicons-before:before {
	width: 16px;
	height: 16px;
	font-size: 16px;
}
div.wp-menu-image:before {
	padding: 9px 0;
}
#adminmenu .wp-has-current-submenu ul>li>a, .folded #adminmenu li.menu-top .wp-submenu>li>a {
	padding: 6px 0px 6px 37px;
	margin: 0;
}
#adminmenu .wp-submenu li {
	overflow: visible;
}
.wp-first-item a {
	margin-left: 0!important;
}
#wpadminbar .ab-icon, #wpadminbar .ab-item:before, #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default .ab-icon {
	position: relative;
	float: left;
	font: 400 20px/1 dashicons;
	speak: none;
	font-size: 14px;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	background-image: none!important;
	margin-right: 6px;
}
</style>
';
}

// adds custom css to wp-admin elements on frontend
add_action('wp_head', 'add_custom_css_frontend');
function add_custom_css_frontend () {
echo '
<meta name="msapplication-TileColor" content="' . $jkwhmhh_color_1 . '">
<meta name="theme-color" content="' . $jkwhmhh_color_1 . '">
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600" rel="stylesheet" type="text/css">
<style>
#wpadminbar #wp-admin-bar-my-account.with-avatar>.ab-empty-item img, #wpadminbar #wp-admin-bar-my-account.with-avatar>a img {
	border: none;
}
#wpadminbar .ab-icon, #wpadminbar .ab-item:before, #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default .ab-icon {
	padding: 0px 0;
}
.view-switch a.current:before {
    color: ' . $jkwhmhh_color_1 . ';
}
.column-comments .post-com-count-approved:focus .comment-count-approved, .column-comments .post-com-count-approved:hover .comment-count-approved, .column-response .post-com-count-approved:focus .comment-count-approved, .column-response .post-com-count-approved:hover .comment-count-approved {
    background: ' . $jkwhmhh_color_1 . ';
}
#wp-admin-bar-wp-logo, #wp-admin-bar-updates, #wp-admin-bar-comments, #wp-admin-bar-new-content, #wp-admin-bar-site-name-default, #wp-admin-bar-customize, #wp-admin-bar-edit, #wp-admin-bar-appearance, #wp-admin-bar-archive, #wp-admin-bar-search, #wp-admin-bar-view {
	display: none;
}
#wpadminbar .quicklinks .ab-sub-wrapper .menupop.hover>a, #wpadminbar .quicklinks .menupop ul li a:focus, #wpadminbar .quicklinks .menupop ul li a:focus strong, #wpadminbar .quicklinks .menupop ul li a:hover, #wpadminbar .quicklinks .menupop ul li a:hover strong, #wpadminbar .quicklinks .menupop.hover ul li a:focus, #wpadminbar .quicklinks .menupop.hover ul li a:hover, #wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:focus, #wpadminbar .quicklinks .menupop.hover ul li div[tabindex]:hover, #wpadminbar li #adminbarsearch.adminbar-focused:before, #wpadminbar li .ab-item:focus .ab-icon:before, #wpadminbar li .ab-item:focus:before, #wpadminbar li a:focus .ab-icon:before, #wpadminbar li.hover .ab-icon:before, #wpadminbar li.hover .ab-item:before, #wpadminbar li:hover #adminbarsearch:before, #wpadminbar li:hover .ab-icon:before, #wpadminbar li:hover .ab-item:before, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:focus, #wpadminbar.nojs .quicklinks .menupop:hover ul li a:hover {
	color: #98999c;
}
#wpadminbar .ab-top-menu>li.hover>.ab-item, #wpadminbar.nojq .quicklinks .ab-top-menu>li>.ab-item:focus, #wpadminbar:not(.mobile) .ab-top-menu>li:hover>.ab-item, #wpadminbar:not(.mobile) .ab-top-menu>li>.ab-item:focus {
	background: #23282d;
	color: #f7f8fa;
}
@media screen and (max-width: 782px) {
	.wp-responsive-open #wpadminbar #wp-admin-bar-menu-toggle a {
		background: #23282d;
	}
	.wp-responsive-open #wpadminbar #wp-admin-bar-menu-toggle .ab-icon:before {
		color: #98999c;
	}
}
@media screen and (max-width: 782px) {
	#wpadminbar li#wp-admin-bar-comments, #wpadminbar li#wp-admin-bar-customize, #wpadminbar li#wp-admin-bar-edit, #wpadminbar li#wp-admin-bar-my-sites, #wpadminbar li#wp-admin-bar-new-content, #wpadminbar li#wp-admin-bar-updates, #wpadminbar li#wp-admin-bar-wp-logo {
		display: none;
	}
}
#wpadminbar #wp-admin-bar-my-sites a.ab-item, #wpadminbar #wp-admin-bar-site-name a.ab-item {
	overflow: visible;
}
#wpadminbar #wp-admin-bar-site-name>.ab-item {
	width: 0;
}
html.wp-toolbar {
	padding-top: 40px;
}
@media screen and (max-width: 600px) {
	html.wp-toolbar {
		padding-top: 0!important;
	}
}
#wp-admin-bar-my-account li a {
	font-size: 14px;
}
#wpadminbar * {
	font-family: "Source Sans Pro", Tahoma, Arial, sans-serif;
}
#wpadminbar, #wpadminbar * {
	font-weight: 400;
	font-size: 18px;
	line-height: 40px;
	color: #98999c !important;
}
.wp-admin #wpadminbar #wp-admin-bar-site-name>.ab-item:before {
	content: "";
}
#wpadminbar {
	height: 40px;
}
#wpadminbar .quicklinks .ab-empty-item, #wpadminbar .quicklinks a, #wpadminbar .shortlink-input {
	height: 40px;
}
#wpadminbar #wp-admin-bar-site-name>.ab-item:before {
	content: "";
}
#wpadminbar.mobile .quicklinks .hover .ab-icon:before, #wpadminbar.mobile .quicklinks .hover .ab-item:before {
	color: ' . $jkwhmhh_color_2_pre . ';
}
#wpadminbar .ab-icon, #wpadminbar .ab-item:before, #wpadminbar>#wp-toolbar>#wp-admin-bar-root-default .ab-icon {
	position: relative;
	float: left;
	font: 400 20px/1 dashicons;
	speak: none;
	font-size: 14px;
	-webkit-font-smoothing: antialiased;
	-moz-osx-font-smoothing: grayscale;
	background-image: none!important;
	margin-right: 6px;
}
</style>
';
}

// local avatar
class simple_local_avatars {
    function simple_local_avatars() {
        add_filter('get_avatar', array($this, 'get_avatar'), 10, 5);
        add_action('admin_init', array($this, 'admin_init'));
        add_action('show_user_profile', array($this, 'edit_user_profile'));
        add_action('edit_user_profile', array($this, 'edit_user_profile'));
        add_action('personal_options_update', array($this, 'edit_user_profile_update'));
        add_action('edit_user_profile_update', array($this, 'edit_user_profile_update'));
        add_filter('avatar_defaults', array($this, 'avatar_defaults'));
    }
    function get_avatar($avatar = '', $id_or_email, $size = '96', $default = '', $alt = false) {
        if (is_numeric($id_or_email))
            $user_id = (int) $id_or_email;
        elseif (is_string($id_or_email)) {
            if ($user = get_user_by_email($id_or_email))
                $user_id = $user->ID;
        } elseif (is_object($id_or_email) && !empty($id_or_email->user_id))
            $user_id = (int) $id_or_email->user_id;
        if (!empty($user_id))
            $local_avatars = get_user_meta($user_id, 'simple_local_avatar', true);
        if (!isset($local_avatars) || empty($local_avatars) || !isset($local_avatars['full'])) {
            if (!empty($avatar))
                return $avatar;
            remove_filter('get_avatar', 'get_simple_local_avatar');
            $avatar = get_avatar($id_or_email, $size, $default);
            add_filter('get_avatar', 'get_simple_local_avatar', 10, 5);
            return $avatar;
        }
        if (!is_numeric($size))
            $size = '96';
        if (empty($alt))
            $alt = get_the_author_meta('display_name', $user_id);
        if (empty($local_avatars[$size])) {
            $upload_path = wp_upload_dir();
            $avatar_full_path = str_replace($upload_path['baseurl'], $upload_path['basedir'], $local_avatars['full']);
            $image_sized = image_resize($avatar_full_path, $size, $size, true);
            if (is_wp_error($image_sized))
                $local_avatars[$size] = $local_avatars['full'];
            else
                $local_avatars[$size] = str_replace($upload_path['basedir'], $upload_path['baseurl'], $image_sized);
            update_user_meta($user_id, 'simple_local_avatar', $local_avatars);
        } elseif (substr($local_avatars[$size], 0, 4) != 'http')
            $local_avatars[$size] = site_url($local_avatars[$size]);
        $author_class = is_author($user_id) ? ' current-author' : '';
        $avatar = "<img alt='" . esc_attr($alt) . "' src='" . $local_avatars[$size] . "' class='avatar avatar-{$size}{$author_class} photo' height='{$size}' width='{$size}' />";
        return $avatar;
    }
    function admin_init() {
        load_plugin_textdomain('simple-local-avatars', false, dirname(plugin_basename(__FILE__)) . '/localization/');
        register_setting('discussion', 'simple_local_avatars_caps', array($this, 'sanitize_options'));
        add_settings_field('simple-local-avatars-caps', __('Avatar Permissions', 'simple-local-avatars'), array($this, 'avatar_settings_field'), 'discussion', 'avatars');
    }
    function sanitize_options($input) {
        $new_input['simple_local_avatars_caps'] = empty($input['simple_local_avatars_caps']) ? 0 : 1;
        return $new_input;
    }
    function avatar_settings_field($args) {
        $options = get_option('simple_local_avatars_caps');
        echo '
            <label for="simple_local_avatars_caps">
                <input type="checkbox" name="simple_local_avatars_caps" id="simple_local_avatars_caps" value="1" ' . @checked($options['simple_local_avatars_caps'], 1, false) . ' />
                ' . __('Only allow staff to upload avatars', 'simple-local-avatars') . '
            </label>
        ';
    }
    function edit_user_profile($profileuser) {
        ?>
        <h3><?php _e('Profile Picture', 'simple-local-avatars'); ?></h3>
        <table class="form-table">
            <tr>
                <th><label for="simple-local-avatar"><?php _e('Upload', 'simple-local-avatars'); ?></label></th>
                <td style="width: 50px;" valign="top">
                    <?php echo get_avatar($profileuser->ID); ?>
                </td>
                <td>
                    <?php
                    $options = get_option('simple_local_avatars_caps');
                    if (empty($options['simple_local_avatars_caps']) || current_user_can('upload_files')) {
                        do_action('simple_local_avatar_notices');
                        wp_nonce_field('simple_local_avatar_nonce', '_simple_local_avatar_nonce', false);
                    ?>
                    <input type="file" name="simple-local-avatar" id="simple-local-avatar" /><br />
                    <?php
                    if (empty($profileuser->simple_local_avatar))
                        echo '<span class="description">' . __('', 'simple-local-avatars') . '</span>';
                    else
                        echo '
                            <input type="checkbox" name="simple-local-avatar-erase" value="1" /> ' . __('Delete', 'simple-local-avatars') . '<br />
                            <span class="description">' . __('', 'simple-local-avatars') . '</span>
                        ';
                    } else {
                        if (empty($profileuser->simple_local_avatar))
                            echo '<span class="description">' . __('', 'simple-local-avatars') . '</span>';
                        else
                            echo '<span class="description">' . __('To change your avatar, contact us.', 'simple-local-avatars') . '</span>';
                    }
                    ?>
                </td>
            </tr>
        </table>
        <script>
            var form = document.getElementById('your-profile');
            form.encoding = 'multipart/form-data';
            form.setAttribute('enctype', 'multipart/form-data');
        </script>
        <?php
    }
    function edit_user_profile_update($user_id) {
        if (!wp_verify_nonce($_POST['_simple_local_avatar_nonce'], 'simple_local_avatar_nonce')) //security
            return;
        if (!empty($_FILES['simple-local-avatar']['name'])) {
            $mimes = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif' => 'image/gif',
                'png' => 'image/png',
                'bmp' => 'image/bmp',
                'tif|tiff' => 'image/tiff'
            );
            $avatar = wp_handle_upload($_FILES['simple-local-avatar'], array('mimes' => $mimes, 'test_form' => false));
            if (empty($avatar['file'])) // handle failures
                {
                switch ($avatar['error']) {
                    case 'File type does not meet security guidelines. Try another.':
                        add_action('user_profile_update_errors', create_function('$a', '$a->add("avatar_error",__("Please upload a valid image file.","simple-local-avatars"));'));
                        break;
                    default:
                        add_action('user_profile_update_errors', create_function('$a', '$a->add("avatar_error","<strong>".__("There was an error uploading the avatar:","simple-local-avatars")."</strong> ' . esc_attr($avatar['error']) . '");'));
                }
                return;
            }
            $this->avatar_delete($user_id); // delete old images if successful
            update_user_meta($user_id, 'simple_local_avatar', array('full' => $avatar['url'])); // save user information (overwriting old)
        } elseif (isset($_POST['simple-local-avatar-erase']) && $_POST['simple-local-avatar-erase'] == 1)
            $this->avatar_delete($user_id);
    }
    // remove the custom get_avatar hook for the default avatar list output on options-discussion.php
    function avatar_defaults($avatar_defaults) {
        remove_action('get_avatar', array($this, 'get_avatar'));
        return $avatar_defaults;
    }
    // delete avatars based on user_id
    function avatar_delete($user_id) {
        $old_avatars = get_user_meta($user_id, 'simple_local_avatar', true);
        $upload_path = wp_upload_dir();
        if (is_array($old_avatars)) {
            foreach ($old_avatars as $old_avatar) {
                $old_avatar_path = str_replace($upload_path['baseurl'], $upload_path['basedir'], $old_avatar);
                @unlink($old_avatar_path);
            }
        }
        delete_user_meta($user_id, 'simple_local_avatar');
    }
}
$simple_local_avatars = new simple_local_avatars;
if (!function_exists('get_simple_local_avatar')):
	function get_simple_local_avatar($id_or_email, $size = '96', $default = '', $alt = false) {
		global $simple_local_avatars;
		return $simple_local_avatars->get_avatar('', $id_or_email, $size, $default, $alt);
	}
endif;
register_uninstall_hook(__FILE__, 'simple_local_avatars_uninstall');
function simple_local_avatars_uninstall() {
    $simple_local_avatars = new simple_local_avatars;
    $users = get_users_of_blog();
    foreach ($users as $user)
		$simple_local_avatars->avatar_delete($user->user_id);
    delete_option('simple_local_avatars_caps');
}
if (!function_exists('get_avatar')):
function get_avatar($id_or_email, $size = '96', $default = '', $alt = false) {
    if (!get_option('show_avatars')) return false;
    static $default_url;
    if (!isset($default_url)) $default_url = 'https://i.imgur.com/TTb5ZnD.jpg';
    if (false === $alt) $safe_alt = '';
    else $safe_alt = esc_attr($alt);
    if (!is_numeric($size)) $size = '96';
    $avatar = "<img alt='{$safe_alt}' src='{$default_url}' class='avatar avatar-{$size} photo avatar-default' height='{$size}' width='{$size}' />";
    return apply_filters('get_avatar', $avatar, $id_or_email, $size, $default, $alt);
}
endif;
function __limit_default_avatars_setting($default) {
	return 'local_default';
}
add_filter('pre_option_avatar_default','__limit_default_avatars_setting');
if (is_admin()):
function __limit_default_avatars($defaults) {
	return array('local_default' => get_bloginfo('name') . ' Default');
}
add_filter('avatar_defaults','__limit_default_avatars');
endif;
function __my_theme_default_avatar($url) {
	return 'https://i.imgur.com/TTb5ZnD.jpg';
}
add_filter('local_default_avatar','__my_theme_default_avatar');

// Admin Settings
function add_admin_settings() {
	add_menu_page(
		"Admin Settings",
		"Admin Settings",
		"manage_options",
		"admin-settings",
		"admin_settings_page",
		"dashicons-art",
		100
	);
}
function admin_settings_page() { ?>
	<div class="wrap">
		<h1>Admin Settings</h1>
		<form method="post" action="options.php">
			<?php
			settings_fields("admin_setting_section");
			do_settings_sections("admin-settings");
			submit_button();
			?>
		</form>
	</div>
<?php
}
add_action("admin_menu", "add_admin_settings");
function display_admin_settings() {

	add_settings_section("admin_setting_section", "Set your logo and colors", "display_admin_setting_content", "admin-settings");

	add_settings_field("admin_logo", "Logo Url", "display_admin_logo_form", "admin-settings", "admin_setting_section");
	register_setting("admin_setting_section", "admin_logo");

	add_settings_field("jkwhmhh_color_1", "Color #1", "display_jkwhmhh_color_1", "admin-settings", "admin_setting_section");
	register_setting("admin_setting_section", "jkwhmhh_color_1");

	add_settings_field("jkwhmhh_color_2", "Color #2", "display_jkwhmhh_color_2", "admin-settings", "admin_setting_section");
	register_setting("admin_setting_section", "jkwhmhh_color_2");

}
function display_admin_setting_content() { echo ""; }
function display_admin_logo_form() { ?>
<input type="text" name="admin_logo" id="admin_logo" value="<?php echo get_option('admin_logo'); ?>" />
<?php
}
function display_jkwhmhh_color_1() { ?>
<input type="text" class="jkwhmhh_color_1" name="jkwhmhh_color_1" id="jkwhmhh_color_1" value="<?php echo get_option('jkwhmhh_color_1'); ?>" />
<?php
}
function display_jkwhmhh_color_2() { ?>
<input type="text" class="jkwhmhh_color_2" name="jkwhmhh_color_2" id="jkwhmhh_color_2" value="<?php echo get_option('jkwhmhh_color_2'); ?>" />
<?php
}
add_action("admin_init", "display_admin_settings");

// WordPress Color Picker API
add_action( 'admin_enqueue_scripts', 'add_color_picker' );
function add_color_picker($hook) {
     if( is_admin() ) {       
        wp_enqueue_style( 'wp-color-picker' ); 
        wp_enqueue_script( 'custom-script-handle', plugins_url( 'color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true ); 
    }
}

?>
