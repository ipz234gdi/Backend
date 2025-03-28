<?php
include 'db.php';
$method = $_SERVER['REQUEST_METHOD'];

if ($method == 'GET') {
    $stmt = $pdonotes->query("SELECT * FROM notes");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
}

if ($method == 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdonotes->prepare("INSERT INTO notes (title, content, username) VALUES (?, ?, ?)");
    $stmt->execute([$data['title'], $data['content'], $data['username']]);
    echo json_encode(["status" => "success"]);
}

if ($method == 'PUT') {
    $data = json_decode(file_get_contents("php://input"), true);
    $stmt = $pdonotes->prepare("UPDATE notes SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$data['title'], $data['content'], $data['id']]);
    echo json_encode(["status" => "success"]);
}

if ($method == 'DELETE') {
    parse_str(file_get_contents("php://input"), $data);
    $stmt = $pdonotes->prepare("DELETE FROM notes WHERE id = ?");
    $stmt->execute([$data['id']]);
    echo json_encode(["status" => "success"]);
}
?>
