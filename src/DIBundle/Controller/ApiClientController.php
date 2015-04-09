<?php
/**
 * Created by PhpStorm.
 * User: Aurelija
 * Date: 2015-04-08
 * Time: 22:21
 */

namespace DIBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ApiClientController extends Controller
{
    public function indexAction()
    {
        $dispatcher = $this->get('event_dispatcher');
        $apiClientEvent = $this->get('api_client_event');
        $apiClient = $this->get('api_client');

        $apiClientEvent->setApiClient($apiClient);

        $apiClientEvent->getApiClient()->setUrl('http://www.15min.lt/');
        $dispatcher->dispatch('api.client.before', $apiClientEvent);
        $fail = false;
        try {
            $status = $apiClientEvent->getApiClient()->doRequest();
        } catch (\Exception $e){
            $fail = true;
        }

        if($fail === true || $status != 200){
            $dispatcher->dispatch('api.client.failure', $apiClientEvent);
        } elseif ($status == 200) {
            $dispatcher->dispatch('api.client.success', $apiClientEvent);
        }
        return $this->render('DIBundle:Default:client.html.twig');
    }
}