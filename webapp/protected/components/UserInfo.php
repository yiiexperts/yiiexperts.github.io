<?php
	//Channel User Id
	
	function get_channel_id() {
        $app = Yii::app();
		$uid = Yii::app()->session['uid'];
	
		$sql = Yii::app()->db->createCommand();
		$sql->setFetchMode(PDO::FETCH_OBJ);
		 
		$sql->select('a.Id')->from('yii_channel a')->leftjoin('credential b', 'a.LoginId = b.LoginId')->where('b.Id = '.$uid)->limit('1');
		
		
		foreach ($sql->queryAll() as $row) {
			$cid = $row->Id;
		}

         return $cid;
     }
	 
	 
	 //Agency User Id
	 
	 function get_agency_id() {
		 
        $app = Yii::app();
		$uid = Yii::app()->session['uid'];
	
		$sql = Yii::app()->db->createCommand();
		$sql->setFetchMode(PDO::FETCH_OBJ);
		 
		$sql->select('a.Id')->from('yii_agency a')->leftjoin('credential b', 'a.LoginId = b.LoginId')->where('b.Id = '.$uid)->limit('1');
		
		
		foreach ($sql->queryAll() as $row) {
			$aid = $row->Id;
		}
		
		/*$row = Yii::app()->db->createCommand("SELECT a.Id FROM yii_agency a LEFT OUTER JOIN credential b ON a.LoginId = b.LoginId WHERE b.Id = ".$aid)->queryAll();*/

         return $aid;
     }
	 
	 
	 //Today Spot Availability
	 
	 function get_spot_availabilty($id) {
	
		$sql = Yii::app()->db->createCommand();
		$sql->setFetchMode(PDO::FETCH_OBJ);
		 
		$sql->select('sum(a.AvailableSpot) As fpc')->from('yii_dialyfpc a')->leftjoin('yii_channel b', 'a.ChannelCode = b.ChannelCode')->where('DATE(a.TeleCastDate) = DATE(NOW()) AND b.Id = '.$id)->group('a.ChannelCode, a.TeleCastDate')->limit('1');
		
		$count = count($sql->queryAll());
		
		foreach ($sql->queryAll() as $row) {
			$fpc = $row->fpc;
		}
		
		if($count>0)
          return $fpc.' sec';
		else
		  return "<span class='red'>Not Available</span>";
     }
 
?>