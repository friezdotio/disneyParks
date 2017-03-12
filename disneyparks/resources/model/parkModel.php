<?php

class ParkModel extends _main {
    
    function __construct() {
        parent::__construct();
    }

    public function getParkByIDWDPRO($parkid, $region='') {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/theme-parks/" . $parkid;

        return $this->main->getDisneyAPI($apiURL, $region);        
    }
    
    public function getParksByResortIDWDPRO($resortid, $region='') {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/destinations/" . $resortid . "/theme-parks";

        return $this->main->getDisneyAPI($apiURL, $region);        
    }
    
    public function getParkScheduleWDPRO($parkid, $region='') {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/schedules/" . $parkid;

        return $this->main->getDisneyAPI($apiURL, $region);        
    }
    
    public function getArrayOfParkIDs($resortid, $region='') {
        
        $parkURLs = $this->getParksByResortIDWDPRO($resortid, $region)->entries;
        $parkids = array();
        foreach ($parkURLs as $parkURL) {
            $replace = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/theme-parks/";
            $parkid = str_replace($replace,"",$parkURL->links->self->href);
            $parkids[] = $parkid;
        }
        
        return $parkids;
    }
    
    public function getParkByID($parkid, $region='') {
        
        $park = $this->getParkByIDWDPRO($parkid, $region);
        $schedule = $this->getParkScheduleWDPRO($parkid, $region);
        
        $parksArray = array(
            "id" => $park->id,
            "name" => $park->name,
            "location" => $park->coordinates,
            "schedules" => $schedule->schedules
        );

        return $parksArray;        
    }
    
    public function getParksByResortID($resortid, $region='') {
        
        $parks = $this->getArrayOfParkIDs($resortid, $region);
        $parksArray = array();
        
        foreach ($parks as $parkid) {
            $parkArray = array();
            $park = $this->getParkByIDWDPRO($parkid, $region);
            $parkArray = array(
                "id" => $park->id,
                "name" => $park->name,
                "location" => $park->coordinates
            );
            
            $parksArray[] = $parkArray;
        }

        return $parksArray;        
    }

}