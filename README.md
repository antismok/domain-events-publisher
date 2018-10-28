# domain-events-publisher
[![Build Status](https://travis-ci.org/antismok/domain-events-publisher.svg?branch=master)](https://travis-ci.org/antismok/domain-events-publisher)

Publisher of immutable domain events implemented on symfony dispatcher component.

See https://symfony.com/doc/current/components/event_dispatcher.html

Usage
```php

//....

use Antismok\DomainEventPublisher\DomainEvent;

class UserRegistered implements DomainEvent
{
    private $occurredOn;
    
    /**
     * @var string $user
     */
    private $userName;
    
    /**
     * @param string $userName
     */
    function __construct(string $userName)
    {
        $this->useName    = $userName;   
        $this->occurredOn = new DateTime();
    }
    
    public function username(): string
    {
        return $this->username;
    }

    public function occurredOn(): DateTime
    {
        return $this->occurredOn;
    }
}
```

```php

//....
class UserRegisteredHandler
{
    public function handle(UserCreated $event)
    {
        //Some operation
    }
}
```
```php

//....
//Some config place
DomainEventPublisher::getInstance()->addListener(UserRegistered::class, [new UserRegisteredHandler, 'handle']);

//Some domain place
DomainEventPublisher::getInstance()->publish(new UserRegistered('Roman'));

```
