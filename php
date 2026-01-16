<?php
// Khởi tạo biến kết quả rỗng
$result = "";
$message = "";

// Kiểm tra xem người dùng có bấm nút gửi dữ liệu không (Phương thức POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy dữ liệu từ ô input
    $input1 = isset($_POST['input1']) ? floatval($_POST['input1']) : 0;
    $input2 = isset($_POST['input2']) ? floatval($_POST['input2']) : 0;
    
    // Lấy tên hành động (nút nào được bấm)
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    switch ($action) {
        case 'calcArea': // 1. Diện tích
            $res = $input1 * $input2;
            $message = "Diện tích (Input1 x Input2): $res";
            break;

        case 'calcPerimeter': // 2. Chu vi
            $res = ($input1 + $input2) * 2;
            $message = "Chu vi ((Input1 + Input2) * 2): $res";
            break;

        case 'calcAverage': // 3. Trung bình
            $res = ($input1 + $input2) / 2;
            $message = "Trung bình cộng: $res";
            break;

        case 'findMax': // 4. Tìm Max
            $res = ($input1 > $input2) ? $input1 : $input2;
            $message = "Số lớn nhất là: $res";
            break;

        case 'calcBMI': // 5. BMI (Input1: Chiều cao, Input2: Cân nặng)
            // Giả sử Chiều cao nhập mét (ví dụ 1.75)
            if ($input1 > 0) {
                $bmi = $input2 / ($input1 * $input1);
                $message = "Chỉ số BMI: " . round($bmi, 2);
            } else {
                $message = "Chiều cao phải lớn hơn 0!";
            }
            break;

        case 'calcTime': // 6. Đổi ra phút (Input1: Giờ, Input2: Phút)
            $total = ($input1 * 60) + $input2;
            $message = "$input1 giờ $input2 phút = $total phút";
            break;
            
        default:
            $message = "Vui lòng chọn phép tính.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài Tập PHP 6 Phép Tính</title>
    <style>
        /* Giữ nguyên CSS như cũ cho đẹp */
        body { font-family: Arial, sans-serif; background: #f0f2f5; display: flex; justify-content: center; min-height: 100vh; margin-top: 50px; }
        .container { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); width: 400px; height: fit-content; }
        h2 { text-align: center; color: #333; }
        input { width: 100%; padding: 10px; margin-bottom: 10px; border: 1px solid #ddd; border-radius: 5px; box-sizing: border-box; }
        .buttons { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; }
        button { padding: 10px; border: none; border-radius: 5px; background: #007bff; color: white; cursor: pointer; }
        button:hover { background: #0056b3; }
        .btn-bmi { background: #28a745; }
        .btn-time { background: #ffc107; color: black; }
        #result-area { margin-top: 20px; padding: 15px; background: #e9ecef; border-radius: 5px; text-align: center; font-weight: bold; color: #333; }
    </style>
</head>
<body>

    <div class="container">
        <h2>Công cụ tính toán (PHP)</h2>
        
        <form method="POST" action="">
            <div class="input-group">
                <label>Input 1</label>
                <input type="number" step="any" name="input1" value="<?php echo isset($_POST['input1']) ? $_POST['input1'] : ''; ?>" required placeholder="Nhập số...">
                
                <label>Input 2</label>
                <input type="number" step="any" name="input2" value="<?php echo isset($_POST['input2']) ? $_POST['input2'] : ''; ?>" required placeholder="Nhập số...">
            </div>

            <div class="buttons">
                <button type="submit" name="action" value="calcArea">1. Tính Diện Tích</button>
                <button type="submit" name="action" value="calcPerimeter">2. Tính Chu Vi</button>
                <button type="submit" name="action" value="calcAverage">3. Tính Trung Bình</button>
                <button type="submit" name="action" value="findMax">4. Tìm Max</button>
                <button class="btn-bmi" type="submit" name="action" value="calcBMI">5. Tính BMI</button>
                <button class="btn-time" type="submit" name="action" value="calcTime">6. Tính Tổng Phút</button>
            </div>
        </form>

        <div id="result-area">
            <?php 
                if ($message != "") {
                    echo $message;
                } else {
                    echo "Kết quả sẽ hiện ở đây";
                }
            ?>
        </div>
    </div>

</body>
</html>
