<?php


class Resorts extends Controller {

    public function get() {   
        
        $resorts = $this->resortModel->getResorts();
        
        // Include a response code
        http_response_code(200);
        
        print json_encode($resorts);
    }
    
}
