# MySQL 기초 1편

## 데이터베이스와 MySQL워크밴치

 데이터베이스가 어떤 역할을 하고 MySQL 데이터베이스의 사용 방법과 쿼리 언어를 공부한다. 쿼리언어는 데이터베이스를 쉽게 이용할 수 있도록 만든 고수준 언어이다.

## 1. MySQL 워크밴치로 SQL쿼리 실행

### 1.1. DB접속 정보

* 서버주소
* 사용자명
* 비밀번호

### 1.2. 커넥션

1. +버튼을 눌러 커넥션을 추가한다. 커넥션명을 지정하고 서버 주소와 사용자명을 입력.

2. Schemas 항목에 주목한다. 스키마는 데이터베이스를 지칭하는 또 다른 표현이다. 스키마패널에 마우스 오른쪽 클릭 후  'Create schema' 메뉴를 클릭한다.
3. 다른 설정은 신경쓰지말고 스키마명을 입력한다.
4. Aply 버튼을 누르면 CREATE SCHEMA &#96;ijdb&#96;; 구문을 확인할 수 있다.
5. 다시 Aply 버튼을 누루고 Finish버튼을 누르면 완성이다.
6. 생성된 스키마를 더블클릭하면 굵은 글씨로 변한다. 이제부터 해당 스키마를 사용한다는 표시이다.
7. ijdb를 펼치고 Tables 항목에서 마우스 오른쪽 버튼으로 Create Table 메뉴를 선택한다.
8. 숫자, 텍스트, 날짤/시간 이 세가지 타입을 주로 사용한다. Table Name(joke)을 입력하고 다음 칼럼들을 추가한다. id, joketext, jokedate. 칼럼명을 입력하여 추가할 수 있다. id필트의 PK, NN, AI 패널을 선택한다. 각 **데이터타입을 잘 입력한다.** 
9. Aply 버튼을 눌러 마무리한다. 나중에는 php를 사용해 쿼리를 실행한다. 연습차원에서 미리 해보는 것이다.
10. 테이블 이름에서 마우스 오른쪽 버튼을 클릭하고 Selest Rows - limit 1000 메뉴를 선택한다.

## 2. 쿼리 명령어

SELECT * FROM ijdb.joke; 구문이 보일 것이다. 이 영역이 문자열을 입력하는 공간이고 명령어를 작성할 수 있다. 

### 2.1 데이터 추가

````mysql
INSERT INTO joke
(joketext, jokedate) VALUES (
"프로그래머 남편이 우유를 10개 사왔다. 우유사면서 개란 있으면 10개 사오라고 했는데.",
"2017-06-01")
````

DATA TOO LONG 에러가 떴다. 칼럼 데이터 타입 설정을 해주지 않았기 때문이다.

입력을 마치고 번개표시를 마치면 쿼리가 실행된다.

### 2.2 데이터 조회

```mysql
SELECT * FROM `joke`
```

백틱이라는 따옴표가 joke를 감싸고 있다. 앞으로 모든 테이블, 스키마, 칼럼의 이름을 백틱으로 감싸도록한다.

#### ex)

```mysql
INSERT INTO `joke`
(`joketext`, `jokedate`) VALUES (
"?",
"2017-06-01")
```



모든 칼럼을 의미하는 * 문자 대신 원하는 칼럼을 직접 나열할 수 있다.

```mysql
SELECT `id`, `jokedate` FROM `joke`
```

이처럼 id와 date만 가져올 수 있다.



```mysql
SELECT `id`, LEFT(`joketext`, 20), `jokedate` FROM `joke`
```

이것은 본문중 일부만 보이도록 한 것이다. LEFT문을 사용하면 된다.



```mysql
SELECT `joketext` FROM `joke` WHERE `joketext` LIKE "%프로그래머%"
```

특정 텍스트를 포함한 엔트리만 가져오는 쿼리이다. WHERE 과 LIKE 에 주목한다.



### 2.3 데이터 수정

```mysql
UPDATE `joke` SET `jokedate` = "2018-04-01" WHERE id = "1"
```

id 칼럼을 유용하게 사용하여 데이터를 수정할 수 있다.

```mysql
UPDATE `joke` SET `jokedate` = "2018-04-01" WHERE `joketext` LIKE "%ANNE%"
```

이 코드를 이용하여 특정 단어를 가지고있는 엔트리를 수정할 수 있다. 하지만 특정 에러가 리턴된다. 안전 업데이트 모드라서 그렇다. 따라서 아래의 코드를 입력한다.

1. set sql_safe_updates=0; 일시적으로 해제한다.
2. Workbench Preferences에서 안전모드(Safe mode)를 해제한다.
   아래의 그림에 있는 부분에서 체크를 해제한후에 다시 workbench를 시작한다.
   (이렇게 하면 항상 Safe모드가 해제된 상태임)

### 2.4 데이터 삭제

```mysql
DELETE FROM `joke` WHERE id = "5"
```

```mysql
DELETE FROM `joke` WHERE `joketext` LIKE "%HELP%"
```

위와 같은 방법으로 데이터 삭제가 가능하다. 

다음 명령어 한 줄이면 데이터베이스를 깨끗하게 비울 수 있다.

```mysql
DELETE FROM `joke`
```

어마무시한 쿼리이다.

## 3 PHP를 통한 쿼리 실행, 데이터 웹 출력

PHP스크립트를 실행한 뒤 본문을 입력하면 스크립트가 적절한 INSERT 쿼리를 완성하여 MySQL 서버로 전송한다. 나중에 가면 SQL을 실제로 직접 작성할 일이 별로 없다.

### 3.1 MySQL 사용자 계정 생성

1. 워크밴치 Users and Privileges를 선택한다. (Administration 항목)
2. Add Account 버튼을 클릭한다. username과 password를 입력하고 나머지는 기본값으로 둔다.
3. Limit to Hosts Matching을 localhost 로 한다. 임의의 사용자가 아무 위치에서나 DB에 접속 할 수 없게 한다.
4. Aply 버튼을 누루고 Schema Privieges 탭에서 Add Entry 버튼을 클릭하여 신규 사용자에서 ijdb 접근 권한을 부여한다. selected schema 라디오버튼을 체크하고 목록에서 ijdb를 선택하면 된다.
5. 하단 영역의 체크박으를 모두 체크한다. 권한 목록이다. 그리고 마지막으로 Aply를 클릭한다.

### 3.2 PHP를 이용하여 MySQL 접속

MySQL에 접속하는 세 가지 방법이 있다. 하지만 두 개는 오래된 방법이고 지금은 가장 최신 도구인 PDO(PHP Data Object) 를 사용할 것이다.

```php+HTML
<?php
$pdo = new PDO('mysql:host=호스트명;dbname=데이터베이스명',
   '사용자명', '비밀번호');
```

위의 new PDO() 구문은 rand() 과 같은 PHP에 내장된 함수라고 보면 된다. POD문으로 데이터베이스 접속을 한다.



```php+HTML
<?php 
try {
    #예외가 발생하는 작업
} catch (\Exception $e) {
    #예외 처리
}
```

위의 코드는 $pdo 변수를 실행하고 예외를 처리하기위한 일종의 장치라고 보면 된다. 



결합된 모습을 봐보자.

```php+HTML
<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'mypassword');
  $outpup = '데이터베이스 접속 성공.';
} catch (PDOException $e) {
  $outpup = '데이터베이스 서버에 접속할 수 없습니다.' . $e;
}
include __DIR__ . '/../templates/output.html.php'

?>
```

뒤에 include문의 템플릿이 없는 이상 완전한 코드가 아니다. 곧 추가하게 될 것이다.

```php+HTML
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>출력내용</title>
  </head>
  <body>
    <?= $output; ?>
  </body>
</html>

```

이것이 템플릿이다.

종합적으로 보면 현재까지는 접속한 이후에 문제가 발생하면 PDO는 기본적으로 '오류숨김' 상태로 오류를 처리한다. 때문에 setAttribute() 메서드를 호출하여 오류 처리 방식을 지정한다. setAttribute는 속성을 설정한다.

#### 3.2.1 MySQL1-Connect.php

```php+HTML
<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'sid1@44jym');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $output = '데이터베이스 접속 성공.';
} catch (PDOException $e) {
  $output = '데이터베이스 서버에 접속할 수 없습니다.' . $e;
}

include __DIR__ . '/../templates/output.html.php'
?>

```

#### 3.2.2 MySQL2-Create.php

```php+HTML
<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'sid1@44jym');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $table = 'test3'; //이곳에 테이블 명을 입력한다. 그리고 변수로 9줄에 테이블 명을 변수로 하려고 했으나 방법을 못찾았다.

  $sql = 'CREATE TABLE test3 (
      id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
      joketext TEXT,
      jokedate DATE NOT NULL
  ) DEFAULT CHARACTER SET utf8 ENGINE=InnoDB';

  $pdo->exec($sql);

  $output = $table . '테이블 생성 완료.';
} catch (PDOException $e) {
  $output = '데이터베이스 오류.:' . $e->getMessage() . '위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/output.html.php'
?>
```

#### 3.2.3 MySQL3-Update.php

```php+HTML
<?php
try {
  $pdo = new PDO('mysql:host=localhost;dbname=ijdb',
   'ijdbuser', 'sid1@44jym');
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $table = 'test3';

  $sql = 'UPDATE joke SET jokedate="2012-04-01"
      WHERE joketext LIKE "%프로그래머%"';

  $affectedRows = $pdo->exec($sql);

  $output = '갱신된 row: ' . $affectedRows .'개.';
} catch (PDOException $e) {
  $output = '데이터베이스 오류.:' . $e->getMessage() . '위치: ' .
  $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/output.html.php'
?>
```

#### 3.2.4 MySQL4-Select.php

```php+HTML
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
```

글 목록을 불러오는 코드이다. jokes 템플릿이 필요하다. while문을 이용하여 fetch 메서드로 글목록을 조회하는 코드를 짰다. 아직 이해는 잘 되지 않는다.

```php+HTML
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>유머 글 목록</title>
  </head>
  <body>
    <?php if (isset($error)): ?>
      <p>
      <?php echo $error; ?>
      </p>
    <?php else: ?>
      <?php foreach ($jokes as $joke): ?>
        <blockquote>
          <p>
            <?php echo htmlentities($joke, ENT_QUOTES, 'utf-8'); ?>
          </p>
        </blockquote>
      <?php endforeach; ?>
    <?php endif; ?>
  </body>
</html>

```

이게 jokes템플릿이다. html에서 php코드를 다른 양식으로 작성하여 가독성을 높힌다.

