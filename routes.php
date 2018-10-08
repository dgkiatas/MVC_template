<?php
  function call($controller, $action) {
    // require the file that matches the controller, model, view name
    require_once('controllers/' . $controller . '_controller.php');
    require_once('models/' . $controller . '_model.php');
    require_once('views/' . $controller . '.php');
    // create a new instance of the needed controller
    switch($controller) {
      case 'maintenance':
        $controller = new MaintenanceController();
        break;
      case 'home':
        $controller = new HomeController();
        break;
      
    }
  
    $controller->{ $action }();
  }

  // just a list of the controllers we have and their actions
  // we consider those "allowed" values
  $controllers = array(
    'home' => ['home', 'error'],
    'maintenance' => ['maintenance','error']

  );

  // check that the requested controller and action are both allowed
  // if someone tries to access something else he will be redirected to the error action of the pages controller
  if (array_key_exists($controller, $controllers)) {
    if (in_array($action, $controllers[$controller])) {
      call($controller, $action);
    } else {
      call('home', 'error');
    }
  } else {
    call('home', 'error');
  }
