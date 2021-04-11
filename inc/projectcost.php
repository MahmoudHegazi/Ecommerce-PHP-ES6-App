<?php
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}


require(realpath('functions.php'));

// this function get the tasks count and echo the message and control render table
function echo_totalproject_count($db){
$check_empty_task = "SELECT COUNT(*) AS count FROM `allocate_resources`";
$empty_task = $db->query($check_empty_task);
$len_task = $empty_task->fetch_assoc()['count'];
if ($len_task > 1){
  $taskortasks = ($len_task == 1) ? " Recored In The allocate resources table" : " Recoreds allocate resources table.";
  echo 'Found: ' . $len_task . $taskortasks;
  return true;
} else {
  echo 'Found: ' . $len_task . $taskortasks;
  return false;
}
}



function render_totalproject_table($db){

  $sql = "SELECT tasks.id, tasks.taskname, tasks.duration, tasks.start, tasks.finish, material.resource_name, material.cost FROM `tasks` JOIN `material` ON tasks.id = material.task_id ORDER BY tasks.id DESC";
  $result = $db->query($sql);

  $sql2 = "SELECT sum(cost) FROM material";
  $resul2 = $db->query($sql2);
  if ($result->num_rows > 0) {


     // Code for Download excel
     $sheet_data=array();
     $rowhead = ['taskId' => 'string','taskName' => 'string', 'duration' => 'string', 'Start' => 'date', 'finish' => 'date', 'resourceName' => 'string', 'TotalCost'  => 'money'];


     // output main table data

     // get sum cost fast
     $totalcostProject = $resul2->fetch_assoc()['sum(cost)'];

      $html_data = '<p>Total Project Cost: '.$totalcostProject. ' <br /><br /><button id="excel_total_download" class="excelbtn" data-task="5">Download Excel Report</button>
                   <table data-table="totalproject" id="totalproject_table" class="styled_table table5">
                     <tr data-table="totalproject" >
                       <th data-table="totalproject" class="totalproject_id" >Task ID</th>
                       <th data-table="totalproject" class="totalproject_taskname" >Task Name</th>
                       <th data-table="totalproject" class="totalproject_duration" >duration</th>
                       <th data-table="totalproject" class="totalproject_start" >Start Date</th>
                       <th data-table="totalproject" class="totalproject_finish" >Finish Date</th>
                       <th data-table="totalproject" class="totalproject_resource_name">Resource Name</th>
                       <th data-table="totalproject" class="totalproject_cost" >Total Cost</th>
                     </tr>
                     <tr>';
         // output data of each row


         while($row = $result->fetch_assoc()) {

           $html_data .= '<tr data-table="totalproject" class="datarow" data-row-id="' . $row["id"] .'">';
           $html_data .= '<td data-table="totalproject" class="totalproject_id">' . $row["id"] .'</td>';
           $html_data .= '<td data-table="totalproject" class="totalproject_taskname">'. $row["taskname"] .'</td>';
           $html_data .= '<td data-table="totalproject" class="totalproject_duration">'. $row["duration"] .' days</td>';
           $html_data .= '<td data-table="totalproject" class="totalproject_start">'. $row["start"] .'</td>';
           $html_data .= '<td data-table="totalproject" class="totalproject_finish">'. $row["finish"] .'</td>';
           $html_data .= '<td data-table="totalproject" class="totalproject_resource_name">'. $row["resource_name"] .'</td>';
           $html_data .= '<td data-table="totalproject" class="totalproject_cost">$'. $row["cost"] .'</td></tr>';
           // this step for download excel function
           $sheet_row = array();
           array_push($sheet_row, $row["id"], $row["taskname"], $row["duration"], $row["start"], $row["finish"], $row["resource_name"], $row["cost"]);
           array_push($sheet_data, $sheet_row);

         }
         $single = array();
         array_push($single, 'TotalCods', $totalcostProject);
         array_push($sheet_data, $single);

         $html_data .= '<tr><td>Project Total Cost</td><td></td><td></td><td></td><td></td><td></td><td>'.  $totalcostProject .'</td></tr></table>';
         //generate_excel($sheet_data, $rowhead, 'excel_sheets\\CostsPerTask\\');
         echo $html_data;
  } else {
         echo "0 results";
  }
  $db->close();

}
?>
