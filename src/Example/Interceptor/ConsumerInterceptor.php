<?php
declare(strict_types = 1);

namespace Courier\Example\Interceptor;

use Courier\Interceptor\ConsumerInterceptorInterface;
use Courier\Interceptor\ConsumerInterceptorResultEnum;
use Courier\Message\CommandInterface;
use Courier\Message\Envelope;
use Courier\Message\EventInterface;
use Courier\Message\MessageInterface;
use Courier\Processor\Handler\HandlerInterface;
use Courier\Processor\Handler\HandlerResultEnum;
use Courier\Processor\Listener\ListenerInterface;
use Courier\Serializer\SerializerInterface;

final class ConsumerInterceptor implements ConsumerInterceptorInterface {
  public function beforeConsume(): void {
    echo __FUNCTION__, PHP_EOL;
  }

  public function afterConsume(): void {
    echo __FUNCTION__, PHP_EOL;
  }

  public function beforeReceive(
    string &$queueName
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function afterReceive(
    string $queueName,
    Envelope &$envelope
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function beforeUnserialize(
    Envelope &$envelope,
    SerializerInterface $serializer
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function afterUnserialize(
    Envelope $envelope,
    MessageInterface &$message
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function beforeListener(
    EventInterface $event,
    ListenerInterface $listener,
    string $methodName
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function afterListener(
    EventInterface $event,
    ListenerInterface $listener,
    string $methodName
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function beforeHandler(
    CommandInterface $command,
    HandlerInterface $handler,
    string $methodName
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

  public function afterHandler(
    CommandInterface $command,
    HandlerInterface $handler,
    string $methodName,
    HandlerResultEnum $result
  ): ConsumerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ConsumerInterceptorResultEnum::PASS;
  }

}
