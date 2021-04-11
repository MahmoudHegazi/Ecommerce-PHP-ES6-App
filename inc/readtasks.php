<?php
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}


require(realpath('functions.php'));


// this function get the tasks count and echo the message and control render table
function echo_tasks_count($db){
$check_empty_task = "SELECT COUNT(*) AS count FROM `tasks`";
$empty_task = $db->query($check_empty_task);
$len_task = $empty_task->fetch_assoc()['count'];
if ($len_task > 1){
  $taskortasks = ($len_task == 1) ? " Task." : " Tasks.";
  echo 'Found: ' . $len_task . $taskortasks;
  return true;
} else {
  echo 'Found: ' . $len_task . $taskortasks;
  return false;
}
}



function render_tasks_table($db){

  $sql = "SELECT * FROM `tasks` ORDER BY id DESC";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {

         // output main table data
         // Code for Download excel
         $sheet_data=array();
         $rowhead = ['taskName' => 'string','duration (days)' => 'string', 'start' => 'date', 'finish' => 'date'];

      $html_data = '<button id="excel_tasks_download" class="excelbtn" data-task="1" data-table="tasks" >Download Excel Report</button>
                   <table id="tasks_table" class="styled_table table1" data-table="tasks" >
                     <tr data-table="tasks">
                       <th data-table="tasks" class="tasks_taskname">Task Name</th>
                       <th data-table="tasks" class="tasks_duration">Duration (Days)</th>
                       <th data-table="tasks" class="tasks_start">Start Date</th>
                       <th data-table="tasks" class="tasks_finish">Finish Date</th>
                     </tr>
                     <tr>';
         // output data of each row
         while($row = $result->fetch_assoc()) {
           $html_data .= '<tr data-table="tasks" class="datarow" data-row-id="' . $row["id"] .'">';
           $html_data .= '<td data-table="tasks" class="tasks_taskname" >'. $row["taskname"] .'</td>';
           $html_data .= '<td data-table="tasks" class="tasks_duration" >'. $row["duration"] .' days</td>';
           $html_data .= '<td data-table="tasks" class="tasks_start" >'. $row["start"] .'</td>';
           $html_data .= '<td data-table="tasks" class="tasks_finish" >'. $row["finish"] .'</td></tr>';
         }

         $html_data .= '</table>';
         echo $html_data;
  } else {
         echo "0 results";
  }
  $db->close();

}
?>
