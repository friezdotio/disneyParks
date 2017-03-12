<?php

class ResortModel extends _main {
    
    function __construct() {
        parent::__construct();
    }

    public function getResortWDPRO($resortid='') {   
        // if there is no ID then it lists all resorts.
        
        $apiURL = "https://api.wdpro.disney.go.com/global-pool-override-A/facility-service/destinations/" . $resortid;

        return $this->main->getDisneyAPI($apiURL);        
    }
    
    public function getArrayOfResortIDs() {
        
        $parkURLs = $this->getResortWDPRO()->entries;
        $resortids = array();
        foreach ($resortURLs as $resortURL) {
            $resortid = $resortURL->id;
            $resortids[] = $resortid;
        }
        
        return $resortids;
    }
    
    public function getResortByID($resortid) {
        
        $resorts = $this->getResorts();
        $arrayIndex = array_search($resortid, array_column($resorts, 'id'));
        
        return $resorts[$arrayIndex];
    }
    
    public function getResorts() {
        
        $resortsArray = array(
            array(
                'id' => '80007798',
                'name' => 'Walt Disney World',
                'location' => 'Orlando, FL',
                'region' => 'us'
            ),
            array(
                'id' => '80008297',
                'name' => 'Disneyland Resort',
                'location' => 'Anaheim, CA',
                'region' => 'us'
            ),
            array(
                'id' => 'dlp',
                'name' => 'Disneyland Paris',
                'location' => 'Paris, FR',
                'region' => 'fr'
            ),
            array(
                'resortid' => 'hkdl',
                'name' => 'Hong Kong Disneyland Park',
                'location' => 'Lantau Island, Hong Kong',
                'region' => 'INTL'
            ),
            array(
                'id' => 'shdr',
                'name' => 'Shanghai Disneyland',
                'location' => 'Shanghai Shi, China',
                'region' => 'cn'
            )
        );

        return $resortsArray;   
    }

}