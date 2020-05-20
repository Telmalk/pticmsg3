<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=cmsg1a", "root", "");
} catch (PDOException $e) {
    die($e->getMessage());
}