<?php

class routes
{

  private $listRoutes = [''];
  private $listCallBack = [''];
  private $listProctetion = [''];

  public function add($method, $route, $callback, $proctetion)
  {
    $this->listRoutes[] = strtoupper($method) . ':' . $route;
    $this->listCallBack[] = $callback;
    $this->listProctetion[] = $proctetion;

    return $this;
  }

  public function go($route)
  {

    $param = '';
    $callback = '';
    $proctetion = '';

    $methodServer = $_SERVER['REQUEST_METHOD'];
    $methodServer = isset($_POST['_method']) ? $_POST['_method'] : $methodServer;
    $route = $methodServer . ":/" . $route;

    if (substr_count($route, "/") >= 3) {
      $param = substr($route, strrpos($route, "/") + 1);
      $route = substr($route, 0, strrpos($route, "/")) . "/[PARAM]";
    }

    $index = array_search($route, $this->listRoutes);

    if ($index > 0) {
      $callback = explode("::", $this->listCallBack[$index]);
      $proctetion = $this->listProctetion[$index];
    }

    $class = isset($callback[0]) ? $callback[0] : '';
    $method = isset($callback[1]) ? $callback[1] : '';

    if (class_exists($class)) {

      if (method_exists($class, $method)) {
        $instanceClass = new $class();
        if ($proctetion) {
          $verification = new Users();
          if ($verification->verify()) {
            return call_user_func_array(
              array($instanceClass, $method),
              array($param)
            );
          } else {
            echo json_encode(['Error' => 'Access permission denied, User is not logged in']);
          }
        } else {
          return call_user_func_array(
            array($instanceClass, $method),
            array($param)
          );
        }
      } else {
        $this->notExist();
      }
    } else {
      $this->notExist();
    }
  }

  public function notExist()
  {
    http_response_code(404);
  }
}