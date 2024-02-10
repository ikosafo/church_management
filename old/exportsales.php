<?php
  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=Salesreport.xls");
  header("Pragma: no-cache");
  header("Expires: 0"); 
  echo $_REQUEST['hiddenExportText'];  
?>