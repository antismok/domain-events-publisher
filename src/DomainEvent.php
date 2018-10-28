<?php

declare(strict_types=1);

namespace Antismok\DomainEventPublisher;

use DateTime;

/**
 * A minimal interface for a DomainEvent
 *
 * @author Roman Saritskiy <saritskiy.r@gmail.com>
 */
interface DomainEvent
{
    /**
     * @return DateTime
     */
    public function occurredOn(): DateTime;
}
