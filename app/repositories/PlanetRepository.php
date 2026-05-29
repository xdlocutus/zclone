<?php
namespace Zclone\repositories;
use Zclone\Core\Database;
final class PlanetRepository { public function __construct(private Database $db) {} public function homeworld(int $userId): ?array { return $this->db->one('select * from planets where user_id=? order by id limit 1',[$userId]); } }
