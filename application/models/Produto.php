<?php

class Produto extends Model{


    public function __construct() {
        $this->table = 'produto';
        parent::__construct();
    }	
	
}