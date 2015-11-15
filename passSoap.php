<?php
  require_once('lib/nusoap.php');
  require_once('lib/class.wsdlcache.php');
  
  $ns="http://localhost/wsp/wsp/ikasleak";
  $server = new soap_server;
  $server->configureWSDL('egiaztatuPass',$ns);
  $server->wsdl->schemaTargetNameespace=$ns;
  
  $server->register('egiaztatuPass', array('x'=>'xsd:string'), array('y'=>'xsd:string'), $ns);
  
  function egiaztatuPass($x){
     $fp = fopen("toppasswords.txt", "r");
     while(!feof($fp)) {
	$lerroa = chop(fgets($fp));
	if($x==$lerroa){
	  break;
	}
     }
     if(!feof($fp)){
      fclose($fp);
      return "pasahitz baliogabea";
     }else{
     fclose($fp);
     return "pasahitz balioduna";
     }
  }
  
  $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
  $server->service($HTTP_RAW_POST_DATA);
?>