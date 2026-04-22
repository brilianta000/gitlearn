<?php

class Auth {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Method Login
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

    // Method Register
    public function register($nama, $email, $password) {
        $nama     = trim($nama);
        $email    = trim($email);
        $password = trim($password);

        // Cek apakah email sudah terdaftar
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            return false; // Email sudah terdaftar
        }

        // Hash password lalu insert
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO users (nama, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $email, $hashedPassword);

        return $stmt->execute();
    }

    // Proteksi halaman (redirect ke login jika belum login)
    public function requireLogin() {
        if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
            header("Location: login.php");
            exit;
        }
    }

    // Logout
    public function logout() {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
