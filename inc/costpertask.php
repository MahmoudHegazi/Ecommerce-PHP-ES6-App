<?php
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}


require(realpath('functions.php'));

// this function get the tasks count and echo the message and control render table
function echo_totalpertask_count($db){
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



function render_totalpertask_table($db){

  $sql = "SELECT tasks.id, tasks.taskname, tasks.duration, tasks.start, tasks.finish, material.resource_name, material.cost FROM `tasks` JOIN `material` ON tasks.id = material.task_id  ORDER BY tasks.id DESC";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {


     // Code for Download excel
     $sheet_data=array();
     $rowhead = ['taskId' => 'string','taskName' => 'string', 'duration' => 'string', 'Start' => 'date', 'finish' => 'date', 'resourceName' => 'string', 'TotalCost'  => 'money'];


     // output main table data

      $html_data = '<button id="excel_costpertask_download" class="excelbtn" data-task="3">Download Excel Report</button>
                   <table data-table="costpertask" id="costspertask_table" class="styled_table table4">
                     <tr data-table="costpertask" >
                       <th data-table="costpertask" class="costpertask_id" >Task ID</th>
                       <th data-table="costpertask" class="costpertask_taskname" >Task Name</th>
                       <th data-table="costpertask" class="costpertask_duration" >duration</th>
                       <th data-table="costpertask" class="costpertask_start" >Start Date</th>
                       <th data-table="costpertask" class="costpertask_finish" >Finish Date</th>
                       <th data-table="costpertask" class="costpertask_resource_name">Resource Name</th>
                       <th data-table="costpertask" class="costpertask_cost" >Total Cost</th>
                     </tr>
                     <tr>';
         // output data of each row
         while($row = $result->fetch_assoc()) {
           $html_data .= '<tr data-table="costpertask" class="datarow" data-row-id="' . $row["id"] .'">';
           $html_data .= '<td data-table="costpertask" class="costpertask_id">' . $row["id"] .'</td>';
           $html_data .= '<td data-table="costpertask" class="costpertask_taskname">'. $row["taskname"] .'</td>';
           $html_data .= '<td data-table="costpertask" class="costpertask_duration">'. $row["duration"] .' days</td>';
           $html_data .= '<td data-table="costpertask" class="costpertask_start">'. $row["start"] .'</td>';
           $html_data .= '<td data-table="costpertask" class="costpertask_finish">'. $row["finish"] .'</td>';
           $html_data .= '<td data-table="costpertask" class="costpertask_resource_name">'. $row["resource_name"] .'</td>';
           $html_data .= '<td data-table="costpertask" class="costpertask_cost">$'. $row["cost"] .'</td></tr>';
           // this step for download excel function
           $sheet_row = array();
           array_push($sheet_row, $row["id"], $row["taskname"], $row["duration"], $row["start"], $row["finish"], $row["resource_name"], $row["cost"]);
           array_push($sheet_data, $sheet_row);
         }

         $html_data .= '</table>';
         //generate_excel($sheet_data, $rowhead, 'excel_sheets\\CostsPerTask\\');
         echo $html_data;
  } else {
         echo "0 results";
  }
  $db->close();

}
?>
