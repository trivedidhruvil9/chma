<?php
class Admin_Model extends CI_Model {

public function getDiseaseDetails()
{
	$query = $this->db->query("select * from case_details as c1 right join disease_details on c1.disId = disease_details.disId group by c1.disId");

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
			$data[$i]["disId"] = $val->disName;
			$data[$i]["total"] = ($total*100)/($totaluser);
			$data[$i]["totaluser"] = $totaluser;
			
			$i++;
		}
		return $data;

	
}
public function generateData()
{
	$query2 = $this->db->query("select max(id) as `mx` from case_details");
	foreach($query2->result() as $val2) {
		$mx = $val2->mx;
	}
	$caseId = "case".++$mx;
	$usrId = "usr".rand(1,10);
	$disId = "dis".rand(1,8);
	$isCure = 0;
	$timestamp = mt_rand(1, time());
 
//Format that timestamp into a readable date string.
$randomDate = date("Y-m-d", $timestamp);
 $cure = rand(0,1);
 if($cure==0)
 {
	 
 }
//Print it out.
echo $randomDate."<br/>";
echo $caseId."<br/>";
echo $usrId."<br/>";
echo $disId."<br/>";

}


}
?>