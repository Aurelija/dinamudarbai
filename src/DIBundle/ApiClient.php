<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-04-08
 * Time: 22:10
 */

namespace DIBundle;

use Goutte\Client;

class ApiClient
{
    /**
     *
     *
     * @var null
     */
    protected $url = null;

    /**
     *
     *
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     *
     *
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function onSuccess($event)
    {
        echo "Success!";
    }

    public function onFailure($event)
    {
        echo "Failure!";
    }

    public function onBefore($event)
    {
        $this->addLimit();
    }

    public function addLimit()
    {
        $url = $this->getUrl().'?rows=50';
        $this->setUrl($url);
    }

    public function doRequest()
    {
        $client = new Client();
        $client->setAuth('nfq','labas');
        $crawler = $client->request('GET', $this->getUrl());
        $statusCode = $client->getResponse()->getStatus();
        return $statusCode;
    }

}