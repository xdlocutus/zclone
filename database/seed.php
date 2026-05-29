<?php
[$router,$c]=require dirname(__DIR__).'/app/bootstrap.php';
$db=$c->get(Zclone\Core\Database::class);
$db->exec("insert ignore into universes (name,speed,fleet_speed,research_speed) values ('Andromeda',4,2,3)");
$hash=password_hash('password', PASSWORD_DEFAULT);
$db->exec('insert ignore into users (email,username,password_hash,role,email_verified_at) values (?,?,?,?,now())',['admin@nebula.test','Admin',$hash,'admin']);
$u=$db->one('select id from users where email=?',['admin@nebula.test']); $un=$db->one('select id from universes limit 1');
$db->exec('insert ignore into planets (universe_id,user_id,name,galaxy,system,slot) values (?,?,?,?,?,?)',[$un['id'],$u['id'],'New Horizon',1,42,7]);
$p=$db->one('select id from planets where user_id=?',[$u['id']]); foreach(['metal_mine'=>3,'crystal_mine'=>2,'solar_plant'=>4,'shipyard'=>1] as $t=>$l) $db->exec('insert ignore into planet_buildings (planet_id,type,level) values (?,?,?)',[$p['id'],$t,$l]);
echo "Seeded admin@nebula.test / password\n";
