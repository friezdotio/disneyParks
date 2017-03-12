<?php


class Resort extends Controller {

    public function get($resortid=NULL) {   
        
        if(isset($_POST["resortid"])){
            $resortid = $_POST["resortid"];
        }
        
        $resorts = $this->resortModel->getResortByID($resortid);
        
        // Include a response code
        http_response_code(200);
        
        print json_encode($resorts);
    }
    
}
