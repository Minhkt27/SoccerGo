<?php
    require_once '../DAL/connect_database.php';

    function getPitchDetailsById($pitch_id) {
        $conn = getConnection();
        $query = "SELECT image FROM FOOTBALL_PITCH_DETAILS WHERE football_pitch_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $pitch_id);
        $image_array = null;
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $image_array[] = $row['image'];
                }
            }
        }
        $stmt->close();
        $conn->close();
        return $image_array;
    }

    