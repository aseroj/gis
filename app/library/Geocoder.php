<?php

class Geocoder {
  // GOOGLE ZIP API
  /**
  * Uses Google Maps Geocoder (V3) to get postal code for an address.  Uses first address match.
  * @param String Address - Make sure to include at least the street address, city and state.
  * @return String - Zip code on success, blank if a zip code is failed to be retrieved.
  */
  public static function county($lat,$lng) {
    $rurl = "http://maps.googleapis.com/maps/api/geocode/xml?sensor=false&latlng=".$lat.",".$lng."";
    // $rurl = "http://maps.googleapis.com/maps/api/geocode/xml?sensor=false&latlng=61.94490000,-151.81590000";

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $rurl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 15000);

    $response = curl_exec($ch);
    $info = curl_getinfo($ch);
    curl_close ($ch);

    $dom = new DOMDocument();
    $res = $dom->loadXML($response);

    if($res){
      if($status = $dom->getElementsByTagName('status')->item(0)){
        $dom_state = $status->nodeValue;
        if($dom_state != 'OK'){sleep(1);}
        if($dom_state == 'OK'){
          //If status is OK, then at least one result should be here.
          $result = $dom->getElementsByTagName('result')->item(2);
          $postalcode = $result->getElementsByTagName('formatted_address')->item(0)->nodeValue;
          // foreach($result->getElementsByTagName('address_component') as $comp){
          //   // if($comp->getElementsByTagName('type')->item(0)->nodeValue == 'postal_code'){
          //     $postalcode = $comp->getElementsByTagName('short_name')->item(0)->nodeValue;
          //   // }
          // }
          return $postalcode;
        }else{
          return '';
        }
      }
    } else {
      return '';
    }
  }
}
