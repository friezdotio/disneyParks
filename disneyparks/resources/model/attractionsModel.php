<?php

class AttractionsModel extends _main {
    
    /* Attraction Types
     *
     * attractions
     * entertainment-facilities
     * entertainment-venues
     * entertainments
     * events
     * guest-services
     * lounges
     * photo-locations
     * resorts
     * restaurants
     * shops
     *
     */
    
    function __construct() {
        parent::__construct();
    }
    
    public function getWaitTimesByParkIDWDPRO($parkid, $region='') {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/theme-parks/" . $parkid . "/wait-times";

        return $this->main->getDisneyAPI($apiURL, $region);        
    }
    
    public function getWaitTimeByIDWDPRO($attractionid, $type, $region='') {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-B/facility-service/" . $type . "/" . $attractionid . "/wait-times";

        return $this->main->getDisneyAPI($apiURL, $region);        
    }
    
    public function getAttractionByIDWDPRO($attractionID, $type, $region='') {
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/" . $type . "/" . $attractionID;

        return $this->main->getDisneyAPI($apiURL);        
    }
    
    public function getSchedulesWDPRO($attractionID, $date='', $region='') {
        
        if(strlen($date) > 0){
            $date = "?date=" . $date;
        }
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/schedules/" . $attractionID . "/" . $date;
 
        return $this->main->getDisneyAPI($apiURL, $region);        
    }
    
    public function getAttractionByID($attractionid, $type, $region='') {
        
        $schedules = '';
        
        $waittime = $this->getWaitTimeByIDWDPRO($attractionid, $type, $region);
        $attraction = $this->getAttractionByIDWDPRO($attractionid, $type, $region);
        $schedule = $this->getSchedulesWDPRO($attractionid, $type, $region);
        
        if(isset($schedule->schedules)){
            $schedules = $schedule->schedules;
        }
        
        $attractionArray = array(
            "id" => $waittime->id,
            "name" => $waittime->name,
            "type" => $waittime->type,
            "location" => $attraction->coordinates,
            "waitTime" => $waittime->waitTime,
            "schedules" => $schedules
        );

        return $attractionArray;        
    }
    
    public function getAttractionsByParkID($parkid, $region='us') {
        
        $attractions = $this->getWaitTimesByParkIDWDPRO($parkid, $region)->entries;
        $attractionsArray = array();
        
        $name = '';
        
        if(isset($attraction->name)){
            $name = $attraction->name;
        }
        
        foreach ($attractions as $attraction) {
            $attractionArray = array();
            $attractionArray = array(
                "id" => $attraction->id,
                "name" => $attraction->name,
                "type" => $attraction->type,
                "waitTime" => $attraction->waitTime
            );
            
            $attractionsArray[] = $attractionArray;
        }

        return $attractionsArray;       
    }

}