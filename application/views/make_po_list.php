<?php
/**
 * Created by PhpStorm.
 * User: Ravi
 * Date: 25-07-2018
 * Time: 01:06 PM
 */


require_once ('common/html_open.php');

require_once ('common/head_open.php');
require_once ('common/meta.php');
require_once ('dashbaord/dashbaord_link_css.php');
require_once ('plugins/bootstrap_select_css.php');
require_once ('plugins/validation_css.php');
require_once ('plugins/datatables_css.php');
require_once ('common/head_close.php');

require_once ('common/body_open.php');
require_once ('dashbaord/dashboard_main_container_open.php');
require_once ('dashbaord/dashboard_header.php');
require_once ('dashbaord/dashbaord_sidebar.php');
require_once ('dashbaord/dashboard_main_content_open.php');
require_once ('po/make-po/make_po_datatables_list.php');             // modification file
require_once ('dashbaord/dashboard_main_content_close.php');
require_once ('dashbaord/dashboard_main_container_close.php');
require_once ('common/body_close.php');

require_once ('dashbaord/dashbaord_link_js.php');
require_once ('plugins/bootstrap_select_js.php');
require_once ('plugins/validation_js.php');
require_once ('plugins/datatables_js.php');
require_once ('po/make-po/make_po_datatables_js.php');  /// modification file

require_once ('po/make-po/make_po_model_forms.php');    /// modification file

require_once ('common/html_close.php');
?>
