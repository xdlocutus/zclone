<?php
namespace Zclone\Core;
final class Response { public static function view(string $view,array $data=[]): void { extract($data, EXTR_SKIP); require dirname(__DIR__,2)."/resources/views/$view.php"; } public static function json(array $data,int $status=200): void { http_response_code($status); header('Content-Type: application/json'); echo json_encode($data, JSON_THROW_ON_ERROR); } public static function redirect(string $to): void { header("Location: $to", true, 302); } }
