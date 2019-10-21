<?php
/**
 * Created by PhpStorm.
 * User: Attract-01
 * Date: 6/6/2018
 * Time: 6:42 PM
 */

require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('dashbaord/dashbaord_link_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/validation_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');
require_once ('dashbaord/dashboard_main_container_open.php');
require_once ('dashbaord/dashboard_header.php');
require_once ('dashbaord/dashbaord_sidebar.php');
require_once ('dashbaord/dashboard_main_content_open.php');
require_once ('avaliable/available_check_form.php');
require_once ('dashbaord/dashboard_main_content_close.php');
require_once ('dashbaord/dashboard_main_container_close.php');
require_once ('common/body_close.php');

require_once ('dashbaord/dashbaord_link_js.php');
require_once ('plugins/bootstrap_select_js.php');
require_once ('plugins/validation_js.php');
require_once ('avaliable/available_check_js.php');

require_once ('spares/spares_model_forms.php');

require_once ('common/html_close.php');
?>
