<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'sid1@44jym');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $table = 'test6'; //이곳에 테이블 명을 입력한다. 그리고 변수로 9줄에 테이블 명을 변수로 하려고 했으나 방법을 못찾았다. 찾았다!! 9~13 라인을 감싸는 부분이 '' 여서 함수로 인식을 못했지만 php는 "" 로 감싸져있는 부분은 함수를 인지할 수 있다! 2021-03-18

  $sql = "CREATE TABLE $table (
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      joketext TEXT,
      jokedate DATE NOT NULL
  ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB";

  $pdo->exec($sql);

  $output = $table . '테이블 생성 완료.';
} catch (PDOException $e) {
  $output = '데이터베이스 오류.:' . $e->getMessage() . '위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/output.html.php'
?>
