<?php 
include('include/dbquery.php');
$dbquery = new DbQuery();
$dbquery->htmlDecode($_POST);
$posts = $dbquery->posts;
if(isset($posts['insert'])){ 
        $a= array("#f56954", "#f39c12", "#0073b7", "#00c0ef", "#00a65a", '#3c8dbc','black','red','blue');
        $title = $posts['title'];
        $start = $posts['start'];
        $end = $posts['end'];
        $color = $posts['color'];
        /*if(!isset($posts['color'])){
        $color = $a[mt_rand(0, count($a) - 1)];
        }
        else{
            $color = $posts['color'];
        /*}*/
        $data = [
            'title' => $title,
            'start_event' => $start,
            'end_event' => $end,
            'color' => $color
            ];

        $tableName = 'events';
        $dbquery->save($data,$tableName);
        echo $dbquery->result;
    }
    if(isset($posts['update'])){ 
        $id = $posts['id']; 
        $title = $posts['title'];
        $start = $posts['start'];
        $end = $posts['end'];
        if (isset($posts['color'])) {
            $color = $posts['color'];      
            $data = [
            'title' => $title,
            'start_event' => $start,
            'end_event' => $end,
            'color' => $color
            ];
        }
        else{
            $data = [
            'title' => $title,
            'start_event' => $start,
            'end_event' => $end
            ];
        }
        $tableName = 'events';
        $dbquery->update($id,$data,$tableName);
        echo $dbquery->result;            
        }
    if(isset($posts['delete'])){ //delete post with post id
            $id = $posts['id'];
            $dbquery->destroy($id,'events');
            echo $dbquery->result;
        }
    if(isset($posts['event'])){
        $title = $posts['title'];
        $color = $posts['color'];
        $data = [
            'title' => $title,
            'color' => $color
            ];

        $tableName = 'easy_events';
        $dbquery->save($data,$tableName);
        $data = $dbquery->last_id;
        echo $data;
    }
    if(isset($posts['delete_event'])){ //delete post with post id
        $id = $posts['id'];
        $dbquery->destroy($id,'easy_events');
        echo $dbquery->result;
    }
?>