<?php

/**
 * Description of Request
 * Requisições básicas com filtro
 *
 * @author Samuelson
 */
class Request {

    public static function post() {
        return filter_input_array(INPUT_POST, FILTER_DEFAULT);
    }

    public static function get(...$params) {
        $gets = array();
        foreach ($params as $param) {
            $gets[] = filter_input(INPUT_GET, "{$param}", FILTER_DEFAULT);
        }
        return $gets;
    }

}
