<?php
    require_once  '../app/core/DB.php';

    class sinhvienModel {
        private $conn;

        public function __construct() {
           $this->conn = ConnectDB::connect();
        }
        public function getAllSinhVien() {
            $query = "SELECT * FROM sinhvien";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        public function create($data) {
            $query = "INSERT INTO sinhvien (ma_sv, ho_ten, gioi_tinh, ngay_sinh, dia_chi, lop) VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :dia_chi, :lop)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':ma_sv', $data['ma_sv']);
            $stmt->bindParam(':ho_ten', $data['ho_ten']);
            $stmt->bindParam(':gioi_tinh', $data['gioi_tinh']);
            $stmt->bindParam(':ngay_sinh', $data['ngay_sinh']);
            $stmt->bindParam(':dia_chi', $data['dia_chi']);
            $stmt->bindParam(':lop', $data['lop']);
            return $stmt->execute();
        }
        
    }

?>