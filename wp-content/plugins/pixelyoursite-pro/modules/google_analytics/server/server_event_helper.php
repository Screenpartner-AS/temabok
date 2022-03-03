<?php
namespace PixelYourSite;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class GaServerEventHelper {
    static $uaMap = [
        'cn'    => 'traffic_source',
        'ni'    => 'non_interaction',
        'ec'    => 'event_category',
        'tt'    => 'tax',
        'tr'    => 'value',
        'ti'    => 'transaction_id',
        'cu'    => 'currency',
        'dr'    => 'traffic_source'
    ];
    /**
     * @param SingleEvent $singleEvent
     * @return array|null
     */
    static public function mapSingleEventToServerData($singleEvent) {

        switch ($singleEvent->payload['name']) {
            case 'purchase': {
                return self::mapPurchaseToServerData($singleEvent);
            }
        }

        return null;
    }

    /**
     * @param SingleEvent $singleEvent
     * @return array
     */
    static private function mapPurchaseToServerData($singleEvent) {
        $data = $singleEvent->getData();
        $params = $data['params'];
        error_log("mapPurchaseToServerData ".print_r($params,true));
        $serverParams = [
            't'     => 'event',
            'pa'    => 'purchase',
            'ea'    => 'purchase',
            'el'    => "Server Purchase",
            'cid'   =>  EventIdGenerator::guidv4()
        ];

        foreach (self::$uaMap as $key => $val) {
            if(isset($params[$val])) {
                $serverParams[$key] = $params[$val];
            }
        }

        for($i = 1;$i <= count($params['items']);$i++) {
            $item = $params['items'][$i-1];
            $serverParams["pr{$i}id"] = $item['id'];
            $serverParams["pr{$i}nm"] = $item['name'];
            $serverParams["pr{$i}ca"] = $item['category'];
            $serverParams["pr{$i}pr"] = $item['price'];
            $serverParams["pr{$i}qt"] = $item['quantity'];
        }

        return $serverParams;
    }




}