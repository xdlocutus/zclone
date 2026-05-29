<?php
namespace Zclone\controllers; use Zclone\Core\Response; use Zclone\Core\Request; final class LandingController { public function home(Request $r): void { Response::view('landing'); } }
