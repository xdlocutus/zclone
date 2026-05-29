<?php
namespace Zclone\Core;
final class Container { private array $bindings=[],$instances=[]; public function set(string $id, callable $factory): void { $this->bindings[$id]=$factory; } public function get(string $id): mixed { if (isset($this->instances[$id])) return $this->instances[$id]; if (isset($this->bindings[$id])) return $this->instances[$id]=($this->bindings[$id])($this); return $this->instances[$id]=new $id(); } }
