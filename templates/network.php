<?php
  /**
  * Template Name: Network
  */



  if ( !defined('ABSPATH') )
      define('ABSPATH', dirname(__FILE__) . '/');
  require_once(ABSPATH . 'wp-config.php');


 function linspace($i,$f,$n){
      $step = ($f-$i)/($n-1);
      return range ($i,$f,$step);
 }

 function theta($data){
 	for($i=0;$i< count($data);$i++){
 		$data[$i] = $data[$i] *2*pi();
 	}
 	return $data;
 }

 function coords($theta,$div){
 	$coords = array();
 	for($i=0;$i< count($theta);$i++){
 		array_push($coords,array(cos($theta[$i])/$div,sin($theta[$i])/$div));
 	}
 	return $coords;
 }

 function tareas($mysqli,$META){
   global $wpdb;
   $prefix = $wpdb->prefix;
   $COUNT = array(0=>1,1=>1);
   $ACTOR = array();
   $SIZE = array();
   $DATA = array("type"=>"force","nodes"=>array(),"links"=>array(),"categories"=>array(array("name"=>"Actor"),array("name"=>"Tarea")));
   $query = 'SELECT wpp.post_title, wpt.name, wptt.parent FROM '.$prefix.'term_taxonomy wptt, '.$prefix.'term_relationships wptr, '.$prefix.'posts wpp, '.$prefix.'terms wpt WHERE wptt.term_taxonomy_id = wptr.term_taxonomy_id AND wptt.taxonomy = "tareas" AND wptr.object_id = wpp.ID AND wpt.term_id = wptt.term_id AND wpp.post_status = "publish" AND wpp.post_type = "actor"';
   if ($result = $mysqli->query($query)){
   	while($row = $result->fetch_assoc()){
   		if(!in_array($row["post_title"],$ACTOR)){
   			$COUNT[0]++;
   			array_push($ACTOR,$row["post_title"]);
   			array_push($DATA["nodes"],array("name"=>$row["post_title"],"node_data"=>$META["node_data"][$row["post_title"]],"symbolSize"=>10,"category"=>0,"symbol"=>"circle","itemStyle"=>array("color"=>$META["color2"][$row["post_title"]],"borderColor"=>$META["color2"][$row["post_title"]])));
   		}else{
   			$node = array_search($row["post_title"],$ACTOR);
   			$DATA["nodes"][$node]["symbolSize"] = $DATA["nodes"][$node]["symbolSize"] + 3;
   		}
   		if(!in_array($row["name"],$ACTOR)){
   			$COUNT[1]++;
   			array_push($ACTOR,$row["name"]);
   			array_push($DATA["nodes"],array("name"=>$row["name"],"symbolSize"=>10,"category"=>1,"symbol"=>$META["symbol"][$row["parent"]],"tareas"=>$META["termmeta"][$row["parent"]]));
   		}else{
   			$node = array_search($row["name"],$ACTOR);
   			$DATA["nodes"][$node]["symbolSize"] = $DATA["nodes"][$node]["symbolSize"] + 3;
   		}
   		$source = array_search($row["post_title"],$ACTOR);
   		$target = array_search($row["name"],$ACTOR);
   		array_push($DATA["links"],array("source"=>$source,"target"=>$target));
   	}
   	$coords_0 = coords(theta(linspace(0,1,$COUNT[0])),1);
   	$coords_1 = coords(theta(linspace(0,1,$COUNT[1])),2);
   	$i_0 = 0;
   	$i_1 = 0;
   	for($i=0;$i<count($DATA["nodes"]);$i++){
   		if ($DATA["nodes"][$i]["category"]==0){
   			$DATA["nodes"][$i]["x"] = $coords_0[$i_0][0];
   			$DATA["nodes"][$i]["y"] = $coords_0[$i_0][1];
   			$i_0++;
   		}else{
   			$DATA["nodes"][$i]["x"] = $coords_1[$i_1][0];
   			$DATA["nodes"][$i]["y"] = $coords_1[$i_1][1];
   			$i_1++;
   		}
   	}

   }
   return $DATA;
 }

 function territorial($mysqli,$META){
   global $wpdb;
   $prefix = $wpdb->prefix;
   $COUNT = array(0=>1,1=>1,2=>1,3=>1);
   $TAXONOMY = array("acciones_grrd"=>1,"alcance_territorial"=>2,"Regional"=>3);
   $DATA = array("name"=>"Alcance Territorial","symbolSize"=>50,"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"), "children"=> array(array("name"=>"Regional","symbolSize"=>100,"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array()),array("name"=>"Nacional","symbolSize"=>100,"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array())));
   $DATA_AUX = array();
   $query = 'SELECT wpp.post_title, GROUP_CONCAT(wpt.name) name, GROUP_CONCAT(wptt.taxonomy) taxonomy FROM '.$prefix.'term_taxonomy wptt, '.$prefix.'term_relationships wptr, '.$prefix.'posts wpp, '.$prefix.'terms wpt WHERE wpt.name NOT IN ("Regional") AND wptt.term_taxonomy_id = wptr.term_taxonomy_id AND wptt.taxonomy IN ("acciones_grrd" , "alcance_territorial") AND wptr.object_id = wpp.ID AND wpt.term_id = wptt.term_id AND wpp.post_status = "publish" AND wpp.post_type = "actor" AND wpp.ID in (SELECT wptr.object_id FROM '.$prefix.'term_relationships wptr, '.$prefix.'term_taxonomy wptt, '.$prefix.'terms wpt WHERE wpt.name = "Regional" AND wptt.taxonomy = "alcance_territorial" AND wptt.term_taxonomy_id = wptr.term_taxonomy_id AND wptt.term_id = wpt.term_id) GROUP BY wpp.ID';
	 
   if ($result = $mysqli->query($query)){
     while($row = $result->fetch_assoc()){
       $institution = $row["post_title"];
       $name = explode(",",$row["name"]);
       $taxonomy = explode(",",$row["taxonomy"]);
       $TRANSFORM = array();
       for($i=0;$i<count($name);$i++){
         $TRANSFORM[$taxonomy[$i]][] = $name[$i];
       }
       foreach($TRANSFORM["alcance_territorial"] as $region){
         foreach ($TRANSFORM["acciones_grrd"] as $accion) {
           $DATA_AUX[$region][$accion][] = $institution;
         }
       }
     }
   }
   $i = 0;
   foreach ($DATA_AUX as $region => $v1) {
     $count = 40;
     foreach ($DATA_AUX[$region] as $accion => $v2) {
       foreach ($v2 as $institution) {
         $count++;
       }
     }
     $DATA["children"][0]["children"][] = array("name"=>$region,"symbolSize"=>$count,"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array());
     $j = 0;
     foreach ($DATA_AUX[$region] as $accion => $v2) {
       $DATA["children"][0]["children"][$i]["children"][] = array("name"=>$accion,"symbolSize"=>20+count($v2),"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array());
       foreach ($v2 as $institution) {
         $DATA["children"][0]["children"][$i]["children"][$j]["children"][] = array("name"=>$institution,"node_data"=>$META["node_data"][$institution],"symbolSize"=>20,"itemStyle"=>array("color"=>$META["color2"][$institution],"borderColor"=>$META["color2"][$institution]));
       }
       $j++;
     }
     $i++;
   }
   $COUNT = array();
   $TAXONOMY = array("acciones_grrd"=>1,"alcance_territorial"=>2,"Nacional"=>3);
   $DATA_AUX = array();
   $query = 'SELECT wpp.post_title, GROUP_CONCAT(wpt.name) name, GROUP_CONCAT(wptt.taxonomy) taxonomy FROM '.$prefix.'term_taxonomy wptt, '.$prefix.'term_relationships wptr, '.$prefix.'posts wpp, '.$prefix.'terms wpt WHERE wpt.name NOT IN ("Nacional") AND wptt.term_taxonomy_id = wptr.term_taxonomy_id AND wptt.taxonomy IN ("acciones_grrd" , "alcance_territorial") AND wptr.object_id = wpp.ID AND wpt.term_id = wptt.term_id AND wpp.post_status = "publish" AND wpp.post_type = "actor" AND wpp.ID in (SELECT wptr.object_id FROM '.$prefix.'term_relationships wptr, '.$prefix.'term_taxonomy wptt, '.$prefix.'terms wpt WHERE wpt.name = "Nacional" AND wptt.taxonomy = "alcance_territorial" AND wptt.term_taxonomy_id = wptr.term_taxonomy_id AND wptt.term_id = wpt.term_id) GROUP BY wpp.ID';
   if ($result = $mysqli->query($query)){
     while($row = $result->fetch_assoc()){
       $institution = $row["post_title"];
       $name = explode(",",$row["name"]);
       $taxonomy = explode(",",$row["taxonomy"]);
       $TRANSFORM = array();
       for($i=0;$i<count($name);$i++){
         $TRANSFORM[$taxonomy[$i]][] = $name[$i];
       }
       $region = "Nacional";
       foreach ($TRANSFORM["acciones_grrd"] as $accion) {
         $DATA_AUX[$region][$accion][] = $institution;
       }

     }
   }
   foreach ($DATA_AUX as $region => $v1) {
     $count = 10;
     foreach ($DATA_AUX[$region] as $accion => $v2) {
       foreach ($v2 as $institution) {
         $count++;
       }
     }
     $j = 0;
     foreach ($DATA_AUX[$region] as $accion => $v2) {
       $DATA["children"][1]["children"][] = array("name"=>$accion,"symbolSize"=>20+count($v2),"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array());
       foreach ($v2 as $institution) {
         $DATA["children"][1]["children"][$j]["children"][] = array("name"=>$institution,"node_data"=>$META["node_data"][$institution],"symbolSize"=>20,"itemStyle"=>array("color"=>$META["color2"][$institution],"borderColor"=>$META["color2"][$institution]));
       }
       $j++;
     }
   }
   return $DATA;
 }

 function sectores($mysqli,$META){
   global $wpdb;
   $prefix = $wpdb->prefix;
   $COUNT = array(0=>1,1=>1,2=>1,3=>1);
   $TAXONOMY = array("acciones_grrd"=>1,"sector"=>2,"Sectores"=>3);
   $DATA = array("name"=>"Sector","symbolSize"=>100,"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array());
   $DATA_AUX = array();
   $query = 'SELECT wpp.post_title, GROUP_CONCAT(wpt.name) name, GROUP_CONCAT(wptt.taxonomy) taxonomy, GROUP_CONCAT(wptt.parent) parent FROM '.$prefix.'term_taxonomy wptt, '.$prefix.'term_relationships wptr, '.$prefix.'posts wpp, '.$prefix.'terms wpt WHERE wptt.term_taxonomy_id = wptr.term_taxonomy_id AND wptt.taxonomy IN ("tareas" , "sector") AND wptr.object_id = wpp.ID AND wpt.term_id = wptt.term_id AND wpp.post_status = "publish" AND wpp.post_type = "actor" GROUP BY wpp.ID';
   if ($result = $mysqli->query($query)){
     while($row = $result->fetch_assoc()){
       $institution = $row["post_title"];
       $name = explode(",",$row["name"]);
       $taxonomy = explode(",",$row["taxonomy"]);
       $parent = explode(",",$row["parent"]);
       $TRANSFORM = array();
       for($i=0;$i<count($name);$i++){
         if($taxonomy[$i] == "tareas" || ($parent[$i]==0 && $taxonomy[$i] == "sector" ) ){
           $TRANSFORM[$taxonomy[$i]][] = $name[$i];
         }
       }
       foreach($TRANSFORM["sector"] as $sector){
         foreach ($TRANSFORM["tareas"] as $accion) {
           $DATA_AUX[$sector][$accion][] = $institution;
         }
       }
     }
   }
   $i = 0;
   foreach ($DATA_AUX as $sector => $v1) {
     $count = 40;
     foreach ($DATA_AUX[$sector] as $accion => $v2) {
       foreach ($v2 as $institution) {
         $count++;
       }
     }
     $DATA["children"][] = array("name"=>$sector,"symbolSize"=>20+$count,"label"=>array("color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array());
     $j = 0;
     foreach ($DATA_AUX[$sector] as $accion => $v2) {
       $DATA["children"][$i]["children"][] = array("name"=>$accion,"symbol"=>$META["symbol2"][$accion],"symbolSize"=>20+count($v2),"label"=>array("show"=>false,"color"=>"#d17c2a","position"=>"inside","verticalAlign"=>"middle","align"=>"center"),"itemStyle"=>array("color"=>"#1a2c59","borderColor"=>"#1a2c59"),"children"=>array());
       foreach ($v2 as $institution) {
         $DATA["children"][$i]["children"][$j]["children"][] = array("name"=>$institution,"node_data"=>$META["node_data"][$institution],"symbolSize"=>20,"itemStyle"=>array("color"=>$META["color2"][$institution],"borderColor"=>$META["color2"][$institution]),"value"=>100);
       }
       $j++;
     }
     $i++;
   }
   return $DATA;
 }

 function get_meta($mysqli){
   global $wpdb;
   $prefix = $wpdb->prefix;
   $META = array('termmeta'=>array(),'node_data'=>array(),"color2"=>array(),"color"=>array("Estado"=>"#00bbee","Privados"=>"#fec035","Academia"=>"#ef4853","Organizaciones sin fines de lucro"=>"#732ad1","Otro sector"=>"#00aea5"),'symbol2'=>array(),'symbol'=>array(13=>"path://M86.60254037844386,0L173.20508075688772,50L173.20508075688772,150L86.60254037844386,200L0,150L0,50Z",14=>"triangle",15=>"rect",16=>"diamond"));
   $query = 'SELECT term_id,meta_value FROM '.$prefix.'termmeta where meta_key = "_itrend_nombre_oficial"';
   if ($result = $mysqli->query($query)){
   	while($row = $result->fetch_assoc()){
   		$META["termmeta"][$row["term_id"]] = $row["meta_value"];
   	}
   }

   $TERM_NAME = array();
   $query = 'SELECT wpt.term_id,wpt.name, wptt.parent FROM '.$prefix.'term_taxonomy wptt, '.$prefix.'terms wpt WHERE wpt.term_id = wptt.term_id';
   if ($result = $mysqli->query($query)){
   	while($row = $result->fetch_assoc()){
   		$TERM_NAME[$row["term_id"]] = array("name"=>$row["name"],"parent"=>$row["parent"]);
   	}
   }
   foreach($TERM_NAME as $term => $name){
     if ($term != 0){
       $META["symbol2"][$TERM_NAME[$term]["name"]] = $META["symbol"][$TERM_NAME[$term]["parent"]];
     }
   }

   $query = 'SELECT wpp.post_title, wpt.name FROM '.$prefix.'term_relationships wpr, '.$prefix.'posts wpp, '.$prefix.'term_taxonomy wptt, '.$prefix.'terms wpt WHERE wptt.term_id = wpt.term_id AND wpp.ID = wpr.object_id and wptt.term_taxonomy_id = wpr.term_taxonomy_id AND wpp.post_status = "publish" and wptt.taxonomy = "sector" and wptt.parent != 0';
   if ($result = $mysqli->query($query)){
   	while($row = $result->fetch_assoc()){
       if(!array_search($row["post_title"],$META["color2"])){
   		    $META["color2"][$row["post_title"]] = "#00aea5";
       }
   	}
   }

   $query = 'SELECT wpp.post_title, wpt.name FROM '.$prefix.'term_relationships wpr, '.$prefix.'posts wpp, '.$prefix.'term_taxonomy wptt, '.$prefix.'terms wpt WHERE wptt.term_id = wpt.term_id AND wpp.ID = wpr.object_id and wptt.term_taxonomy_id = wpr.term_taxonomy_id AND wpp.post_status = "publish" and wptt.taxonomy = "sector" and wptt.parent = 0';
   if ($result = $mysqli->query($query)){
   	while($row = $result->fetch_assoc()){
   		$META["color2"][$row["post_title"]] = $META["color"][$row["name"]];
   	}
   }

   $query = 'SELECT wpp.post_title, wppm.meta_key, wppm.meta_value FROM '.$prefix.'posts wpp, '.$prefix.'postmeta wppm WHERE wppm.post_id = wpp.ID AND wpp.post_status = "publish" AND wpp.post_type = "actor" AND wppm.meta_key like "_itrend%"';
   if ($result = $mysqli->query($query)){
   	while($row = $result->fetch_assoc()){
       if ($row["meta_key"] != "_itrend_contacto_correo" && $row["meta_key"] != "_itrend_contacto_telefono"){
   		    $META["node_data"][$row["post_title"]][$row["meta_key"]] = $row["meta_value"];
       }else{
           $META["node_data"][$row["post_title"]][$row["meta_key"]] = explode('"',explode(':"',$row["meta_value"])[1])[0];
       }
       $tarea = explode("_itrend_descripcion_relacion_tarea_",$row["meta_key"]);
       if (count($tarea) == 2){
         $tarea = ucfirst(str_replace("-"," ",$tarea[1]));
         $META["node_data"][$row["post_title"]]["tareas"][] = $tarea;
       }
   	}
   }
   return $META;
 }



 $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
 $mysqli->set_charset("utf8");

 $META = get_meta($mysqli);


 //~ get relations
 // $DATA = tareas($mysqli,$META);
 $TAREAS = tareas($mysqli,$META);
 $TERRITORIAL = territorial($mysqli,$META);
 $SECTORES = sectores($mysqli,$META);
  //get_header();
?>

    <style>
        div.tooltip{
          width:400px;
          white-space: pre-line;
          color: #aaa;
          font-size:16px;
        }
        .visualizer{
          height:800px;
        }
        div#data{
          background-color: #f1f1f1;
        }
        .grey-itrend{
          background-color:#f1f1f1 !important;
        }
        .blue-itrend-text{
          color:#1a2c59 !important;
          text-transform: capitalize !important;
        }
        .tabs{
          text-align: center;
        }
        #collapsible{
          position:absolute;
          right:70px;
          width:400px;
          text-align: right;
          z-index:9;
        }

        .text-grey-itrend{
          color:#999;
        }

        #collapsible li{
            list-style-type: none;
        }
        .collapsible-body{
          text-align: left;
          padding-top:5px !important;
        }

    </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    
    <h1 class="itrend-section-title">Visualización de Actores</h1>
    

    <div id="data">
      <div class="collapsible" id="collapsible">
        <li>
          <div class="collapsible-header blue-itrend-text grey-itrend" style="font-weight:bold;text-align:center;">Cómo leer el gráfico</div>
          <div class="collapsible-body grey-itrend">
            <div class="blue-itrend-text" style="border-bottom:solid 1px;border-color:1a2c59;font-size:16px;">Tareas</div>
            <div class="text-grey-itrend"><img src="<?php echo ITREND_PLUGIN_URL;?>/img/p1.png"/>Dimensión social de la resilencia</div>
            <div class="text-grey-itrend"><img src="<?php echo ITREND_PLUGIN_URL;?>/img/p2.png"/>Dimensión de la proyección para el desarrollo</div>
            <div class="text-grey-itrend"><img src="<?php echo ITREND_PLUGIN_URL;?>/img/p3.png"/>Dimensión de simulación y gestión de riesgo</div>
            <div class="text-grey-itrend"><img src="<?php echo ITREND_PLUGIN_URL;?>/img/p4.png"/>Dimensión física de las amenazas naturales y exposición</div>
            <div class="row">
              <div class="text-grey-itrend col s6" >
                <span class="blue-itrend-text" style="border-bottom:solid 1px;border-color:1a2c59;font-size:16px;">Sectores</span>
                <div><img src="<?php echo ITREND_PLUGIN_URL;?>/img/s1.png"/>Estado</div>
                <div><img src="<?php echo ITREND_PLUGIN_URL;?>/img/s2.png"/>Privado</div>
                <div><img src="<?php echo ITREND_PLUGIN_URL;?>/img/s3.png"/>Academia</div>
                <div><img src="<?php echo ITREND_PLUGIN_URL;?>/img/s4.png"/>Sociedad Civil</div>
                <div><img src="<?php echo ITREND_PLUGIN_URL;?>/img/s5.png"/>Otro</div>
              </div>
              <div class="text-grey-itrend col s6" >
                <span class="blue-itrend-text" style="border-bottom:solid 1px;border-color:1a2c59;font-size:16px;">Acciones de GRRD</span>
                <div>Prevención</div>
                <div>Respuesta</div>
                <div>Recuperación</div>
              </div>
            </div>
            <div class="blue-itrend-text" style="border-bottom:solid 1px;border-color:1a2c59;font-size:16px;">Tamaño</div>
            <div><img src="<?php echo ITREND_PLUGIN_URL;?>/img/t.png"/></div>
          </div>
        </li>
      </div>
      <div class="blue-itrend-text" style="text-align:center;font-size:16px;font-weight:bold;">Explorar por</div>
     <ul class="tabs grey-itrend">
       <li class="tab col s3"><a class="active blue-itrend-text" href="#container">Tarea</a></li>
       <li class="tab col s3"><a class="blue-itrend-text" href="#container2">Alcance Territorial</a></li>
       <li class="tab col s3"><a class="blue-itrend-text" href="#container3">Sectorial</a></li>
     </ul>
      <div id="container" class="col s12 visualizer"></div>
      <div id="container2" class="col s12 visualizer"></div>
      <div id="container3" class="col s12 visualizer"></div>
      <div id="node_data" class="modal">
        <div class="modal-content">
          <div id="titulo" style="color:#732ad1;font-size:26px;font-weight:bold;"></div>
          <div id="subtitulo" style="color:#732ad1;font-size:16px;font-weight:bold;border-bottom:solid 1px;border-color:#732ad1"></div>
          <div class="row" style="margin-top:15px;margin-bottom:15px;">
            <div id ="mision" class="col s6" style="color:#999"></div>
            <div id="contacto" class="col s6">
              <div id="url" style="color:#732ad1;font-size:14px;"></div>
              <div id="email" style="color:#732ad1;font-size:14px;"></div>
              <div id="phone" style="color:#732ad1;font-size:14px;"></div>
              <div id="street" style="color:#732ad1;font-size:14px;"></div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col s4" style="color:#732ad1;font-size:16px;font-weight:bold">Detalle Rol en GRRD</div>
            <div class="col s8" style="color:#999;font-size:16px;">
              <div id="mitigacion"></div>
              <div id="preparacion"></div>
              <div id="alerta"></div>
            </div>
          </div>
          <div class="row" style="border-bottom:solid 1px;border-color:#732ad1">
            <div class="col s4" style="color:#732ad1;font-size:16px;font-weight:bold">Tareas</div>
            <div class="col s8" style="color:#999;font-size:16px;">
              <div id="tarea1"></div>
              <div id="tarea2"></div>
              <div id="tarea3"></div>
              <div id="tarea4"></div>
              <div id="tarea5"></div>
              <div id="tarea6"></div>
              <div id="tarea7"></div>
              <div id="tarea8"></div>
              <div id="tarea9"></div>
              <div id="tarea10"></div>
              <div id="tarea11"></div>
              <div id="tarea12"></div>
              <div id="tarea13"></div>
              <div id="tarea14"></div>
            </div>
          </div>
          <div style="color:#732ad1;font-size:18px;text-align:center;">Si usted encuentra un error o requiere más información contactarse a:</div>
          <div style="color:#732ad1;font-size:18px;font-weight:bold;text-align:center;">mail@mail.com</div>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Cerrar</a>
        </div>
      </div>
			 <script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-gl/dist/echarts-gl.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts-stat/dist/ecStat.min.js"></script>
       <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/echarts/dist/extension/dataTool.min.js"></script>
       <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
       <script type="text/javascript">

          function network(data){
            var dom = document.getElementById("container");
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            myChart.showLoading();
                myChart.hideLoading();

                option = {
                    backgroundColor: "#f1f1f1",
                    textStyle: {
                      color:"#d17c2a",
                    },
                    legend: {
                        // data: ['Actor', 'Tarea']
                        data: []
                    },
            				tooltip: {
                      backgroundColor: "#ffffff",
                      position:"right",
                      borderColor: "#ddd",
                      borderWidth: "1px",
                      textStyle: {
                        color:"#333333",
                        width:"600px",
                      },
            					formatter: function (params, ticket, callback) {
            							if (params.data.tareas){
            								return params.data.tareas
            							}else{
                            if (params.data.node_data){
                              div = '<div class="tooltip"><span style="color:#732ad1;font-size:20px;font-weight:bold;">'+params.data.name+'</span>'
                              div += '<div style="color:#732ad1">'+params.data.node_data._itrend_contacto_region+'</div>'
                              div += '<div>Resumen Rol en GRRD</div>'
                              div += '<div>'+params.data.node_data._itrend_resumen_rol+'</div>'
                              div += '<div style="margin-top:10px;">Tareas:</div>'
                              div += '<ul>'
                              for(i=0;i<params.data.node_data.tareas.length;i++){
                                div += '<li>'+params.data.node_data.tareas[i]+'</li>'
                              }
                              div += '</ul>'
                              div += '<center style="color:#732ad1"><b>click para ver más</b></center>'
                              div += '<center>'+params.data.node_data._itrend_contacto_web+'</center></span>'
              								return div
                            }else{
                              return params.data.name
                            }
            							}
            					}
            				},
            				animationDuration: 1500,
            				animationEasingUpdate: 'quinticInOut',
                    series: [{
                        type: 'graph',
                        layout: 'none',
                        roam:true,
            						focusNodeAdjacency: true,
                        label: {
                            normal: {
                                position: 'right',
                                formatter: '{b}'
                            }
                        },

                        draggable: true,
                        data: data.nodes.map(function (node, idx) {
                            node.id = idx;
                            return node;
                        }),
                        categories: data.categories,
                        force: {
                            // initLayout: 'circular'
                            // repulsion: 20,
                            edgeLength: 5,
                            repulsion: 20,
                            gravity: 0.2
                        },
                        edges: data.links,
            						lineStyle: {
                                color: 'source',
                                curveness: 0.3
                            },
                        emphasis: {
                            lineStyle: {
                                width: 3
                            }
                        }
                    }]
                };

                myChart.setOption(option);

            if (option && typeof option === "object") {
                myChart.setOption(option, true);
            }

            myChart.on('click',function(params){
              if(params.data.node_data){
                $("#titulo").empty()
                $("#subtitulo").empty()
                $("#url").empty()
                $("#phone").empty()
                $("#street").empty()
                $("#email").empty()
                $("#mision").empty()
                $("#mitigacion").empty()
                $("#preparacion").empty()
                $("#alerta").empty()
                $("#tarea1").empty()
                $("#tarea2").empty()
                $("#tarea3").empty()
                $("#tarea4").empty()
                $("#tarea5").empty()
                $("#tarea6").empty()
                $("#tarea7").empty()
                $("#tarea8").empty()
                $("#tarea9").empty()
                $("#tarea10").empty()
                $("#tarea11").empty()
                $("#tarea12").empty()
                $("#tarea13").empty()
                $("#tarea14").empty()

                $("#titulo").text(params.data.node_data._itrend_codigo)
                $("#subtitulo").text(params.data.name)
                $("#url").html('<i class="fas fa-globe"></i> '+params.data.node_data._itrend_contacto_web)
                $("#phone").html('<i class="fas fa-phone"></i> '+params.data.node_data._itrend_contacto_telefono)
                $("#street").html('<i class="fas fa-map-marker"></i> '+params.data.node_data._itrend_contacto_direccion+" "+params.data.node_data._itrend_contacto_comuna)
                $("#email").html('<i class="fas fa-envelope"></i> '+params.data.node_data._itrend_contacto_correo)
                $("#mision").text(params.data.node_data._itrend_mision)
                if (params.data.node_data._itrend_descripcion_relacion_accion_mitigacion)
                  $("#mitigacion").html("<i><b>Mitigación</b></i><br>"+params.data.node_data._itrend_descripcion_relacion_accion_mitigacion+"<br><br>")
                if (params.data.node_data._itrend_descripcion_relacion_accion_alerta)
                  $("#preparacion").html("<i><b>Preparacion</b></i><br>"+params.data.node_data._itrend_descripcion_relacion_accion_alerta+"<br><br>")
                if (params.data.node_data._itrend_descripcion_relacion_accion_preparacion)
                  $("#alerta").html("<i><b>Alerta</b></i><br>"+params.data.node_data._itrend_descripcion_relacion_accion_preparacion+"<br><br>")

                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_resiliencia-social"])
                    $("#tarea1").html("<i><b>Tarea 1</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_resiliencia-social"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-impacto-social"])
                    $("#tarea2").html("<i><b>Tarea 2</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-impacto-social"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_proyectos-territoriales"])
                    $("#tarea3").html("<i><b>Tarea 3</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_proyectos-territoriales"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_politicas-para-innovacion"])
                    $("#tarea4").html("<i><b>Tarea 4</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_politicas-para-innovacion"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-y-materiales"])
                    $("#tarea5").html("<i><b>Tarea 5</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-y-materiales"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-de-la-informacion"])
                    $("#tarea6").html("<i><b>Tarea 6</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-de-la-informacion"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_escenarios-de-desastres"])
                    $("#tarea7").html("<i><b>Tarea 7</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_escenarios-de-desastres"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-de-riesgo"])
                    $("#tarea8").html("<i><b>Tarea 8</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-de-riesgo"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_entorno-construido"])
                    $("#tarea9").html("<i><b>Tarea 9</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_entorno-construido"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_comprension-de-amenazas"])
                    $("#tarea10").html("<i><b>Tarea 10</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_comprension-de-amenazas"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_monitoreo-de-amenazas"])
                    $("#tarea11").html("<i><b>Tarea 11</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_monitoreo-de-amenazas"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_mapas-de-amenaza"])
                    $("#tarea12").html("<i><b>Tarea 12</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_mapas-de-amenaza"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_alerta-temprana"])
                    $("#tarea13").html("<i><b>Tarea 13</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_alerta-temprana"]+"<br><br>")
                  if (params.data.node_data["_itrend_descripcion_relacion_tarea_continuidad-operativa"])
                    $("#tarea14").html("<i><b>Tarea 14</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_continuidad-operativa"]+"<br><br>")

                $(".modal").modal("open")
              }
            })
          }

          function tree(data,container){
            var dom = document.getElementById(container);
            var myChart = echarts.init(dom);
            var app = {};
            option = null;
            myChart.showLoading();

                myChart.hideLoading();

                myChart.setOption(option = {
                      backgroundColor: "#f1f1f1",
                      circular:{
                        rotateLabel:false,
                      },
                      tooltip: {

                          trigger: 'item',
                          triggerOn: 'mousemove',
                          backgroundColor: "#ffffff",
                          position:"right",
                          borderColor: "#ddd",
                          borderWidth: "1px",
                          textStyle: {
                            color:"#333333",
                            width:"600px",
                          },
                					formatter: function (params, ticket, callback) {
                							if (params.data.tareas){
                								return params.data.tareas
                							}else{
                                if (params.data.node_data){
                                  div = '<div class="tooltip"><span style="color:#732ad1;font-size:20px;font-weight:bold;">'+params.data.name+'</span>'
                                  div += '<div style="color:#732ad1">'+params.data.node_data._itrend_contacto_region+'</div>'
                                  div += '<div>Resumen Rol en GRRD</div>'
                                  div += '<div>'+params.data.node_data._itrend_resumen_rol+'</div>'
                                  div += '<div style="margin-top:10px;">Tareas:</div>'
                                  div += '<ul>'
                                  for(i=0;i<params.data.node_data.tareas.length;i++){
                                    div += '<li>'+params.data.node_data.tareas[i]+'</li>'
                                  }
                                  div += '</ul>'
                                  div += '<center style="color:#732ad1"><b>click para ver más</b></center>'
                                  div += '<center>'+params.data.node_data._itrend_contacto_web+'</center></span>'
                  								return div
                                }else{
                                  return params.data.name
                                }
                							}
                					}
                				},
                    series: [
                        {
                            type: 'tree',

                            data: [data],

                            top: '18%',
                            bottom: '14%',

                            layout: 'radial',

                            symbol: 'circle',
                            symbolSize: 20,

                            initialTreeDepth: 1,

                            animationDurationUpdate: 750

                        }
                    ]
                });
                myChart.on('click',function(params){
                  if(params.data.node_data){
                    $("#titulo").empty()
                    $("#subtitulo").empty()
                    $("#url").empty()
                    $("#phone").empty()
                    $("#street").empty()
                    $("#email").empty()
                    $("#mision").empty()
                    $("#mitigacion").empty()
                    $("#preparacion").empty()
                    $("#alerta").empty()
                    $("#tarea1").empty()
                    $("#tarea2").empty()
                    $("#tarea3").empty()
                    $("#tarea4").empty()
                    $("#tarea5").empty()
                    $("#tarea6").empty()
                    $("#tarea7").empty()
                    $("#tarea8").empty()
                    $("#tarea9").empty()
                    $("#tarea10").empty()
                    $("#tarea11").empty()
                    $("#tarea12").empty()
                    $("#tarea13").empty()
                    $("#tarea14").empty()

                    $("#titulo").text(params.data.node_data._itrend_codigo)
                    $("#subtitulo").text(params.data.name)
                    $("#url").html('<i class="fas fa-globe"></i> '+params.data.node_data._itrend_contacto_web)
                    $("#phone").html('<i class="fas fa-phone"></i> '+params.data.node_data._itrend_contacto_telefono)
                    $("#street").html('<i class="fas fa-map-marker"></i> '+params.data.node_data._itrend_contacto_direccion+" "+params.data.node_data._itrend_contacto_comuna)
                    $("#email").html('<i class="fas fa-envelope"></i> '+params.data.node_data._itrend_contacto_correo)
                    $("#mision").text(params.data.node_data._itrend_mision)
                    if (params.data.node_data._itrend_descripcion_relacion_accion_mitigacion)
                      $("#mitigacion").html("<i><b>Mitigación</b></i><br>"+params.data.node_data._itrend_descripcion_relacion_accion_mitigacion+"<br><br>")
                    if (params.data.node_data._itrend_descripcion_relacion_accion_alerta)
                      $("#preparacion").html("<i><b>Preparacion</b></i><br>"+params.data.node_data._itrend_descripcion_relacion_accion_alerta+"<br><br>")
                    if (params.data.node_data._itrend_descripcion_relacion_accion_preparacion)
                      $("#alerta").html("<i><b>Alerta</b></i><br>"+params.data.node_data._itrend_descripcion_relacion_accion_preparacion+"<br><br>")

                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_resiliencia-social"])
                        $("#tarea1").html("<i><b>Tarea 1</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_resiliencia-social"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-impacto-social"])
                        $("#tarea2").html("<i><b>Tarea 2</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-impacto-social"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_proyectos-territoriales"])
                        $("#tarea3").html("<i><b>Tarea 3</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_proyectos-territoriales"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_politicas-para-innovacion"])
                        $("#tarea4").html("<i><b>Tarea 4</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_politicas-para-innovacion"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-y-materiales"])
                        $("#tarea5").html("<i><b>Tarea 5</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-y-materiales"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-de-la-informacion"])
                        $("#tarea6").html("<i><b>Tarea 6</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_tecnologias-de-la-informacion"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_escenarios-de-desastres"])
                        $("#tarea7").html("<i><b>Tarea 7</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_escenarios-de-desastres"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-de-riesgo"])
                        $("#tarea8").html("<i><b>Tarea 8</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_evaluacion-de-riesgo"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_entorno-construido"])
                        $("#tarea9").html("<i><b>Tarea 9</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_entorno-construido"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_comprension-de-amenazas"])
                        $("#tarea10").html("<i><b>Tarea 10</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_comprension-de-amenazas"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_monitoreo-de-amenazas"])
                        $("#tarea11").html("<i><b>Tarea 11</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_monitoreo-de-amenazas"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_mapas-de-amenaza"])
                        $("#tarea12").html("<i><b>Tarea 12</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_mapas-de-amenaza"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_alerta-temprana"])
                        $("#tarea13").html("<i><b>Tarea 13</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_alerta-temprana"]+"<br><br>")
                      if (params.data.node_data["_itrend_descripcion_relacion_tarea_continuidad-operativa"])
                        $("#tarea14").html("<i><b>Tarea 14</b></i><br>"+params.data.node_data["_itrend_descripcion_relacion_tarea_continuidad-operativa"]+"<br><br>")

                    $(".modal").modal("open")
                  }
                })
          }
          var data = <?php echo json_encode($TAREAS); ?>;
          network(data)
          var data = <?php echo json_encode($TERRITORIAL); ?>;
          tree(data,"container2")
          var data = <?php echo json_encode($SECTORES); ?>;
          tree(data,"container3")
          $(document).ready(function(){
            $('.tabs').tabs();
            $('.modal').modal();
            $('.collapsible').collapsible();

          });
       </script>
      </div>
<?php
 // get_footer();
?>
