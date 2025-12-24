<?php
$db = new Database();

$q = "";
$sql_where = "";
if (isset($_GET['q']) && !empty($_GET['q'])) {
    $q = $_GET['q'];
    $sql_where = " WHERE judul LIKE '%{$q}%'";
}

$per_page = 5; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $per_page;

$sql_count = "SELECT COUNT(*) as total FROM artikel" . $sql_where;
$result_count = $db->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_data = $row_count['total'];
$num_page = ceil($total_data / $per_page);

$sql_data = "SELECT * FROM artikel" . $sql_where . " LIMIT $offset, $per_page";
$data = $db->query($sql_data);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Artikel</title>
    <style>
        body { font-family: "Segoe UI", Arial, sans-serif; background: #f2f4f7; margin: 20px; color: #2c3e50; }
        .container { background: #fff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); max-width: 1100px; margin: auto; }
        h3 { color: #3a6ea5; }
        
        .action-link { display: inline-block; background: #4a90e2; color: #fff; padding: 8px 15px; border-radius: 20px; text-decoration: none; font-size: 14px; margin-bottom: 20px; }
        
        .search-form { margin-bottom: 20px; }
        .search-form input[type="text"] { padding: 8px; width: 250px; border: 1px solid #ccc; border-radius: 4px; }
        .search-form input[type="submit"] { padding: 8px 15px; background: #4a90e2; color: white; border: none; border-radius: 4px; cursor: pointer; }

        table { width: 100%; border-collapse: collapse; }
        table th { background: #dbe9f6; padding: 12px; text-align: left; }
        table td { padding: 12px; border-bottom: 1px solid #ddd; }
        
        ul.pagination { display: inline-block; padding: 0; margin-top: 25px; list-style: none; }
        ul.pagination li { display: inline; }
        ul.pagination li a { color: black; float: left; padding: 8px 16px; text-decoration: none; border: 1px solid #ddd; margin: 0 4px; border-radius: 4px; }
        ul.pagination li a.active { background-color: #428bca; color: white; border: 1px solid #428bca; }
        ul.pagination li a:hover:not(.active) { background-color: #ddd; }
    </style>
</head>
<body>
    <div class="container">
        <h3>Daftar Artikel</h3>
        <a href="tambah.php" class="action-link">+ Tambah Artikel</a>

        <form action="" method="get" class="search-form">
            <label for="q">Cari data: </label>
            <input type="text" id="q" name="q" value="<?= htmlspecialchars($q); ?>" placeholder="Masukkan judul...">
            <input type="submit" value="Cari">
        </form>

        <table>
            <tr>
                <th>Judul</th>
                <th>Isi Artikel</th>
            </tr>
            <?php if ($data && $data->num_rows > 0): ?>
                <?php while ($row = $data->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['judul']); ?></td>
                    <td><?= htmlspecialchars($row['isi']); ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="2">Data tidak ditemukan.</td></tr>
            <?php endif; ?>
        </table>

        <ul class="pagination">
            <?php if ($page > 1): ?>
                <li><a href="?page=<?= $page - 1; ?>&q=<?= $q; ?>">&laquo; Previous</a></li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $num_page; $i++): ?>
                <li><a class="<?= ($page == $i) ? 'active' : ''; ?>" href="?page=<?= $i; ?>&q=<?= $q; ?>"><?= $i; ?></a></li>
            <?php endfor; ?>

            <?php if ($page < $num_page): ?>
                <li><a href="?page=<?= $page + 1; ?>&q=<?= $q; ?>">Next &raquo;</a></li>
            <?php endif; ?>
        </ul>
    </div>
</body>
</html>
