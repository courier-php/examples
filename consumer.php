<?php
declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

use Courier\Bus;
use Courier\Client\Consumer;
use Courier\Client\Producer;
use Courier\Example\Command\RegisterUserCommand;
use Courier\Example\Command\RegisterUserHandler;
use Courier\Example\Event\UserRegisteredEvent;
use Courier\Example\Event\UserRegisteredListener;
use Courier\Example\Interceptor\ConsumerInterceptor;
use Courier\Example\Interceptor\ProducerInterceptor;
use Courier\Inflector\InterfaceInflector;
use Courier\Locator\InMemoryLocator;
use Courier\Middleware\EnvelopeIdMiddleware;
use Courier\Middleware\EnvelopeTimestampMiddleware;
use Courier\Router\SimpleRouter;
use Courier\Transport\AmqpTransport;

/* BUS SETUP */
$bus = new Bus(
  new SimpleRouter(),
  AmqpTransport::fromDsn('amqp://guest:guest@localhost:5672/')
);

$bus->getRouter()
  ->addRoute(
    UserRegisteredEvent::class,
    UserRegisteredListener::class
  )
  ->addRoute(
    RegisterUserCommand::class,
    RegisterUserHandler::class
  );

$bus->bindRoutes();

/* PRODUCER SETUP - REQUIRED BY "RegisterUserHandler" */
$producer = new Producer($bus);
$producer
  ->addMiddleware(new EnvelopeIdMiddleware())
  ->addMiddleware(new EnvelopeTimestampMiddleware())
  ->setInterceptor(new ProducerInterceptor());

/* CONSUMER SETUP */
$consumer = new Consumer(
  $bus,
  new InterfaceInflector(),
  new InMemoryLocator(
    [
      UserRegisteredListener::class => new UserRegisteredListener(),
      RegisterUserHandler::class => new RegisterUserHandler($producer)
    ]
  )
);

$consumer->setInterceptor(new ConsumerInterceptor());

/* APPLICATION */
$consumer->consume();
