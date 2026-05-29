<?php
namespace Zclone\Core;
final class Env { private static array $v=[]; public static function load(string $path): void { if (!is_file($path)) return; foreach (file($path, FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES) as $line) { if (str_starts_with(trim($line),'#') || !str_contains($line,'=')) continue; [$k,$v]=array_map('trim', explode('=',$line,2)); self::$v[$k]=trim($v," \t\n\r\0\x0B\"'"); $_ENV[$k]=self::$v[$k]; } } public static function get(string $key, mixed $default=null): mixed { return $_ENV[$key] ?? self::$v[$key] ?? getenv($key) ?: $default; } }
