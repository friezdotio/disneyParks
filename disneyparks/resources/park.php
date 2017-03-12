<?php


class Park extends Controller {

    public function get($parkid=null, $region=null) {   
        
        if(isset($_POST["parkid"])){
            $parkid = $_POST["parkid"];
        }
        
        $park = $this->parkModel->getParkByID($parkid, $region);
        
        // Include a response code
        http_response_code(200);
        
        print json_encode($park);
    }
    
}
