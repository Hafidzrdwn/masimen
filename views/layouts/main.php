<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MASIMEN - <?php View::yield('title'); ?></title>
</head>

<body>

  <header>
    <h1>MASIMEN TEST</h1>
  </header>

  <main>
    <?php View::yield('content'); ?>
  </main>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> MASIMEN.</p>
  </footer>

</body>

</html>