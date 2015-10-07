<?php

namespace App\Own\Currency;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

/**
 *
 */
abstract class CurrencyFetcher
{

  public function fetch($baseUri, $page, $appId, $options = []){

    $client = new Client(['base_uri' => $baseUri]);
    if (isset($options['headers'])) {
      $request = new Request('GET', $page . '?app_id=' . $appId, $options['headers']);
      $response = $client->send($request);
    }else {
      $response = $client->get($page . '?app_id=' . $appId);
    }

    return $response;
  }
}
