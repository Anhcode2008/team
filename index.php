<?php
// team5.php
// Gọi: team5.php?uid=123456789&team=5

header("Content-Type: application/json; charset=utf-8");

// Lấy tham số
$uid  = isset($_GET["uid"]) ? $_GET["uid"] : null;
$team = isset($_GET["team"]) ? $_GET["team"] : 5;

if (!$uid) {
    echo json_encode([
        "status" => "error",
        "message" => "Thiếu uid! Gọi: team.php?uid=123&team=5"
    ]);
    exit;
}

// Kiểm tra team hợp lệ
if (!in_array($team, [3,4,5,6])) {
    echo json_encode([
        "status" => "error",
        "message" => "team phải là 3,4,5 hoặc 6"
    ]);
    exit;
}

// Đường dẫn tới file team.py
$pythonFile = __DIR__ . "/team.py";

// Lệnh chạy Python
$cmd = "python3 $pythonFile $uid $team 2>&1";

// Chạy và lấy output
exec($cmd, $output, $return_var);

echo json_encode([
    "status" => $return_var === 0 ? "success" : "error",
    "uid" => $uid,
    "team" => $team,
    "output" => $output
], JSON_UNESCAPED_UNICODE);
