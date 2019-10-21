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
require_once ('plugins/datatables_css.php');
require_once ('plugins/export_pdf_excel_ect_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');
require_once ('dashbaord/dashboard_main_container_open.php');
require_once ('dashbaord/dashboard_header.php');
require_once ('dashbaord/dashbaord_sidebar.php');
require_once ('dashbaord/dashboard_main_content_open.php');
require_once ('inventry/inventry_datatables_list.php');                 // modification file
require_once ('dashbaord/dashboard_main_content_close.php');
require_once ('dashbaord/dashboard_main_container_close.php');
require_once ('common/body_close.php');

require_once ('dashbaord/dashbaord_link_js.php');
require_once ('plugins/datatables_js.php');
require_once ('plugins/export_pdf_excel_ect_js.php');
require_once ('inventry/inventry_datatables_js.php');                   // modification file

require_once ('common/html_close.php');
?>
