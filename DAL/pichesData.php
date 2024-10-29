<?php
    require_once '../DAL/connect_database.php';

    function getPitchById($pitch_id) {
        $conn = getConnection();
        $query = "SELECT p.*, t.quantity, t.description as type_note FROM football_pitches p JOIN PITCH_TYPES t ON p.pitch_type_id = t.id WHERE p.id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $pitch_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $pitch = $result->fetch_assoc();
        $stmt->close();
        $conn->close();
        return $pitch;
    }

    function getDiscountByCode($code) {
    $conn = getConnection();
    $sql = $conn->prepare("SELECT * FROM discounts WHERE code = ?");
    $sql->bind_param("s", $code);
    $sql->execute();
    $result = $sql->get_result();

    $discount = $result->fetch_assoc();
    $conn->close();

    return $discount;
}