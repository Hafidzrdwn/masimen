<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MASIMEN - <?php yield_section('title'); ?></title>
</head>

<body>

  <header>
    <h1>MASIMEN TEST</h1>
  </header>

  <main>
    <?php yield_section('content'); ?>
  </main>

  <footer>
    <p>&copy; <?php echo htmlspecialchars(date('Y'), ENT_QUOTES, 'UTF-8'); ?> MASIMEN.</p>
  </footer>

</body>

</html>