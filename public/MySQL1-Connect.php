<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'sid1@44jym');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //이것은 setAttribute 메서드를 호출하여 오류 처리 방식을 지정함.
  $output = '데이터베이스 접속 성공.';
} catch (PDOException $e) {
  $output = '데이터베이스 서버에 접속할 수 없습니다.' . $e;
}

include __DIR__ . '/../templates/output.html.php';
?>
