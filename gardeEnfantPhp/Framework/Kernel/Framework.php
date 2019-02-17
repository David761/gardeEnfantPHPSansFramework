<?php

require_once './Application/Controller/ProfessionnelsController.php';
require_once './Application/Controller/UserController.php';
require_once './Application/Controller/PlanningController.php';
require_once './Application/Controller/AdminController.php';
require_once './Application/Controller/SecurityController.php';
class Framework
{
    private $_viewparams;
    public static function run()
    {
        self::initialize();
        self::autoloader();
        self::header();
        self::switcher();
        self::footer();


    }

    private static function initialize()
    {
        $getParamUrl= $_SERVER['REQUEST_URI'];
        $getParamUrlArray = explode("/",$getParamUrl);


        define('DIRSEP',DIRECTORY_SEPARATOR);
        define('ROOT', getcwd().DIRSEP);
        define('APPPATH',ROOT.'Application'.DIRSEP);
        define('FRAMEWORK_PATH',ROOT.'Framework'.DIRSEP);
        define('PUB_PATH',dirname($_SERVER['SCRIPT_NAME']));
        define('CTRL_PATH', APPPATH. 'Controller'.DIRSEP);
        define('MDL_PATH', APPPATH. 'Model'.DIRSEP);
        define('VIEW_PATH', APPPATH. 'View'.DIRSEP);
        define('FORM_PATH', VIEW_PATH . 'Form'.DIRSEP);
        define('LAYOUT_PATH', VIEW_PATH . 'Layout'.DIRSEP);
        define('UNKNOWN_PAGE', LAYOUT_PATH . '404.php');
        define('KERNEL_PATH',FRAMEWORK_PATH. 'Kernel'.DIRSEP);



                define('CONTROLLER', $getParamUrlArray[2]);
                define('ACTION', $getParamUrlArray[3]);







    }
    private static function autoloader()
    {
        spl_autoload_register(array(__CLASS__,'loading'));
    }
    private static function loading($class)
    {
        if (substr($class,-10) == "Controller"){
            require_once "Framework.php";
        }
        elseif (substr($class,-5) == "Model"){
            require_once "Framework.php";
        }
    }
    private static function switcher()
    {
        $getParamUrl = $_SERVER['REQUEST_URI'];
        $getParamUrlArray = explode("/", $getParamUrl);

        if (count($getParamUrlArray) == 3 && $getParamUrlArray[2] == "") {
            include VIEW_PATH . "accueil.php";
        }else{
            if (isset($getParamUrlArray[3])) {
                if ($getParamUrlArray[2] != "" && $getParamUrlArray[3] != "") {
                    if (file_exists(CTRL_PATH . CONTROLLER . "Controller.php")) {
                        $controllerName = CONTROLLER . "Controller";
                        $actionName = ACTION;

                        $controller = new $controllerName;
                        if (method_exists($controller, ACTION)) {
                            $controller->$actionName();
                        } else {
                            include UNKNOWN_PAGE;
                        }
                    } else {
                        include UNKNOWN_PAGE;
                    }
                } else {
                    include UNKNOWN_PAGE;

                }
            } else {
                include UNKNOWN_PAGE;

            }
        }



    }


    protected function render(string $view, Array $viewparams = []) {

        $this->_viewparams = $viewparams;

        extract($this->_viewparams);

        $view = VIEW_PATH . '/' . $view . '.php';
        if( file_exists($view) ) :

            include_once $view;
        else :
            $this->render('Layout/404', [
                'message' => 'Aucune vue correspondante'
            ]);
        endif;
    }









    private static function header(){
        include_once LAYOUT_PATH.'header.php';
    }


    private static function footer(){
        include_once LAYOUT_PATH.'footer.php';
    }

}
