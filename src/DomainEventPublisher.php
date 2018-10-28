<?php

declare(strict_types=1);

namespace Antismok\DomainEventPublisher;

use Antismok\DomainEventPublisher\DomainEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * @author Roman Saritskiy <saritskiy.r@gmail.com>
 */
class DomainEventPublisher
{
    /**
     * @var null|DomainEventPublisher
     */
    public static $instance;
    
    /**
     * @var EventDispatcher
     */
    private $dispatcher;

    public function __construct()
    {
        $this->dispatcher = new EventDispatcher;
        static::$instance = $this;
    }

    /**
     * Get DomainEventPublisher instance
     *
     * @return  DomainEventPublisher
     */
    public static function getInstance(): DomainEventPublisher
    {
        return null !== static::$instance ? static::$instance : new static();
    }

    /**
     * Publish a domain event
     * 
     * @param DomainEvent $event
     *
     * @return void
     */
    public function publish(DomainEvent $event): void
    {
        $this->dispatch(get_class($event), $event);
    }

    /**
     * Adds an event listener that listens on the specified events.
     *
     * @param string   $eventName The event to listen on
     * @param callable $listener  The listener
     * @param int      $priority  The higher this value, the earlier an event
     *                            listener will be triggered in the chain (defaults to 0)
     * @return void
     */
    public function addListener(string $eventName, $listener, int $priority = 0): void
    {
        $this->dispatcher->addListener($eventName, $listener, $priority);
    }

    /**
     * Dispatches an event to all registered listeners.
     *
     * @param string      $eventName  The name of the event to dispatch.
     * @param DomainEvent $event      The event to pass to the event handlers/listeners
     *
     * @return void
     */
    protected function dispatch(string $eventName, DomainEvent $event): void
    {
        $listeners = $this->dispatcher->getListeners($eventName);

        if (!empty($listeners)) {
            $this->doDispatch($listeners, $eventName, $event);
        }
    }

    /**
     * Triggers the listeners of an event.
     *
     * This method can be overridden to add functionality that is executed
     * for each listener.
     *
     * @param callable[]  $listeners The event listeners
     * @param string      $eventName The name of the event to dispatch
     * @param DomainEvent $event     The event object to pass to the event handlers/listeners
     *
     * @return void
     */
    protected function doDispatch(array $listeners, string $eventName, DomainEvent $event): void
    {
        foreach ($listeners as $listener) {
            call_user_func($listener, $event, $eventName, $this);
        }
    }
}
