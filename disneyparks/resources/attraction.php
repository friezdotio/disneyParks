<?php


class Attraction extends Controller {

    public function get($attractionid=NULL, $type=NULL, $region=NULL) {
        
        if(isset($_POST["attractionid"])){
            $attractionid = $_POST["attractionid"];
        }
        if(isset($_POST["type"])){
            $type = $_POST["type"];
        }
        if(isset($_POST["resortid"])){
            $resortid = $_POST["resortid"];
        }
        
        $attractions = $this->attractionsModel->getAttractionByID($attractionid, $type, $region);
        
        // Include a response code
        http_response_code(200);
        
        print json_encode($attractions);
    }
    
}
