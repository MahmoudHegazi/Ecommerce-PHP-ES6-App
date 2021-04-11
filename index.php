<?php
include "config.php";
// Create connection
$db = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}
include "header.php";
?>


<div class="mymain grid_part">
  <div class="alert" id="notifcation"><span class="messagespan" id="message0"></span><span class="close_notification" id="close1">x</span></div>

  <!-- form to create tasks  AJAX-->
  <div class="form_title lightgray">Create New Task</div>
  <form class="task_form" id="task_formid">
    <label class="form_label">Task Name</label>
    <input type="text" value="x" id="taskname" name="taskname" placeholder="enter task name" required="required" />
    <label class="form_label">duration</label>
    <input type="number" value="5"  id="duration" min="1" name="duration" placeholder="enter task duration" required="required" />
    <div>
    <label class="form_label">Start Date</label>
    <input type="date" value="2021-12-02" name="start_date" id="start_date"  required="required" />
    </div>
    <div>
    <label class="form_label">Finish Date</label>
    <input type="date" value="2021-12-06"  name="finish_date" id="finish_date" readonly   required="required" />
    </div>
    <input type="submit" value="Create Task" />
  </form>

 <!-- task form end -->
 <hr class="the_hr">
  <div class="alert" id="notifcation1"><span class="messagespan" id="message1"></span><span class="close_notification1" id="close2">x</span></div>
     <!-- form to create tasks -->
  <div class="form_title">Create New Resource</div>
  <form class="resource_form" id="resource_formid">
    <label for="resource_name">Resource Name</label>
    <input type="text" id="resource_name" name="resource_name" value="resource test" placeholder="enter Resource Name" required="required" />
    <label for="type">Type</label>
    <select id="type" name="type" required="required">
      <option name="type" value="work" checked="checked">Work</option>
      <option name="type" value="cost">Cost</option>
      <option name="type" value="meterial">Meterial</option>
    </select>
    <label for="meterial">Meterial Max</label>
    <input type="number" placeholder="enter Meterial"  min="0" max="100" value="100" required="required" name="meterial" id="meterial" />
    <label for="st_rate">St.Rate</label>
    <input type="number" placeholder="enter St.Rate" value="15" name="st_rate" id="st_rate" required="required" />
    <label for="ovt">OVT.</label>
    <input type="number" placeholder="enter OVT" value="" name="ovt" id="ovt"  />
    <label for="cost">Cost/Use</label>
    <input type="number" placeholder="enter Cost/Use" value="name=" id="cost" />
    <input type="submit" value="Create Task" />
  </form>
</div>

<?php include "footer.php"; ?>
