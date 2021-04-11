<?php
include "config.php";
include "header.php";
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
include "inc\allocate.php";
?>


<div class="mymain grid_part">

  <p class="table_count_title"><?php $getcounts =  echo_allocate_count($db); ?></p>
  <hr class="the_hr">


 <!-- task table -->

   <!-- task table -->
     <?php render_allocate_table($db); ?>
     <hr class="the_hr">
   <!-- task table end -->

</div>

<?php include "footer.php"; ?>
