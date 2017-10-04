<?php

abstract class Rest{

	public function __construct(){
		header("Content-Type: application/json");
	}

	public function index($id = null){

        switch (self::method()) {
        	case 'POST':
        		call_user_func(array($this, 'post'));
        		break;
        	case 'GET':
        		call_user_func(array($this, 'get'),$id);
        		break;
        	case 'PUT':
        		call_user_func(array($this, 'put'));
        		break;
        	case 'DELETE':
        		call_user_func(array($this, 'delete'),$id);
        		break;
        	case 'PATCH':
        		call_user_func(array($this, 'patch'));
        		break;
        }

	}

	private function post(){
	}

	private function get(){
	}

	private function put(){
	}

	private function delete(){
	}

	private function patch(){
	}

	private static function method(){
		return $_SERVER['REQUEST_METHOD'];
	}

	public static function getData(){
		$response = json_decode(file_get_contents("php://input"),true);
		$data = array();
		$data = ($response) ? $response : $data;
		return $data;
	}

	public static function response($code, $response = NULL){

		switch ($code) {
			case 200:
				http_response_code($code);
				header("Status: {$code} OK");
				break;
			case 201:
				http_response_code($code);
				header("Status: {$code} Created");
				break;
			case 204:
				http_response_code($code);
				header("Status: {$code} No Content");
				break;
			case 400:
				http_response_code($code);
				header("Status: {$code} Bad Request");
				break;
			case 404:
				http_response_code($code);
				header("Status: {$code} Not Found");
				break;
			case 500:
				http_response_code($code);
				header("Status: {$code} Internal Server Error");
				break;
		}

	}

}