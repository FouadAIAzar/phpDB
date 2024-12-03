<?php
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: login.php");
        exit;
    }
    require_once "pdo.php";
    $fetchALL = "SELECT * FROM autos";
    $stmt1 = $pdo->query($fetchALL);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST["make"]) && isset($_POST["year"]) && isset($_POST["mileage"])) {
            $sql = "INSERT INTO autos (make, year, mileage) VALUES (:make, :year, :mileage)";
            $stmt2 = $pdo->prepare($sql);
            $stmt2->execute([
                ":make" => $_POST["make"], 
                ":year" => $_POST["year"], 
                ":mileage" => $_POST["mileage"]
            ]);
            // Redirect to the same page to clear POST data
            header("Location: " . $_SERVER['PHP_SELF']);
            exit;
        }
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
        $sql = "DELETE FROM autos WHERE auto_id = :id";
        $stmt3 = $pdo->prepare($sql);
        $stmt3->execute([':id' => $_POST['delete_id']]);
        // Redirect to the same page to clear POST data
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fouad Azar</title>
</head>
<body>
    <h1>Autos Database</h1>
    <h2>Registration</h2>
        <form method="post">
            <p>Make: <input type="text" name="make"></p>
            <p>Year: <input type="text" name="year"></p>
            <p>Mileage: <input type="text" name="mileage"></p>
            <p><input type="submit" value="Add"></p>
        </form>
    <h2>Automobiles</h2>
    <pre>
        <table>
            <tr>
                <th>Make </th>
                <th>Year</th>
                <th>Mileage</th>
                <th>Delete</th>
            </tr>
    <?php 
        while ($row = $stmt1->fetch(PDO::FETCH_ASSOC)) {

            echo "<tr>";
                echo "<td>" . htmlentities($row['make']) . "</td>";
                echo "<td>" . htmlentities($row['year']) . "</td>";
                echo "<td> " . htmlentities($row['mileage']) . "</td>";
                echo "<td><form method='post'><input type='hidden' name='delete_id' value='" . $row['auto_id'] . "'><input type='submit' value='Delete'></form></td>";
            echo "</tr>";

        }
    ?>
        </table>
    </pre>
</body>
</html>