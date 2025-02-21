<?php View::extend('main'); ?>

<?php View::startSection('title'); ?>
Test Data
<?php View::endSection(); ?>

<?php View::startSection('content');

$data = $query->raw('SELECT JURUSAN, FAKULTAS FROM `jurusan` JOIN fakultas ON jurusan.ID_FAKULTAS = fakultas.ID_FAKULTAS;')->get();

?>
<h2>Data Jurusan</h2>
<table border="1">
  <thead>
    <tr>
      <th>No</th>
      <th>Kode Jurusan</th>
      <th>Nama Jurusan</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $key => $d) : ?>
      <tr>
        <td><?= $key + 1 ?></td>
        <td><?= $d['FAKULTAS'] ?></td>
        <td><?= $d['JURUSAN'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php View::endSection(); ?>