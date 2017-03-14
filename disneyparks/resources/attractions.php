<?php


class Attractions extends Controller {

    public function get($parkid=NULL, $region=NULL) {
        
        if(isset($_POST["parkid"])){
            $parkid = $_POST["parkid"];
        }
        if(isset($_POST["region"])){
            $region = $_POST["region"];
        }
        
        $attractions = $this->attractionsModel->getAttractionsByParkID($parkid, $region);
        
        // Include a response code
        http_response_code(200);
        
        print json_encode($attractions);
    }
    
}
