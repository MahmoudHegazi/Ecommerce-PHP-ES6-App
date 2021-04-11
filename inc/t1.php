<?php
include "../config.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
   }

  if (isset($data['taskname']) && isset($data['duration']) && isset($data['start_date']) && isset($data['finish_date'])){

    /*********** create new task *****************/
    // we recived the valid data open the db connection and add the task
    // Create connection
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

    // Check connection
    if ($db->connect_error) {
      $res_data = new stdClass();
      $res_data->message = $db->connect_error;
      echo json_encode($res_data, true);
      die("Connection failed: " . $db->connect_error);
    }



    // prepare and bind
    $stmt = $db->prepare("INSERT INTO `tasks` (`taskname`, `duration`, `start`, `finish`) VALUES (?, ?, ?, ?)");
    if ($stmt===false){
      $res_data = new stdClass();
      $res_data->message = htmlspecialchars($db->error);
      echo json_encode($res_data, true);
      die("prepare failed: " . htmlspecialchars($db->error));
    }

    $rc = $stmt->bind_param("ssss", $task_name, $duration, $start_date, $finish_date);
    if ($rc===false){
      $res_data = new stdClass();
      $res_data->message = htmlspecialchars($stmt->error);
      echo json_encode($res_data, true);
      die("bind_param failed: " . htmlspecialchars($stmt->error));
    }

    // set parameters and execute
    $task_name = test_input($data['taskname']);
    $duration = test_input($data['duration']);
    $start_date = test_input($data['start_date']);
    $finish_date = test_input($data['finish_date']);

    $rc = $stmt->execute();


    // check if the query executed
    if ($stmt===false){

      $server_res = Array('code'=>422, 'message'=>htmlspecialchars($stmt->error));
      $res_data = new stdClass();
      $res_data->message = htmlspecialchars($stmt->error);
      echo json_encode($res_data, true);
      die("execute failed: " . htmlspecialchars($stmt->error));
    }


    // if no errors and task created return success

    $res_data = new stdClass();
    $res_data->code = 200;
    $res_data->message = 'Task Created! With name: ' . $task_name;
    echo json_encode($res_data, true);
    $db->close();
    die();

  } else {
    $res_data = new stdClass();
    $res_data->code = 400;
    $res_data->message = 'Missing required input';
    echo json_encode($res_data, true);
    die();
  }

}
//$x = json_decode($_POST[0], true);
//echo json_encode($x);


?>
