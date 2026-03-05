<!-- MOH RAYA ALFAREZA ALBAN 133 E -->

<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);
$stmt = $mahasiswa->read();
$num = $stmt->rowCount();

if($num > 0) {

    $data = [];

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = [
            "id" => $id,
            "npm" => $npm,
            "nama" => $nama,
            "jurusan" => $jurusan
        ];

        array_push($data, $item);
    }

    http_response_code(200);
    echo json_encode($data);

} else {
    http_response_code(404);
    echo json_encode(["message" => "Data tidak ditemukan"]);
}
?>