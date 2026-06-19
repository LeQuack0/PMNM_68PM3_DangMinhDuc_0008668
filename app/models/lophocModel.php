<?php
require_once '../app/core/DB.php';

class lophocModel
{
    private $conn;

    public function __construct()
    {
        $this->conn = ConnectDB::connect();
    }

    public function getAll($search = '')
    {
        $sql = "SELECT * FROM lophoc
                WHERE ma_lop LIKE :search
                   OR ten_lop LIKE :search
                ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':search', "%$search%");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $sql = "INSERT INTO lophoc(ma_lop,ten_lop)
                VALUES(:ma_lop,:ten_lop)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute($data);
    }

    public function find($id)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM lophoc WHERE id=:id"
        );

        $stmt->execute([':id'=>$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id,$data)
    {
        $sql = "UPDATE lophoc
                SET ma_lop=:ma_lop,
                    ten_lop=:ten_lop
                WHERE id=:id";

        $data[':id']=$id;

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute($data);
    }

    public function delete($id)
    {
        $stmt = $this->conn->prepare(
            "DELETE FROM lophoc WHERE id=:id"
        );

        return $stmt->execute([':id'=>$id]);
    }
    public function paging($limit, $offset, $search = '', $sort = 'ma_lop')
{
    $sql = "SELECT *
            FROM lophoc
            WHERE ma_lop LIKE :search
               OR ten_lop LIKE :search
            ORDER BY $sort ASC
            LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindValue(':search', "%$search%");
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);

    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $count = $this->conn->prepare("
        SELECT COUNT(*)
        FROM lophoc
        WHERE ma_lop LIKE :search
           OR ten_lop LIKE :search
    ");

    $count->bindValue(':search', "%$search%");
    $count->execute();

    $total = $count->fetchColumn();

    return [
        'lophocs' => $data,
        'totalPages' => ceil($total / $limit)
    ];
}
}