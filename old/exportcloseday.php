<?php
  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=Closingreport.xls");
  header("Pragma: no-cache");
  header("Expires: 0"); 
  echo $_REQUEST['hiddenExportText'];  
?>