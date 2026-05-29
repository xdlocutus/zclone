<?php
use Zclone\Core\{Container,Database,Env,EventDispatcher,Queue,Router};
use Zclone\repositories\{PlanetRepository,UserRepository};
use Zclone\services\{AuthService,BuildingService,FleetService,ResourceService,UniverseTickService};
$autoload=dirname(__DIR__).'/vendor/autoload.php'; if (is_file($autoload)) { require $autoload; } else { spl_autoload_register(function($class){ $prefix='Zclone\\'; if (str_starts_with($class,$prefix)) { $path=dirname(__DIR__).'/app/'.str_replace('\\','/',substr($class,strlen($prefix))).'.php'; if (is_file($path)) require $path; } }); }
Env::load(dirname(__DIR__).'/.env');
ini_set('session.cookie_httponly','1'); ini_set('session.cookie_samesite','Lax'); if (Env::get('SESSION_SECURE','false')==='true') ini_set('session.cookie_secure','1'); session_start();
$c=new Container(); $c->set(Database::class, fn()=>new Database()); $c->set(Queue::class, fn()=>new Queue()); $c->set(EventDispatcher::class, fn($c)=>new EventDispatcher($c->get(Queue::class))); $c->set(UserRepository::class, fn($c)=>new UserRepository($c->get(Database::class))); $c->set(PlanetRepository::class, fn($c)=>new PlanetRepository($c->get(Database::class))); $c->set(AuthService::class, fn($c)=>new AuthService($c->get(UserRepository::class))); $c->set(ResourceService::class, fn()=>new ResourceService()); $c->set(BuildingService::class, fn($c)=>new BuildingService($c->get(Database::class),$c->get(EventDispatcher::class))); $c->set(FleetService::class, fn($c)=>new FleetService($c->get(Database::class),$c->get(EventDispatcher::class))); $c->set(UniverseTickService::class, fn($c)=>new UniverseTickService($c->get(Database::class),$c->get(ResourceService::class),$c->get(EventDispatcher::class)));
$router=new Router(); require __DIR__.'/routes/web.php'; return [$router,$c];
