<?php

/**
 * Description of Core
 *
 * @author Samuelson
 */
final class Core {

    public function run() {
        
        $flagRest = 1;

        $url = '/';
        $getUrl = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
        if (!empty($getUrl)) {
            $url .= $getUrl;
        }
        $params = array();

        if (!empty($getUrl) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);
            $currentController = ucfirst($url[0]) . 'Controller';
            array_shift($url);

            if (!empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }
            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = 'HomeController';
            $currentAction = 'index';
        }

        if($flagRest){

            if(strpos($getUrl, '/')){

                $url = explode('/', $getUrl);
                $currentController = ucfirst($url[0]) . 'Controller';
                $currentAction = 'index';
                array_shift($url);
                $params = $url;

            }else{

                $url = $getUrl;
                $currentController = ucfirst($url) . 'Controller';
                $currentAction = 'index';
            }

            if ($getUrl == NULL) {           
                $currentController = 'NotFoundController';
                $currentAction = 'index';
            }

        }else{

            if (!class_exists($currentController) || !method_exists($currentController, $currentAction)) {           
            $currentController = 'NotFoundController';
            $currentAction = 'index';
            }

        }



        $controller = new $currentController();
        call_user_func_array(array($controller, $currentAction), $params);

        
    }

}
