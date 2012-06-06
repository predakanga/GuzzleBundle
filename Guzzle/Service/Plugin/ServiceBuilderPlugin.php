<?php

namespace Ddeboer\GuzzleBundle\Guzzle\Service\Plugin;

use Guzzle\Common\Event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Service builder plugin to add plugins to all service clients
 *
 * @author Gordon Franke <info@nevalon.de>
 */
class ServiceBuilderPlugin implements EventSubscriberInterface
{
    private $plugins = array();

    public function __construct(array $plugins)
    {
        $this->plugins = $plugins;
    }

    public static function getSubscribedEvents()
    {
        return array(
            'service_builder.create_client' => 'onCreateClient'
        );
    }

    public function onCreateClient(Event $event)
    {
        foreach ($this->plugins as $plugin) {
            $event['client']->addSubscriber($plugin);
        }
    }
}
