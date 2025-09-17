<?php
class User {
    public $name;
    public $email;
    public $username;
    public $password; 

    public function __construct($name, $email, $username, $password_hashed) {
        $this->name = $name;
        $this->email = $email;
        $this->username = $username;
        $this->password = $password_hashed;
    }

    public static function loadAll() {
        $file = __DIR__ . '/../data/users.json';
        if (!file_exists($file)) return [];
        $json = file_get_contents($file);
        $arr = json_decode($json, true);
        return $arr ?: [];
    }

    public static function findByUsername($username) {
        $users = self::loadAll();
        foreach ($users as $u) {
            if ($u['username'] === $username) return $u;
        }
        return null;
    }

    public static function saveUser($userArray) {
        $file = __DIR__ . '/../data/users.json';
        $users = self::loadAll();
        $users[] = $userArray;
        file_put_contents($file, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}
?>