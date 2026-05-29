<?php
namespace Zclone\repositories;
use Zclone\Core\Database;
final class UserRepository { public function __construct(private Database $db) {} public function create(array $d): int { $this->db->exec('insert into users (email,username,password_hash,role,email_verification_token) values (?,?,?,?,?)',[$d['email'],$d['username'],$d['password_hash'],$d['role']??'player',$d['token']]); return (int)$this->db->pdo->lastInsertId(); } public function byEmail(string $email): ?array { return $this->db->one('select * from users where email=?',[$email]); } }
