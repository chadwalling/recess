<?php
$title = 'Routes';
$selectedNav = 'routes';
include_once($viewsDir . 'common/header.php');
?>
<h2 class="bottom">Routes</h2>
<?php
include_once($viewsDir . 'common/printRoutes.php');
$routes = RecessConf::getRoutes();

Library::import('recess.apps.tools.controllers.RecessToolsCodeController');
$codeController = new RecessToolsCodeController($response->request->meta->app);

printRoutes($routes, $codeController, '/recess');
?>
<?php include_once($viewsDir . 'common/footer.php'); ?>