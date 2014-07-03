<?php

class MycartWidget extends CWidget {

	public $crumbs = array();
	public $htmlOptions = array();
 
    public function run() {
        $this->render('mycartWidget');
    }
}

?>