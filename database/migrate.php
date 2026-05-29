<?php
[$router,$c]=require dirname(__DIR__).'/app/bootstrap.php';
$c->get(Zclone\Core\Database::class)->pdo->exec(file_get_contents(__DIR__.'/schema.sql'));
echo "Migrated\n";
