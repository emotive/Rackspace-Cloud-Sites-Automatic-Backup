<?php	
 require("php-cloudfiles-1.3.0/cloudfiles.php");
 
 $backupsToKeep = 5; // # of backup files to keep
 
 $username = 'RACKSPACELOGIN';
 $apiKey = 'APIKEY';
 $containerToUse = 'CLOUDCONTAINERNAME'; 
 $baseDir = 'YOURSITEPATH/backup/';
 
 $auth = new CF_Authentication($username, $apiKey);
 $auth->authenticate();
 $conn = new CF_Connection($auth);
 $container = $conn->get_container($containerToUse);
 
 function cleanup($prefix) {
   	global $container, $backupsToKeep;
   	$list = $container->list_objects(0,NULL,$prefix);
   	sort($list);
   	$del_list = array_slice($list,0,-($backupsToKeep-1));
 	foreach($del_list as $file) {
   		$container->delete_object($file);
   		echo $file.' deleted - ';
   	}
 }
   	
 function copytocloud($file, $objName) {
   	global $container, $baseDir;
   	$object = $container->create_object($objName);
   	$result = $object->load_from_filename($baseDir.$file);
   	echo $object.' copied - ';
 }
   	
 cleanup('db_backup');
 cleanup('web_backup');
 copytocloud('db_backup.sql.gz','db_backup_'.date('Y-m-d_His').'.sql.gz');
 copytocloud('web_backup.tgz','web_backup_'.date('Y-m-d_His').'.tgz');
 
 echo 'Transfer Complete!';
 ?>