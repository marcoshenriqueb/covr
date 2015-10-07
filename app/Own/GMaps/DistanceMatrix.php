<?php

namespace App\Own\GMaps;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 *
 */
class DistanceMatrix
{

  public function fetchDistance($baseUri, $apiKey, $params, $options = [])
  {
    $client = new Client(['base_uri' => $baseUri]);
    if (isset($options['headers'])) {
      $request = new Request('GET', $params . '&' . 'key=' . $apiKey, $options['headers']);
      $response = $client->send($request);
    }else {
      $response = $client->get($params . '&' . 'key=' . $apiKey);
    }

    return $response;
  }

  public function calculateDistance($origins, $destinations)
  {
      $o = "?origins=$origins";
      $d = "&destinations=$destinations";
      $params = $o . $d;
      return $this->fetchDistance(env('GOOGLE_DIST_URL'), env('GOOGLE_API_SERVER_KEY'), $params);
  }
}
