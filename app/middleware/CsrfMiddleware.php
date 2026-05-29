<?php
namespace Zclone\middleware; use Zclone\Core\Request; use Zclone\Core\Response; use Zclone\Core\Security; final class CsrfMiddleware { public function handle(Request $r): bool { if (in_array($r->method(),['POST','PUT','PATCH','DELETE'],true) && !Security::verifyCsrf($r->input('_csrf'))) { Response::json(['error'=>'csrf'],419); return false; } return true; } }
