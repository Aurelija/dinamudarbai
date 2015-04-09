<?php

namespace DIBundle\Event;

use Symfony\Component\EventDispatcher\Event;


class ApiClientEvent extends Event
{
    protected $url = null;
    protected $apiClient = null;

    public function setApiClient($apiClient) {
        $this->apiClient = $apiClient;
    }

    public function getApiClient() {
        return $this->apiClient;
    }
}