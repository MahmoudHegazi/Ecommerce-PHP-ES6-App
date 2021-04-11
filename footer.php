<div class="foot grid_part">

     <a href="#" class="fa fa-facebook"></a>
     <a href="#" class="fa fa-twitter"></a>
     <a href="#" class="fa fa-instagram"></a>

</div>
</div>

<?php $curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1); if ($curPageName == 'index.php') { ?>
<script src="assets/js/tasks.js"></script>
<script src="assets/js/cost.js"></script>
<?php } else { ?>
<script src="assets/js/excel.js"></script>
<script src="assets\js\table_plugin.js"></script>

<?php } ?>
</body>
</html>
