<?php
include 'config.php';

$sql = "SELECT players.name, AVG(rankings.rank) as average_rank FROM rankings
        JOIN players ON rankings.player_id = players.id
        GROUP BY players.id ORDER BY average_rank DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "Player: " . $row["name"]. " - Average Rank: " . $row["average_rank"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const items = document.querySelectorAll('.draggable');
    items.forEach(item => {
        item.addEventListener('dragstart', () => {
            item.classList.add('dragging');
        });

        item.addEventListener('dragend', () => {
            item.classList.remove('dragging');
        });
    });

    const container = document.querySelector('.draggable-container');
    container.addEventListener('dragover', e => {
        e.preventDefault();
        const afterElement = getDragAfterElement(container, e.clientY);
        const dragging = document.querySelector('.dragging');
        if (afterElement == null) {
            container.appendChild(dragging);
        } else {
            container.insertBefore(dragging, afterElement);
        }
    });

    function getDragAfterElement(container, y) {
        const draggableElements = [...container.querySelectorAll('.draggable:not(.dragging)')];
        return draggableElements.reduce((closest, child) => {
            const box = child.getBoundingClientRect();
            const offset = y - box.top - box.height / 2;
            if (offset < 0 && offset > closest.offset) {
                return { offset: offset, element: child };
            } else {
                return closest;
            }
        }, { offset: Number.NEGATIVE_INFINITY }).element;
    }
});
</script>
