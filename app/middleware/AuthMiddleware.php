<?php
namespace Zclone\middleware; use Zclone\Core\Request; use Zclone\Core\Response; final class AuthMiddleware { public function handle(Request $r): bool { if (!$r->userId()) { Response::redirect('/login'); return false; } return true; } }
