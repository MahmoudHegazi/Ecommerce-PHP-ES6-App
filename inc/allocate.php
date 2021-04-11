<?php
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// this function get the tasks count and echo the message and control render table
function echo_allocate_count($db){
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



function render_allocate_table($db){

  $sql = "SELECT * FROM `allocate_resources` ORDER BY id DESC";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {

         // output main table data

      $html_data = '<button id="excel_allocate_download" class="excelbtn" data-task="4" data-table="allocate" >Download Excel Report</button>
                   <table id="allocate_table" class="styled_table table2" data-table="allocate" >
                     <tr >
                       <th data-table="allocate" class="taskname_allocate" >Task Name</th>
                       <th data-table="allocate" class="duration_allocate" >duration</th>
                       <th data-table="allocate" class="start_allocate" >Start Date</th>
                       <th data-table="allocate" class="finish_allocate" >Finish Date</th>
                       <th data-table="allocate" class="resource_allocate" >Resource Name</th>
                     </tr>
                     <tr>';
         // output data of each row
         while($row = $result->fetch_assoc()) {
           $html_data .= '<tr class="datarow" data-table="allocate" data-row-id="' . $row["id"] .'">';
           $html_data .= '<td class="taskname_allocate" data-table="allocate" >' . $row["task_name"] .'</td>';
           $html_data .= '<td class="duration_allocate" data-table="allocate" >'. $row["duration"] .' days</td>';
           $html_data .= '<td class="start_allocate" data-table="allocate" >'. $row["start"] .'</td>';
           $html_data .= '<td class="finish_allocate" data-table="allocate" >'. $row["finish"] .'</td>';
           $html_data .= '<td class="resource_allocate" data-table="allocate" >'. $row["resource_name"] .'</td></tr>';
         }

         $html_data .= '</table>';
         echo $html_data;
  } else {
         echo "0 results";
  }
  $db->close();

}
?>
