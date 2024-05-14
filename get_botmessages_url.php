<?php
include('database.ins.php');
$postData = file_get_contents("php://input");
$data = json_decode($postData, true);
if (isset($data['text'])) {
    $msg = mysqli_real_escape_string($con, $data['text']);
    $sql="SELECT reply FROM chatbot_hints WHERE question LIKE '%$msg%' LIMIT 0, 25";
    $res=mysqli_query($con,$sql);
 if(mysqli_num_rows($res) > 0){
    $row = mysqli_fetch_assoc($res);
    echo $row['reply'];
 }else{
    echo "Sorry Not be able to understand you";
 }
} else {
    // Handle the case where 'text' data is not received
    echo "Error: Message data not received";
}
?>
