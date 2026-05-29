<?php
[$router,$c]=require dirname(__DIR__).'/bootstrap.php';
$svc=$c->get(Zclone\services\UniverseTickService::class);
echo "Universe tick daemon online\n";
while (true) { $svc->tick(); sleep(5); }
