<?php
/**
 * Created by PhpStorm.
 * User: mrikirill
 */

class Route
{

    public $controller;
    public $model;
    static public $instance;

    /**
     * @return mixed
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }

        return self::$instance;
    }


    /**
     * Route constructor.
     */
    function __construct()
    {
        if (is_object(self::$instance)) {
            $this->controller = self::$instance->controller;
            $this->model = self::$instance->model;
        } else {
            $this->controller = new Controller;
            $this->model = new Model;
        }
    }

    /**
     *init mvc
     */
    public function start()
    {
        $this->controller= new Controller();
        $this->model= new Model();

        if (isset($_GET['action']) && !empty($_GET['action'])) {

            $controller_name = strtolower(trim($_GET['action']));
            $do=strtolower(trim($_GET['do']));

            if (strlen($do) > 0) {
                $action_name = "action_" . $do;

                if (is_object($this->controller->$controller_name)) {
                    $res = $this->controller->$controller_name->$action_name();

                    header('Content-Type: application/json; charset=' . LANG_CHARSET);
                    echo json_encode($res);
                    die();
                }
            }
        }
    }
}


class Controller
{
    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        $path = __DIR__ . "/controllers/" . $name . ".php";
        if (file_exists($path)) {
            include_once($path);
            $controller_name = "Controller_" . $name;
            if (class_exists($controller_name)) {
                return new $controller_name;
            }
        }
    }
}

class Model
{
    /**
     * @param $name
     * @return mixed
     */
    function __get($name)
    {
        $path = __DIR__ . "/models/" . $name . ".php";
        if (file_exists($path)) {
            include_once($path);
            $model_name = "Model_" . $name;
            if (class_exists($model_name)) {
                return new $model_name;
            }
        }
    }
}
