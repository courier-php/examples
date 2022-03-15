<?php
declare(strict_types = 1);

require_once __DIR__ . '/vendor/autoload.php';

use Courier\Bus;
use Courier\Client\Producer;
use Courier\Example\Command\RegisterUserCommand;
use Courier\Example\Command\RegisterUserHandler;
use Courier\Example\Command\UnhandledCommand;
use Courier\Example\Event\UserRegisteredEvent;
use Courier\Example\Event\UserRegisteredListener;
use Courier\Example\Interceptor\ProducerInterceptor;
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

/* PRODUCER SETUP */
$producer = new Producer($bus);
$producer
  ->addMiddleware(new EnvelopeIdMiddleware())
  ->addMiddleware(new EnvelopeTimestampMiddleware())
  ->setInterceptor(new ProducerInterceptor());

/* APPLICATION */
$producer->sendCommand(
  new RegisterUserCommand('john@example.com')
);

try {
  // there is no command handler set for this command, which will cause a LogicException to be thrown
  $producer->sendCommand(
    new UnhandledCommand()
  );
} catch (LogicException $exception) {
  echo $exception->getMessage(), PHP_EOL;
}
