<?php
// app_resource_form, app_resource_name, app_resource_type, app_resource_meterial, app_resource_rate, app_resource_use
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

  if (isset($data['resource_name']) && isset($data['resource_type']) && isset($data['resource_material_max']) && isset($data['resource_rate']) && isset($data['resource_ovt']) && isset($data['resource_use'])){

    /*********** create new task *****************/
    // we recived the valid data open the db connection and add the task
    // Create connection
    $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    $dataname = test_input($data['resource_name']);
    $datatype = test_input($data['resource_type']);
    $datameterialmax = test_input($data['resource_material_max']);
    $datarate = test_input($data['resource_rate']);
    $dataovt = test_input($data['resource_ovt']);
    $datause = test_input($data['resource_use']);

    $newrate = $datarate . '';
    $totalCost = 0;


    // get the current resources  check if no task avail
    $check_empty_r = "SELECT COUNT(*) AS count FROM `material`";
    $empty_r = $db->query($check_empty_r);
    $len_r = $empty_r->fetch_assoc()['count'];


    $check_empty_task = "SELECT COUNT(*) AS count FROM `tasks`";
    $empty_task = $db->query($check_empty_task);
    $len_task = $empty_task->fetch_assoc()['count'];
    if ($len_task < 1){
      $res_data = new stdClass();
      $res_data->code = 422;
      $res_data->message = 'You have no tasks Please create a task first thank you.';
      echo json_encode($res_data, true);
      die();
    }
    if ($len_task <= $len_r){
      $res_data = new stdClass();
      $res_data->code = 400;
      $res_data->message = 'You need To create New task for this resources, You resources count equal or less than to tasks';
      echo json_encode($res_data, true);
      die();
    }


    // get last task id (ALL Resources Will Be added to the last Task )
    $last_task_sql = "SELECT `id`, `taskname`, `duration`, `start`, `finish` FROM `tasks` ORDER BY id DESC LIMIT 1";
    $task_result = $db->query($last_task_sql);
    if ($task_result->num_rows < 0) {
      $res_data = new stdClass();
      $res_data->code = 422;
      $res_data->message = 'Could Not get the task';
      echo json_encode($res_data, true);
      die();
    }

    $task_data = $task_result->fetch_assoc();

    $last_taskid = $task_data['id'];
    $task_n = $task_data['taskname'];
    $task_d = $task_data['duration'];
    $task_s = $task_data['start'];
    $task_f = $task_data['finish'];


    // Check connection
    if ($db->connect_error) {
      $res_data = new stdClass();
      $res_data->message = $db->connect_error;
      echo json_encode($res_data, true);
      die("Connection failed: " . $db->connect_error);
    }

    if ($datatype === 'work') {
      $newrate = $datarate . '$/hr';
      // calac total cost if work
      $totalCost = ($datameterialmax * (8 * $datarate)) / 100;
      $totalCost *=  intval($task_d);

    } else if ($datatype === 'cost'){
      $newrate = $datarate . '$';
      $totalCost = $datarate;
      // if you need multiply resource cost * duration in case cost type uncommnet line blue
      // $totalCost *=  intval($task_d);

    } else if ($datatype === 'meterial'){
      $newrate = $datarate . '$';
      $totalCost = $datarate;
      // if you need multiply resource cost * duration in case meterial type uncommnet line blue
      // $totalCost *=  intval($task_d);
    } else {
      $res_data = new stdClass();
      $res_data->code = 400;
      $res_data->message = 'Invalid value for type input Select one of this types, work, cost, meterial';
      echo json_encode($res_data, true);
      die();
    }


    // prepare and bind
    $stmt = $db->prepare("INSERT INTO `material`(`resource_name`, `type`, `material_max`, `st_rate`, `ovt`, `cost`, `task_id`) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt===false){
      $res_data = new stdClass();
      $res_data->code = 400;
      $res_data->message = 'Could not Cretae Resource with name ' . $dataname . ' Select valid valus';
      $res_data->error = 'Error in bind_param resource: ' . htmlspecialchars($db->error);
      echo json_encode($res_data, true);
      die();
    }

    $rc = $stmt->bind_param("ssssiii", $dataname, $datatype, $datameterialmax, $newrate, $dataovt, $totalCost, $last_taskid);
    if ($rc===false){
      $res_data = new stdClass();
      $res_data->code = 422;
      $res_data->message = htmlspecialchars($stmt->error);
      $res_data->error = 'Error in bind_param resource: ' . htmlspecialchars($stmt->error);
      echo json_encode($res_data, true);
      die();
    }

    // set parameters and execute
    $dataname = $dataname;
    $datameterialmax = $datameterialmax;
    $datatype = $datatype;
    $newrate = $newrate;
    $dataovt = $dataovt;
    $totalCost = $totalCost;
    $last_taskid = $last_taskid;

    $rc = $stmt->execute();


    // check if the query executed
    if ($stmt===false){
      $res_data = new stdClass();
      $res_data->code = 400;
      $res_data->message = 'Could Not Add resource with name ' . $dataname . 'To The database';
      $res_data->error = htmlspecialchars($stmt->error);
      echo json_encode($res_data, true);
      die();
    }





    /* 2222222222222222 **/
    // set parameters and execute


    $stmt = $db->prepare("INSERT INTO `allocate_resources`(`task_name`, `duration`, `start`, `finish`, `resource_name`) VALUES (?, ?, ?, ?, ?)");
    if ($stmt===false){
      $res_data = new stdClass();
      $res_data->code = 400;
      $res_data->message = 'Could not Cretae Resource with name ' . $dataname . ' Select valid valus';
      $res_data->error = 'Error in bind_param resource: ' . htmlspecialchars($db->error);
      echo json_encode($res_data, true);
      die();
    }

    $rc = $stmt->bind_param("sssss", $tname, $td, $ts, $tf, $rn);
    if ($rc===false){
      $res_data = new stdClass();
      $res_data->code = 422;
      $res_data->message = htmlspecialchars($stmt->error);
      $res_data->error = 'Error in bind_param resource: ' . htmlspecialchars($stmt->error);
      echo json_encode($res_data, true);
      die();
    }

    // set parameters and execute
    $tname = $task_n;
    $td = $task_d;
    $ts = $task_s;
    $tf = $task_f;
    $rn = $dataname;


    $rc = $stmt->execute();


    // check if the query executed
    if ($stmt===false){
      $res_data = new stdClass();
      $res_data->code = 400;
      $res_data->message = 'Could Not Add resource with name ' . $dataname . 'To The database';
      $res_data->error = htmlspecialchars($stmt->error);
      echo json_encode($res_data, true);
      die();
    }


    /* 22222222222222 **/



    // if all required inputs recived return 200 Ok and data added to database

    $res_data = new stdClass();
    $res_data->code = 200;
    $res_data->message =  'Successfully created a new resource registry for task:' . $task_n . ' at a cost of: $' . $totalCost . ', Task Duration: ' . $task_d;
    echo json_encode($res_data, true);
    die();

  }

  $res_data = new stdClass();
  $res_data->code = 400;
  $res_data->message = 'Missing Required Input';
  echo json_encode($res_data, true);
  die();
}

?>
