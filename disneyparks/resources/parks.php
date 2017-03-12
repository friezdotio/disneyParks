<?php


class Parks extends Controller {

    public function get($resortid=null, $region=null) {   
        
        if(isset($_POST["resortid"])){
            $resortid = $_POST["resortid"];
        }
        if(isset($_POST["region"])){
            $region = $_POST["region"];
        }
        
        $parks = $this->parkModel->getParksByResortID($resortid, $region);
        
        // Include a response code
        http_response_code(200);
        
        print json_encode($parks);
    }
    
}
