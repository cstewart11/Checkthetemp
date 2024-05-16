<?php
include 'config.php';

$sql = "SELECT users.username, players.name, rankings.rank FROM rankings
        JOIN users ON rankings.user_id = users.id
        JOIN players ON rankings.player_id = players.id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Username: " . $row["username"]. " - Player: " . $row["name"]. " - Rank: " . $row["rank"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>
