<?php

class UnsubscribeWidget extends CWidget {
    /*public function run() {
        $this->render('socialWidget'); 
    }*/
	
	public $crumbs = array();
	public $htmlOptions = array();
 
    public function run() {
        $this->render('unsubscribeWidget');
    }
}

?>