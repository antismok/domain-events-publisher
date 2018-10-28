<?php

declare(strict_types=1);

namespace Antismok\DomainEventPublisher\Tests;

use Antismok\DomainEventPublisher\DomainEvent;
use DateTime;

/**
 * @author Roman Saritskiy <saritskiy.r@gmail.com>
 */
class EventWasCreated implements DomainEvent
{
    private $occurredOn;
    
    /**
     * Name for test
     *
     * @var type 
     */
    private $name;
    
    /**
     * @param string $name Name for test
     */
    function __construct(string $name)
    {
        $this->name       = $name;   
        $this->occurredOn = new DateTime();
    }

    public function occurredOn(): DateTime
    {
        return $this->occurredOn;
    }
    
    /**
     * Name for test
     *
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }
}
