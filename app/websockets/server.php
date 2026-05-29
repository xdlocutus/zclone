<?php
$autoload=dirname(__DIR__,2).'/vendor/autoload.php'; if (is_file($autoload)) require $autoload;
if (!class_exists(\Ratchet\Server\IoServer::class)) { echo "Install composer dependencies to run Ratchet websocket server.\n"; exit(1); }
use Ratchet\ConnectionInterface; use Ratchet\MessageComponentInterface; use Ratchet\Server\IoServer; use Ratchet\Http\HttpServer; use Ratchet\WebSocket\WsServer;
final class GameSocket implements MessageComponentInterface { private SplObjectStorage $clients; public function __construct(){ $this->clients=new SplObjectStorage(); } public function onOpen(ConnectionInterface $conn){ $this->clients->attach($conn); $conn->send(json_encode(['event'=>'connected'])); } public function onMessage(ConnectionInterface $from,$msg){ $data=json_decode($msg,true) ?: []; if (($data['type']??'')==='ping') $from->send(json_encode(['event'=>'pong','at'=>time()])); } public function onClose(ConnectionInterface $conn){ $this->clients->detach($conn); } public function onError(ConnectionInterface $conn, Exception $e){ $conn->close(); } }
IoServer::factory(new HttpServer(new WsServer(new GameSocket())), (int)($_ENV['WS_PORT'] ?? 8081))->run();
