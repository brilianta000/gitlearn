<?php

class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function login($email, $password) {
        $email    = trim($email);
        $password = trim($password);

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if ($user && password_verify($password, $user['password'])) {
                session_regenerate_id(true);
                $_SESSION['user']    = $user;
                $_SESSION['login']   = true;
                $_SESSION['user_id'] = $user['id'];
                return true;
            }
        }
        return false;
    }

    public function register($nama, $email, $password) {
        $nama     = trim($nama);
        $email    = trim($email);
        $password = trim($password);

        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return false; 
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $hashedPassword);

        return $stmt->execute();
    }

    public function requireLogin() {
        if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
            header("Location: login.php");
            exit;
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
