<?php
// Contoh Kelas (Class) di PHP dengan paradigma Access Modifier
class User {
    // Properti (Hanya bisa diakses dari internal kelas ini)
    private $username;
    protected $hakAkses; // Bisa diakses dari kelas turunan (Inheritance)

    // Constructor: Dipanggil otomatis saat kelas ini diinstansiasi (new User)
    public function __construct($user, $role) {
        $this->username = $user;
        $this->hakAkses = $role;
    }

    // Method Publik
    public function getUsername() {
        return $this->username;
    }

    public function login($inputUser) {
        // Logika sederhana: Jika input cocok dengan objek internal
        if($this->username === $inputUser) {
            return true;
        }
        return false;
    }
}
?>
