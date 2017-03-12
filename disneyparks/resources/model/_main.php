<?php

class _main
{
    
    function __construct()
    {
        $this->main = $this;
    }

    public function getAccessToken()
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://authorization.go.com/token?assertion_type=public&client_id=WDPRO-MOBILE.MDX.WDW.ANDROID-PROD&grant_type=assertion");
        curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$data);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $server_output = curl_exec ($ch);

        curl_close ($ch);
        
        $authInfo = json_decode($server_output);
        
        return $authInfo; 
    }
    
    public function getDisneyAPI($path,$region='us')
    {
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$path . "?region=" . $region);
        //curl_setopt($ch, CURLOPT_POST, 1);
        //curl_setopt($ch, CURLOPT_POSTFIELDS,$data);  //Post Fields
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $headers = [
            'Authorization: BEARER ' . $this->getAccessToken()->access_token,
            'Accept: application/json;apiversion=1',
            'X-Conversation-Id: ~WDPRO-MOBILE.CLIENT-PROD',
            'User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:28.0) Gecko/20100101 Firefox/28.0'
        ];

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $server_output = curl_exec ($ch);

        curl_close ($ch);
        
        $apiArray = json_decode($server_output);

        return $apiArray; 
    }

}
