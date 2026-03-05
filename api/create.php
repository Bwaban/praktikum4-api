<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
header("Access-Control-Allow-Methods: POST");

include_once '../config/Database.php';
include_once '../models/Mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);

$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->npm) &&
    !empty($data->nama) &&
    !empty($data->jurusan)
){

    $mahasiswa->npm = $data->npm;
    $mahasiswa->nama = $data->nama;
    $mahasiswa->jurusan = $data->jurusan;

    if($mahasiswa->create()){
        http_response_code(201);
        echo json_encode(["message" => "Berhasil ditambahkan"]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Gagal"]);
    }

} else {
    http_response_code(400);
    echo json_encode(["message" => "Data tidak lengkap"]);
}
?>