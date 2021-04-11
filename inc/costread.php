<?php
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

require(realpath('functions.php'));

// this function get the tasks count and echo the message and control render table
function echo_material_count($db){
$check_empty_task = "SELECT COUNT(*) AS count FROM `material`";
$empty_task = $db->query($check_empty_task);
$len_task = $empty_task->fetch_assoc()['count'];
if ($len_task > 1){
  $taskortasks = ($len_task == 1) ? " Resource Recored." : " Resources Recoreds.";
  echo 'Found: ' . $len_task . $taskortasks;
  return true;
} else {
  echo 'Found: ' . $len_task . $taskortasks;
  return false;
}
}



function render_cost_table($db){

  // Code for Download excel
  $sheet_data=array();
  $rowhead = ['resourceName' => 'string','type' => 'string', 'materialMax' => 'string', 'st.rate' => 'string', 'ovt' => 'string', 'cost/use' => 'string'];


  $sql = "SELECT * FROM `material` ORDER BY id DESC";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {



         // output main table data

      $html_data = '<button  id="excel_cost_download" class="excelbtn" data-task="2" data-table="cost">Download Excel Report</button>
                   <table id="cost_table" class="styled_table table3" data-table="cost">
                     <tr data-table="cost" class="cost_head_tr">
                       <th data-table="cost" class="cost_resource_name" >Resource Name</th>
                       <th data-table="cost" class="cost_type" >Type</th>
                       <th data-table="cost" class="cost_material_max" >Material Max</th>
                       <th data-table="cost" class="cost_st_rate" >St.Rate</th>
                       <th data-table="cost" class="cost_ovt" >OVT</th>
                       <th data-table="cost" class="cost_cost" >cost / use</th>
                     </tr>
                     <tr>';
         // output data of each row
         while($row = $result->fetch_assoc()) {



           $html_data .= '<tr data-table="cost" class="datarow" data-row-id="' . $row["id"] .'">';
           $html_data .= '<td data-table="cost" class="cost_resource_name" >'. $row["resource_name"] .'</td>';
           $html_data .= '<td data-table="cost" class="cost_type" >'. $row["type"] .'</td>';
           $html_data .= '<td data-table="cost" class="cost_material_max" >'. $row["material_max"] . '%</td>';
           $html_data .= '<td data-table="cost" class="cost_st_rate" >'. $row["st_rate"] . '</td>';
           $html_data .= '<td data-table="cost" class="cost_ovt" >'. $row["ovt"] .'</td>';
           $html_data .= '<td data-table="cost" class="cost_cost" >-</td></tr>';
         }

         $html_data .= '</table>';
         //generate_excel($sheet_data, $rowhead, 'excel_sheets\\Resources\\');
         echo $html_data;
  } else {
         echo "0 results";
  }
  $db->close();

}
?>
