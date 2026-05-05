<?php

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

require_once '../config/Database.php';
require_once '../classes/MahasiswaController.php';

$database   = new Database();
$db         = $database->getConnection();
$mahasiswa  = new MahasiswaController($db);

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {

    // READ ALL / READ BY ID
    case 'GET':
        if (isset($_GET['id'])) {
            $mhs = $mahasiswa->getDataById($_GET['id']);
            if ($mhs) {
                $data = [
                    'status'  => 'success',
                    'method'  => 'GET',
                    'message' => 'Data berhasil diambil',
                    'data'    => $mhs,
                ];
            } else {
                $data = [
                    'status'  => 'error',
                    'method'  => 'GET',
                    'message' => 'Data tidak ditemukan',
                ];
                http_response_code(404);
            }
        } else {
            $mhs  = $mahasiswa->read_data();
            $data = [
                'status'  => 'success',
                'method'  => 'GET',
                'message' => 'Data berhasil diambil',
                'count'   => $mhs->num_rows,
                'data'    => $mhs->fetch_all(MYSQLI_ASSOC),
            ];
        }
        break;

    // CREATE
    case 'POST':
        $post = [
            'nim'   => $_POST['nim']   ?? null,
            'nama'  => $_POST['nama']  ?? null,
            'prodi' => $_POST['prodi'] ?? null,
        ];

        if ($mhs = $mahasiswa->store($post)) {
            $data = [
                'status'  => 'success',
                'method'  => 'POST',
                'message' => 'Data berhasil disimpan',
                'data'    => $mhs,
            ];
            http_response_code(201);
        } else {
            $data = [
                'status'  => 'error',
                'method'  => 'POST',
                'message' => 'Gagal menyimpan data',
            ];
            http_response_code(400);
        }
        break;

    // UPDATE
    case 'PUT':
        parse_str(file_get_contents("php://input"), $_PUT);
        $id  = $_PUT['id']    ?? null;
        $put = [
            'nim'   => $_PUT['nim']   ?? null,
            'nama'  => $_PUT['nama']  ?? null,
            'prodi' => $_PUT['prodi'] ?? null,
        ];

        if ($mhs = $mahasiswa->update($id, $put)) {
            $data = [
                'status'  => 'success',
                'method'  => 'PUT',
                'message' => 'Data berhasil diupdate',
                'data'    => $mhs,
            ];
            http_response_code(200);
        } else {
            $data = [
                'status'  => 'error',
                'method'  => 'PUT',
                'message' => 'Gagal mengupdate data',
            ];
            http_response_code(400);
        }
        break;

    // DELETE
    case 'DELETE':
        $id = $_GET['id'] ?? null;

        if ($mahasiswa->destroy($id)) {
            $data = [
                'status'  => 'success',
                'method'  => 'DELETE',
                'message' => 'Data berhasil dihapus',
                'data'    => [],
            ];
            http_response_code(200);
        } else {
            $data = [
                'status'  => 'error',
                'method'  => 'DELETE',
                'message' => 'Gagal menghapus data',
            ];
            http_response_code(400);
        }
        break;

    // METHOD TIDAK DIIZINKAN
    default:
        $data = [
            'status'  => 'error',
            'message' => 'Metode tidak diizinkan',
        ];
        http_response_code(405);
        break;
}

echo json_encode($data);
