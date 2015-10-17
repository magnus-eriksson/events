# A small event dispatcher for PHP

Need events? Here you go! No fuzz, no overcomplicated instantiation or bloated classes.

## Install

Git clone or use composer to download the package with the following command:
```
composer require maer/events 0.*
```

## Usage
Include composers autoloader or include the files in the `src/` folder manually. *(start with the file `EventInterface.php`)*

#### Create a new instance ####

```
$event = new Maer\Events\Event();
```

#### Add a listener
```
$event->addListener('start_something', 'some-id', function($name) {
    echo "Coolest ever: {$name}";
});
```

#### Trigger/Emit an event
```
$response = $event->emit('start_something', ['Chuck Norris']);

// Echoes: Coolest ever: Chuck Norris
```

#### Remove a listener

```
$event->removeListener('start_something', 'some-id');
```

## Facade/Factory
If you don't want to store the Event class instance yourself, you can use the combined Facade/Factory class.


#### Use it as a Factory
This will always return the same instance
```
$event = Maer\Events\EventFacade::getInstance();
```

#### To use it as a Facade
This will use the same instance as getInstance() returns so you can combine the two
```
Maer\Events\EventFacade::addListener(...);

Maer\Events\EventFacade::removeListener(...);

$response = Maer\Events\EventFacade::emit(...);

//... and any other method available in the Event class

```

## More...
Above is the basic usage but there is more... I'll update this guide soon.
