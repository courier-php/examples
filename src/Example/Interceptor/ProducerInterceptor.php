<?php
declare(strict_types = 1);

namespace Courier\Example\Interceptor;

use Courier\Interceptor\ProducerInterceptorInterface;
use Courier\Interceptor\ProducerInterceptorResultEnum;
use Courier\Message\CommandInterface;
use Courier\Message\Envelope;
use Courier\Message\EventInterface;
use Courier\Serializer\SerializerInterface;

final class ProducerInterceptor implements ProducerInterceptorInterface {
  public function beforeEventSerialize(
    EventInterface &$event
  ): ProducerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ProducerInterceptorResultEnum::PASS;
  }

  public function afterEventSerialize(
    Envelope &$envelope,
    EventInterface $event,
    SerializerInterface $serializer
  ): ProducerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ProducerInterceptorResultEnum::PASS;
  }

  public function beforeSendEvent(
    Envelope &$envelope
  ): ProducerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ProducerInterceptorResultEnum::PASS;
  }

  public function afterSendEvent(
    Envelope $envelope
  ): void {
    echo __FUNCTION__, PHP_EOL;
  }

  public function beforeCommandSerialize(
    CommandInterface &$command
  ): ProducerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ProducerInterceptorResultEnum::PASS;
  }

  public function afterCommandSerialize(
    Envelope &$envelope,
    CommandInterface $command,
    SerializerInterface $serializer
  ): ProducerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ProducerInterceptorResultEnum::PASS;
  }

  public function beforeSendCommand(
    Envelope &$envelope
  ): ProducerInterceptorResultEnum {
    echo __FUNCTION__, PHP_EOL;

    return ProducerInterceptorResultEnum::PASS;
  }

  public function afterSendCommand(
    Envelope $envelope
  ): void {
    echo __FUNCTION__, PHP_EOL;
  }
}
