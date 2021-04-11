<?php

include '../functions.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $data = file_get_contents('php://input');
  $data = json_decode($data, true);

if (isset($data['task'])){

   $task = intval($data['task']);


  include "../config.php";

  // Create connection
  $db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

  // Check connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

     /* download tasks  */
    if ($task == 1) {

      $sql = "SELECT * FROM `tasks` ORDER BY id DESC";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {

             // output main table data
             // Code for Download excel
             $sheet_data=array();
             $rowhead = ['taskName' => 'string','duration (days)' => 'string', 'start' => 'date', 'finish' => 'date'];

             // output data of each row
             while($row = $result->fetch_assoc()) {
               $sheet_row = array();
               array_push($sheet_row, $row["taskname"], $row["duration"], $row["start"], $row["finish"]);
               array_push($sheet_data, $sheet_row);
             }
             generate_excel($sheet_data, $rowhead, 'Tasks');
             echo json_encode('yes');
             $db->close();
             return true;
             die();
      } else {
            echo json_encode('0 Recoreds Found In Tasks, can not download file');
            $db->close();
            return false;
            die();
      }

       /* download tasks  */

    } else if ($task == 2) {

      // Code for Download excel
      $sheet_data=array();
      $rowhead = ['resourceName' => 'string','type' => 'string', 'materialMax' => 'string', 'st.rate' => 'string', 'ovt' => 'string', 'cost/use' => 'string'];


      $sql = "SELECT * FROM `material` ORDER BY id DESC";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {

             // output data of each row
             while($row = $result->fetch_assoc()) {
               $sheet_row = array();
               array_push($sheet_row, $row["resource_name"], $row["type"], $row["material_max"], $row["st_rate"], $row["ovt"], '-');
               array_push($sheet_data, $sheet_row);
             }
             generate_excel($sheet_data, $rowhead, 'Resources');
             echo json_encode('File Downloaded');
             $db->close();
             return true;
             die();
      } else {
             //echo "0 Recoreds Found In Material, can not download file";
             echo json_encode('0 Recoreds Found In Material, can not download file');
             $db->close();
             return false;
             die();
      }

       /* Material Downlaod  */

    } else if ($task == 3) {

      $sql = "SELECT tasks.id, tasks.taskname, tasks.duration, tasks.start, tasks.finish, material.resource_name, material.cost FROM `tasks` JOIN `material` ON tasks.id = material.task_id  ORDER BY tasks.id DESC";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {


         // Code for Download excel
         $sheet_data=array();
         $rowhead = ['taskId' => 'string','taskName' => 'string', 'duration' => 'string', 'Start' => 'date', 'finish' => 'date', 'resourceName' => 'string', 'TotalCost'  => 'money'];


         // output main table data
             // output data of each row
             while($row = $result->fetch_assoc()) {
               // this step for download excel function
               $sheet_row = array();
               array_push($sheet_row, $row["id"], $row["taskname"], $row["duration"], $row["start"], $row["finish"], $row["resource_name"], $row["cost"]);
               array_push($sheet_data, $sheet_row);
             }

             generate_excel($sheet_data, $rowhead, 'CostsPerTask');
             echo json_encode('File Downloaded');
             $db->close();
             return true;
             die();
      } else {
             echo json_encode('0 Recoreds Found In Allocate Resource With Cost, can not download file');
             $db->close();
             return false;
             die();
      }
       /* costpertak tasks  */

    } else if ($task == 4){

      $sql = "SELECT * FROM `allocate_resources` ORDER BY id DESC";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {


        // Code for Download excel
        $sheet_data=array();
        $rowhead = ['taskName' => 'string', 'duration' => 'string', 'Start' => 'date', 'finish' => 'date', 'resourceName' => 'string'];

             // output main table data
             // output data of each row
             while($row = $result->fetch_assoc()) {
               // this step for download excel function
               $sheet_row = array();
               array_push($sheet_row, $row["task_name"], $row["duration"], $row["start"], $row["finish"], $row["resource_name"]);
               array_push($sheet_data, $sheet_row);
             }
             generate_excel($sheet_data, $rowhead, 'Allocated');
             echo json_encode('File Downloaded');
             $db->close();
             return true;
             die();

      } else {
             echo json_encode('0 Recoreds Found In Allocated, can not download file');
             $db->close();
             return false;
             die();
      }
       /* alocate task  */
    } else {
      // default download will be tasks if any wrong
      $sql = "SELECT * FROM `tasks` ORDER BY id DESC";
      $result = $db->query($sql);
      if ($result->num_rows > 0) {

             // output main table data
             // Code for Download excel
             $sheet_data=array();
             $rowhead = ['taskName' => 'string','duration (days)' => 'string', 'start' => 'date', 'finish' => 'date'];
             // output data of each row
             while($row = $result->fetch_assoc()) {
               $html_data .= '<tr><td>'. $row["taskname"] .'</td>';
               $html_data .= '<td>'. $row["duration"] .'</td>';
               $html_data .= '<td>'. $row["start"] .'</td>';
               $html_data .= '<td>'. $row["finish"] .'</td></tr>';
               $sheet_row = array();
               array_push($sheet_row, $row["taskname"], $row["duration"], $row["start"], $row["finish"]);
               array_push($sheet_data, $sheet_row);
             }
             generate_excel($sheet_data, $rowhead, 'Tasks');
             echo json_encode('File');

             $db->close();
             return true;
             die();
      } else {
              echo json_encode('0 Recoreds Found In Tasks, can not download file');
              //echo "0 Recoreds Found In Tasks, can not download file";
              $db->close();
              return false;
              die();
      }
    }


}

};


?>
