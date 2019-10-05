<?php
class Admin_Model extends CI_Model {
	
public function getCityWiseDetails()
{
	$state = $this->input->post('state');
$city = $this->input->post('city');
	$query = $this->db->query("select * from case_details as c1 right join disease_details on c1.disId = disease_details.disId right join user_master_details u1 on u1.usrId = c1.usrId right join area_list a1 on u1.usrPincode = a1.pincode where a1.city like '".$city."' AND a1.state Like '".$state."' group by c1.disId order by (count(*)) desc ");

		//$count1 = $query->num_rows();
		$i = 0;
		foreach($query->result() as $val)
		{
			$query2 = $this->db->query("select count(*) as `total` from case_details where disId = '".$val->disId."'");
			foreach($query2->result() as $val2) {
				$total = $val2->total;
			}
			$query3 = $this->db->query("select  count(DISTINCT(usrId)) as `totaluser` from case_details");
			foreach($query3->result() as $val3) {
				$totaluser = $val3->totaluser;
			}
			
			$query4 = $this->db->query("select count(*) as `totalcure` from case_details where isCure = 1 AND disId = '".$val->disId."'");
			foreach($query4->result() as $val4) {
				$totalcure = $val4->totalcure;
			}
			
			$query5 = $this->db->query("select count(*) as `totaluncure` from case_details where isCure = 0 AND disId = '".$val->disId."'");
			foreach($query5->result() as $val5) {
				$totaluncure = $val5->totaluncure;
			}
			
			
			$data[$i]["disId"] = $val->disName;
			$data[$i]["totalcure"] = $totalcure;
			$data[$i]["totaluncure"] = $totaluncure;
			$data[$i]["total"] = ($total*100)/($totaluser);
			$data[$i]["totaluser"] = $totaluser;
			
			$i++;
		}
		return $data;

	
}

public function getDiseaseDetails()
{
	$query = $this->db->query("select * from case_details as c1 right join disease_details on c1.disId = disease_details.disId group by c1.disId order by (count(*)) desc");

		//$count1 = $query->num_rows();
		$i = 0;
		foreach($query->result() as $val)
		{
			$query2 = $this->db->query("select count(*) as `total` from case_details where disId = '".$val->disId."'");
			foreach($query2->result() as $val2) {
				$total = $val2->total;
			}
			$query3 = $this->db->query("select  count(DISTINCT(usrId)) as `totaluser` from case_details");
			foreach($query3->result() as $val3) {
				$totaluser = $val3->totaluser;
			}
			
			$query4 = $this->db->query("select count(*) as `totalcure` from case_details where isCure = 1 AND disId = '".$val->disId."'");
			foreach($query4->result() as $val4) {
				$totalcure = $val4->totalcure;
			}
			
			$query5 = $this->db->query("select count(*) as `totaluncure` from case_details where isCure = 0 AND disId = '".$val->disId."'");
			foreach($query5->result() as $val5) {
				$totaluncure = $val5->totaluncure;
			}
			
			$t = $totalcure+$totaluncure;
			$tc = (($totalcure*100)/$t);
			$data[$i]["disId"] = $val->disName;
			$data[$i]["totalcure"] = $totalcure;
			$data[$i]["totaluncure"] = $totaluncure;
			$data[$i]["total"] = ($total*100)/($totaluser);
			$data[$i]["totaluser"] = $totaluser;
			
			$i++;
		}
		return $data;

	
}

public function getIndiaMapData() {
	
	//User -> DiesesId ->Pincode
	$query = $this->db->query("select d.disName as `disName`, a.latitude as `latitude`, a.longitude as `longitude` from disease_details d, area_list a, case_details c where d.disId = c.disId order by d.disName desc");
	$i = 0;
	foreach($query->result() as $val) {
		$data[$i]["latLng"] =array($val->latitude,$val->longitude);
		$data[$i]["name"] = $val->disName;
		
		$i++;
	}
	return $data;
	
	

}
public function generateData()
{
	for($i=0;$i<=100;$i++)
	{
	$query2 = $this->db->query("select max(id) as `mx` from case_details");
	foreach($query2->result() as $val2) {
		$mx = $val2->mx;
	}
	$caseId = "case".++$mx;
	$usrId = "usr".rand(1,100);
	$disId = "dis".rand(1,8);
	$isCure = 0;
	$timestamp = mt_rand(1577836800,1609459199);
 
//Format that timestamp into a readable date string.
$randomDate = date("Y-m-d", $timestamp);
 $cure = rand(0,1);
 if($cure==1)
 {
	 $timestamp2 = mt_rand($timestamp,1609459199);
	 $closeDate = date("Y-m-d", $timestamp2);
	 //echo $closeDate;
	 $query = $this->db->query("insert into case_details(caseId,usrId,disId,isCure,regDate,closeDate) VALUES('$caseId','$usrId','$disId',1,'$randomDate','$closeDate')");

 }
 else
 {
 
	$query = $this->db->query("insert into case_details(caseId,usrId,disId,isCure,regDate) VALUES('$caseId','$usrId','$disId',0,'$randomDate')");
 }
 
 
 
 
 
 }// end of loop

}


}
?>