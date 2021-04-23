<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'sid1@44jym');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = 'SELECT `joketext` FROM `joke`';
  $result = $pdo->query($sql);

  while ($row = $result->fetch()) {
    $jokes[] = $row['joketext'];
  }
} catch (PDOException $e) {
  $output = '데이터베이스 오류.:' . $e->getMessage() . '위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/jokes.html.php'
?>
