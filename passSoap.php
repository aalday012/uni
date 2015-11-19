<?php
  require_once('lib/nusoap.php');
  require_once('lib/class.wsdlcache.php');
  
  $ns="http://localhost/wsp/wsp/ikasleak";
  $server = new soap_server;
  $server->configureWSDL('egiaztatuPass',$ns);
  $server->wsdl->schemaTargetNameespace=$ns;
  
  $server->register('egiaztatuPass', array('x'=>'xsd:string','y'=>'xsd:string'), array('z'=>'xsd:string'), $ns);
  
  function egiaztatuPass($x,$y){
     if($x!=$y){
      return "baliogabea";
     }
     $fp = fopen("toppasswords.txt", "r");
     while(!feof($fp)) {
	$lerroa = chop(fgets($fp));
	if($x==$lerroa){
	  break;
	}
     }
     if(!feof($fp)){
      fclose($fp);
      return "baliogabea";
     }else{
     fclose($fp);
     return "balioduna";
     }
  }
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>