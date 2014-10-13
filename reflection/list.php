<form action="reflection/insert.php" method="post">
    <div>
        <label>Tytuł:</label>
        <input type="text" name="title" />
    </div>
    <div>
        <label>Refleksja:</label>
        <textarea name="reflection"></textarea>
    </div>
    <button type="submit">Dodaj</button>
</form>

<?php

    $con = mysqli_connect("127.0.0.1", "user", "pass", "baza");// Check connection
    if (mysqli_connect_errno()) {
      echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $result = mysqli_query($con, "SELECT * FROM Reflection");
?>
    
<?php while ($row = mysqli_fetch_array($result)) { ?>
    <div>
        <h6><?= $row['title'] ?></h6>
        <p><?= $row['description'] ?></p>
    </div>
<?php } ?>