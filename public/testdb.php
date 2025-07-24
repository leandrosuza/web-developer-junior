<?php
require_once __DIR__ . '/../app/Common.php';

use App\Models\User;

try {
    $users = User::all();
    echo "<pre>";
    print_r($users->toArray());
    echo "</pre>";
} catch (Exception $e) {
    echo "Erro ao conectar ou buscar usuários: " . $e->getMessage();
}