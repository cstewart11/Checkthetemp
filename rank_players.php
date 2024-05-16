<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rank Players</title>
</head>
<body>
    <h2>Rank Players</h2>
    <form action="rank_players.php" method="post">
        <!-- Add form fields for each player here -->
        <label for="player1">Player One:</label>
        <input type="number" id="player1" name="player1_rank" min="1" max="100" required><br>
        <!-- Repeat for other players -->
        <button type="submit">Submit Rankings</button>
    </form>
</body>
</html>

<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $player1_rank = $_POST['player1_rank'];
    // Add more player ranks as needed

    $stmt = $conn->prepare("INSERT INTO rankings (user_id, player_id, rank) VALUES (?, ?, ?)
                            ON DUPLICATE KEY UPDATE rank = ?");
    $stmt->bind_param("iiii", $user_id, $player_id, $rank, $rank);

    // Repeat for each player
    $player_id = 1;
    $rank = $player1_rank;
    $stmt->execute();

    $stmt->close();
    $conn->close();
}
?>
