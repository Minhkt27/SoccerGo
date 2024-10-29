<?php
    require_once __DIR__ . '/../DAL/pitchManageData.php';
    require_once __DIR__ . '/../DAL/connect_database.php';
    require_once __DIR__ .'/../MODEL/football_pitches_model.php';
    function getDataPitchforTable() {
        $result = [];
        $result = getDataPitch();
        return $result;
    }
    function checkAddingPitch( $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at){
        $conn = getConnection();  
        if(empty($name)||empty($time_start)||empty($time_end)||empty($description)||empty($price_per_hour)||empty($price_per_peak_hour)||empty($is_maintenance)||empty($pitch_type_id)){
            echo '<script type = "text/javascript"> alert("Hãy điển đầy đủ các trường thông tin"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $price_per_hour)){
            echo '<script type = "text/javascript"> alert("Dữ liệu giá trên giờ không hợp lệ"; location.replace("dashboard_admin.php?pg=pitchManage); </script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $price_per_peak_hour)){
            echo '<script type = "text/javascript"> alert("Dữ liệu giá trên giờ cao điểm không hợp lệ"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $is_maintenance)){
            echo '<script type = "text/javascript"> alert("Dữ liệu số lần bảo trì không hợp lệ"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $pitch_type_id)||$pitch_type_id>5|| $pitch_type_id< 1){
            echo '<script type = "text/javascript"> alert("Dữ liệu loại sân không hợp lệ (1->5)"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        AddPitchToData( $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id, $created_at, $updated_at);
        
        $conn->close();   
        
    }
    function checkUpdatePitch($id, $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id,  $updated_at){
        $conn = getConnection();
        if(empty($id)||empty($name)||empty($time_start)||empty($time_end)||empty($description)||empty($price_per_hour)||empty($price_per_peak_hour)||empty($is_maintenance)||empty($pitch_type_id)||empty($updated_at)){
            echo '<script type = "text/javascript"> alert("Hãy điển đầy đủ các trường thông tin"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $price_per_hour)){
            echo '<script type = "text/javascript"> alert("Dữ liệu giá trên giờ không hợp lệ"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $price_per_peak_hour)){
            echo '<script type = "text/javascript"> alert("Dữ liệu giá trên giờ cao điểm không hợp lệ"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $is_maintenance)){
            echo '<script type = "text/javascript"> alert("Dữ liệu số lần bảo trì không hợp lệ"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        if(!preg_match('/^\d+$/', $pitch_type_id)||$pitch_type_id>5|| $pitch_type_id< 1){
            echo '<script type = "text/javascript"> alert("Dữ liệu loại sân không hợp lệ (1->5)"); location.replace("dashboard_admin.php?pg=pitchManage");</script>';
            exit();
        }
        $query = "SELECT * FROM football_pitches";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()){
            if($id== $row["id"]){
               UpdatePitch($id, $name, $time_start, $time_end, $description, $price_per_hour, $price_per_peak_hour, $is_maintenance, $pitch_type_id,  $updated_at);
                    
                
             }
          }
          $conn->close();
    }
    function checkDelete($id){
        $conn = getConnection();
        $query = "SELECT * FROM football_pitches";
        $result = $conn->query($query);
        while($row = $result->fetch_assoc()) {
            if($id===$row["id"]){
                DelId($id);
            }
        }
    }
    function checkPic($id) {
        return Getpic($id);
    }
    function getName(){
        $result = [];
        $result = getNamefromData();
        return $result;
    }
    
    function getNameByID($id){
        $result = [];
        $result = getPitchNameFromDatabase($id);
        return $result['name'];
    }

    function getID($name){
        $result = getPitchIdByName($name);
        return $result;
    }
    function ThemAnh($hinhAnh, $id){
    if (ThemAnhDaTa($hinhAnh, $id)) {
        return true;
    }
    return false;
}