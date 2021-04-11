<!DOCTYPE html>
<html>
<head>
<title>Page Title</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/css/style.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="utf-8">
</head>
<body>
  <div class="main">
    <div class="head grid_part">
      <p>
      <?php
         // get current page title
         $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
         switch ($curPageName) {
           case "index.php":
             echo "Home";
             break;
            case "tasks_read.php":
              echo "Tasks";
              break;
            case "cost_read.php":
              echo "Material Cost";
              break;
            case "allocate_read.php":
              echo "Allocate resources";
              break;
              case "cost_pertask.php":
                echo "Total Cost Per Task";
                break;
            case "totalproject_cost.php":
              echo "Total Cost Per Project";
              break;
            default:
              echo "App Page";
            }
      ?>
      </p>
    </div>
    <div class="aside grid_part">
      <div class="nav_main">
        <div class="nav_link"><a href="index.php">Home</a></div>
        <div class="nav_link"><a href="tasks_read.php">Tasks</a></div>
        <div class="nav_link"><a href="cost_read.php">Material Cost</a></div>
        <div class="nav_link"><a href="allocate_read.php">Allocate resources</a></div>
        <div class="nav_link"><a href="cost_pertask.php">TotalCost Per Task</a></div>
        <div class="nav_link"><a href="totalproject_cost.php">Project Cost</a></div>

      </div>
    </div>
