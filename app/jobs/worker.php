<?php
[$router,$c]=require dirname(__DIR__).'/bootstrap.php';
$q=$c->get(Zclone\Core\Queue::class);
echo "Nebula queue worker online\n";
while (true) { $job=$q->pop('events'); if ($job) { $q->publish('game.events',$job); echo json_encode($job)."\n"; } usleep(250000); }
