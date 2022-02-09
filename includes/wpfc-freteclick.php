<?php

namespace WPFCTracking\Inludes;

class FreteClick{

    /**
     * @Track
     */
    public static function get_track($data = []){

        $url_api = "https://api.freteclick.com.br/track/back/" . $data['orderId'] . "/" . $data['document'];
    
        $headers = array(         
          'Accept:application/ld+json',
          'Content-Type:application/json',
          'api-token: 242c5d6f05fd292bc91fd67170dc5a04'
        );
    
        $ch = curl_init();
    
        curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_URL, $url_api);
    
        $result = json_decode(curl_exec($ch), true);
    
        if(curl_errno($ch)){
            echo curl_error($ch);
            return null;
        }

        curl_close($ch); 
        
        if($result['response']['success'] === false){
            return null;
        }

        return $result;

    }

}
