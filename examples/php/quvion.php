<?php

class quvion
{
    private $apiKey = "";
    private $domain = "";

    function setup($apiKey, $domain)
    {
        $this->apiKey = $apiKey;
        $this->domain = $domain;

    }

    function confirmSubscription($confirmationKey, $ipOpt, $timestampOpt)
    {
        $url = $this->domain . "/api/v2/subscriptions/confirm/" . $confirmationKey;

        $data = array(
            "ipOptIn" => $ipOpt,
            "timestampOptIn" => $timestampOpt);


        $jsonDataEncoded = json_encode($data);

        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Basic " . base64_encode("user:" . $this->apiKey),
                'method' => 'POST',
                'content' => $jsonDataEncoded
            )
        );

        return $this->createHttpRequest($url, $options);
    }

    function unsubscribe($key1, $key2)
    {
        $url = $this->domain . "/api/v2/subscriptions/unsubscribe/" . $key1 . "_" . urlencode($key2);
        $options = array(
            'http' => array(
                'header' => "Content-type: application/x-www-form-urlencoded\r\nAuthorization: Basic " . base64_encode("user:" . $this->apiKey),
                'method' => 'GET',
            )
        );

        return $this->createHttpRequest($url, $options);
    }

    function createHttpRequest($url, $options)
    {
        $NUM_OF_ATTEMPTS = 1;
        $attempts = 0;
        $result = null;
        do {
            $result = $this->executeRequest($url, $options);
            if ($result === FALSE) {
                $result = null;
                $attempts++;
                sleep(1);
            } else {
                $attempts = $NUM_OF_ATTEMPTS;
            }
        } while ($attempts < $NUM_OF_ATTEMPTS);

        return $result;
    }

    function executeRequest($url, $options)
    {
        $context = stream_context_create($options);
        return file_get_contents($url, false, $context);
    }
}


