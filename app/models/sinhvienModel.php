<?php
require_once '../app/core/DB.php';

class sinhvienModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::connect();
    }

    public function paging($limit, $offset, $search)
    {
        $query = "SELECT * FROM sinhvien 
                  WHERE ho_ten LIKE :search
                  ORDER BY id ASC
                  LIMIT :limit OFFSET :offset";

        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':search', "%$search%");
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $count = $this->conn->prepare("SELECT COUNT(*) FROM sinhvien WHERE ho_ten LIKE :search");
        $count->bindValue(':search', "%$search%");
        $count->execute();

        $total = $count->fetchColumn();

        return [
            'sinhviens' => $data,
            'totalPages' => ceil($total / $limit)
        ];
    }

    public function create($data)
    {
        $sql = "INSERT INTO sinhvien 
                (ma_sv, ho_ten, gioi_tinh, ngay_sinh, dia_chi, lop)
                VALUES (:ma_sv, :ho_ten, :gioi_tinh, :ngay_sinh, :dia_chi, :lop)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM sinhvien WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function edit($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM sinhvien WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data)
    {
        $sql = "UPDATE sinhvien SET 
                ma_sv = :ma_sv,
                ho_ten = :ho_ten,
                gioi_tinh = :gioi_tinh,
                ngay_sinh = :ngay_sinh,
                dia_chi = :dia_chi,
                lop = :lop
                WHERE id = :id";

        $data[':id'] = $id;

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }
}