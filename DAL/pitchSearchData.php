<?php
require_once __DIR__ . '/connect_database.php';
require_once __DIR__ . '/../MODEL/football_pitches_model.php';
require_once __DIR__ . '/../MODEL/order_model.php';

class PitchSearchDAL {
    public function getPitch() {
        $pitch = [];
        $conn = getConnection();
        $data = $conn->query("SELECT * FROM football_pitches");
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $pitch[] = new football_pitches($row['id'], $row['name'], $row['time_start'], $row['time_end'], $row['description'], $row['price_per_hour'], $row['price_per_peak_hour'], $row['is_maintenance'], $row['pitch_type_id'], $row['created_at'], $row['updated_at']);
            }
        }
        $conn->close();
        return $pitch;
    }

    public function getOrder() {
        $order = [];
        $conn = getConnection();
        $data = $conn->query("SELECT * FROM orders");
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $order[] = new order_model($row['id'], $row['name'], $row['phone'], $row['email'], $row['deposit'], $row['code'], $row['start_at'], $row['end_at'], $row['total'], $row['status'],$row['note'], $row['user_id'], $row['football_pitch_id'], $row['created_at'], $row['updated_at']);
            }       
        }
        $conn->close();
        return $order;
    }

    public function getPitchById($id){
        $conn = getConnection();
        $data = $conn->query("SELECT * FROM football_pitches WHERE id = $id");
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $order[] = new order_model($row['id'], $row['name'], $row['phone'], $row['email'], $row['deposit'], $row['code'], $row['start_at'], $row['end_at'], $row['total'], $row['status'],$row['note'], $row['user_id'], $row['football_pitch_id'], $row['created_at'], $row['updated_at']);
            }       
        }
        $conn->close();
        return $order;
    }

    public function getPitchByName($name){
        $pitch = [];
        $conn = getConnection();
        $data = $conn->query("SELECT * FROM football_pitches WHERE name LIKE'%".$name."%'");
        if ($data->num_rows > 0) {
            while ($row = $data->fetch_assoc()) {
                $pitch[] = new football_pitches($row['id'], $row['name'], $row['time_start'], $row['time_end'], $row['description'], $row['price_per_hour'], $row['price_per_peak_hour'], $row['is_maintenance'], $row['pitch_type_id'], $row['created_at'], $row['updated_at']);
            }
        }
        $conn->close();
        return $pitch;
    }

   public function getImage($id) {
    $conn = getConnection();
    $sql = "SELECT image FROM football_pitch_details WHERE football_pitch_id = $id LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['image'];
    } else {
        return 'img/pitch.jpg';
    }
}

}