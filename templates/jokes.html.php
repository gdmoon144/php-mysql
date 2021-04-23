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
