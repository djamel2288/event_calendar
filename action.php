<?php 
include('include/dbquery.php');
$dbquery = new DbQuery();
$dbquery->htmlDecode($_POST);
$posts = $dbquery->posts;
$dbquery->getall('events');
while($row = $dbquery->result->fetch_assoc()){

$data[] = array(
        'id'   => $row["id"],
        'title'   => $row["title"],
        'start'   => $row["start_event"],
        'end'   => $row["end_event"],
        'backgroundColor' => $row["color"],
        'borderColor' => $row["color"],
        'textColor' => 'white'
       );
}

echo json_encode($data);
?>