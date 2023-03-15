<?php

class ErrorResource extends Controller {
    
    public function __construct() {
         parent::__construct();
         $this->view->render('error/index');
     }

}
