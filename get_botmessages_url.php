<?php
include('database.ins.php');

// Get the raw POST data
$postData = file_get_contents("php://input");

// Decode the JSON data
$data = json_decode($postData, true);

// Check if 'text' data is received
if (isset($data['text'])) {
    // Retrieve and sanitize the message
    $msg = mysqli_real_escape_string($con, $data['text']);
    // $sql="select reply from chatbot_hints where question like % $msg % ";
    $sql="SELECT reply FROM chatbot_hints WHERE question LIKE '%$msg%' LIMIT 0, 25";
    $res=mysqli_query($con,$sql);
 if(mysqli_num_rows($res) > 0){


    $row = mysqli_fetch_assoc($res);
    echo $row['reply'];
    //  print_r($res);
     exit;
 }else{
    echo "Sorry Not be able to understand you";
 }
    
    // Process the message or perform database operations
    // For example, you can echo or return some response
    echo "Received message: " . $msg;
} else {
    // Handle the case where 'text' data is not received
    echo "Error: Message data not received";
}
?>
