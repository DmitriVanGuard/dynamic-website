<?php

$sql = 'SELECT id, genre FROM genres';
$result = $pdo->query($sql);

while( $row = $result->fetch(PDO::FETCH_OBJ) ):
?>
  <option value=<?php echo $row->id; ?>><?php echo $row->genre; ?></option>
<?php endwhile; ?>
