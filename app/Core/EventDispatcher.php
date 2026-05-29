<?php
namespace Zclone\Core;
final class EventDispatcher { public function __construct(private Queue $queue) {} public function dispatch(string $event,array $payload=[]): void { $this->queue->push('events', ['event'=>$event,'payload'=>$payload,'at'=>time()]); } }
