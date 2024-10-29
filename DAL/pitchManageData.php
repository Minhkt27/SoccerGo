<?php
require_once 'connect_database.php';
require_once __DIR__ . '/../MODEL/football_pitches_model.php';

function getDataPitch(){
    $conn = getConnection();
    $sql = "SELECT * FROM football_pitches";
    $result = $conn->query($sql);
    
    if ($result === false) {
        die("Error in query: " . $conn->error);
    }
    
    $conn->close();
    return $result;
}

function AddPitchToData($name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at) {
    $conn = getConnection();
    try {
        // Prepare the SQL query with placeholders
        $query = "INSERT INTO football_pitches(name, time_start, time_end, description, price_per_hour, price_per_peak_hour, is_maintenance, pitch_type_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        // Prepare the statement
        $stmt = $conn->prepare($query);

        // Bind parameters with types
        // 'ssssddiiss' corresponds to 10 parameters: 9 strings and 1 integer
        $stmt->bind_param('ssssddiiss', $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Handle any exceptions
        $errorMessage = "Lỗi: " . $e->getMessage();
    }
    
    // Close the connection
    $conn->close();
}

function UpdatePitch($id, $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $updated_at){
    $conn = getConnection();
    $query = "UPDATE football_pitches SET name = '$name', time_start = '$time_start', time_end = '$time_end', description = '$description', price_per_hour = '$price_per_hour', price_per_peak_hour = '$price_per_peak_hour', is_maintenance = '$is_maintenance', pitch_type_id = '$pitch_type_id', updated_at = '$updated_at' WHERE id = '$id'";
    if ($conn->query($query) === false) {
        
    }
    $conn->close();
}

function DelId($id){
    $conn = getConnection();
    $query = "DELETE FROM football_pitches WHERE id = '$id'";
    if ($conn->query($query) === false) {
        
    }
    $conn->close();
}
function Getpic($id) {
    $conn = getConnection();
    $query = "SELECT * FROM football_pitch_details WHERE football_pitch_id = '$id' ";
    $result = $conn->query($query);
    $images = []; 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $images[] = $row['image']; 
        }
    }
    return $images;
}
function getNamefromData(){
    $conn = getConnection();
    $query = 'SELECT * from football_pitches';
    $ans = [];
    $result = $conn->query($query);
    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $ans['name'] = $row['name'];
        }
    }
    return $ans;
}

function getPitchNameFromDatabase($id){
    $conn = getConnection();
    $sql = "SELECT name FROM football_pitches WHERE id = '$id'";
    $result = $conn->query($sql);
    
    if ($result === false || $result->num_rows == 0) {
        $conn->close();
        return null; 
    }
    
    $data = $result->fetch_assoc();
    $conn->close();
    return $data;
}


function getPitchIdByName($name){
    $conn = getConnection();
    $sql = "SELECT id from football_pitches WHERE name LIKE '$name'" ;
    $result = $conn->query($sql);
    
    if ($result === false) {
        die("Error in query: " . $conn->error);
    }
    
    $conn->close();
    return $result;
}
function ThemAnhDaTa($hinhAnh, $id){
    $conn = getConnection();
    $sql = "INSERT INTO football_pitch_details (id, image, football_pitch_id, created_at, updated_at) VALUES ('', '$hinhAnh', $id, '', '')";
    $result = $conn->query($sql);
    if ($result === false) {
        die("Error in query: " . $conn->error);
    }
    $conn->close();
    return true;
}