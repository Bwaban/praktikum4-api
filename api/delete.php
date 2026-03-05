<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: DELETE");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

$mahasiswa->id = $data->id;

if($mahasiswa->delete()){
    http_response_code(200);
    echo json_encode(["message" => "Berhasil dihapus"]);
} else {
    http_response_code(503);
    echo json_encode(["message" => "Gagal hapus"]);
}
?>