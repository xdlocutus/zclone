<?php
namespace Zclone\services;
final class ResearchService { public const TECHS=['energy_technology','laser_technology','ion_technology','hyperspace_technology','combustion_drive','impulse_drive','hyperspace_drive','espionage_technology','computer_technology','astrophysics']; public function prerequisites(string $tech): array { return ['impulse_drive'=>['energy_technology'=>1],'hyperspace_drive'=>['hyperspace_technology'=>3],'astrophysics'=>['espionage_technology'=>4]][$tech] ?? []; } }
