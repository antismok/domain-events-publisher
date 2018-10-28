<?php

declare(strict_types=1);

namespace Antismok\DomainEventPublisher\Tests;

use Antismok\DomainEventPublisher\DomainEventPublisher;
use Antismok\DomainEventPublisher\Tests\EventWasCreated;
use PHPUnit\Framework\TestCase;

/**
 * @author Roman Saritskiy <saritskiy.r@gmail.com>
 */
class DomainEventPublisherTest extends TestCase
{
    public function testTest()
    {
        $name = null;
        DomainEventPublisher::getInstance()->addListener(EventWasCreated::class, function (EventWasCreated $event) use (&$name) {
            $name = $event->name();
        });
        $event = new EventWasCreated('test-domain-event-was-created');
        DomainEventPublisher::getInstance()->publish($event);
        
        $this->assertSame('test-domain-event-was-created', $name);
    }
}
