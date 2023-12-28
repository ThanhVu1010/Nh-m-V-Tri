<?php
include_once('Controller/cMenu.php');
$menu = new controlMenu();

// Lấy ngày hiện tại
$date = new DateTime();
$currentDate = $date->format('Y-m-d');

function getDayInVietnamese($day) {
    $daysOfWeek = [
        'Monday' => 'Thứ hai',
        'Tuesday' => 'Thứ ba',
        'Wednesday' => 'Thứ tư',
        'Thursday' => 'Thứ năm',
        'Friday' => 'Thứ sáu',
        'Saturday' => 'Thứ bảy',
        'Sunday' => 'Chủ nhật',
    ];

    if (!isset($daysOfWeek[$day])) {
        // Thêm một câu lệnh ghi log để theo dõi các trường hợp không mong muốn
        error_log("Unexpected day: $day");
        return $day;
    }

    return $daysOfWeek[$day];
}

// Define the days of the week
$daysOfWeek = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];

// Initialize the session days if not set
if (!isset($_SESSION['daysOfWeek'])) {
    $_SESSION['daysOfWeek'] = array_map(function ($day) {
        return date('Y-m-d', strtotime("this week $day"));
    }, $daysOfWeek);
}

// Handle user actions
if (isset($_POST['next']) || isset($_POST['prev'])) {
    $direction = isset($_POST['next']) ? '+7 days' : '-7 days';

    foreach ($daysOfWeek as $index => $day) {
        $date = DateTime::createFromFormat('Y-m-d', $_SESSION['daysOfWeek'][$index]);
        $date->modify($direction);
        $_SESSION['daysOfWeek'][$index] = $date->format('Y-m-d');
    }

    $ngayXemLich = $_SESSION['daysOfWeek'][0]; // Lấy ngày đầu tiên trong tuần
} elseif (isset($_POST['current'])) {
    // Set days to the current week
    $_SESSION['daysOfWeek'] = array_map(function ($day) {
        return date('Y-m-d', strtotime("this week $day"));
    }, $daysOfWeek);

    $ngayXemLich = $_SESSION['daysOfWeek'][0]; // Lấy ngày đầu tiên trong tuần
}

// Extract individual days for display
list($t2, $t3, $t4, $t5, $t6, $t7, $t8) = $_SESSION['daysOfWeek'];

?>

<style>
    .calendar [type="submit"] {
        padding: 8px 10px;
        font-weight: 600;
        background-color: #1da1f2;
        color: #fff;
        border-radius: 5px;
        border: none;
        font-size: 14px;
    }

    .calendar td p a {
        color: #000;
        padding: 5px;
        font-size: 12px;
        margin-left: 10px;
    }

    .calendar td .delete {
        padding: 0px 10px;
    }

    .calendarDish {
        margin-left: auto;
        margin-right: auto;
        border: 1px solid;
        width: 60%;
        margin-top: 20px;
        min-height: 125px;
        padding: 10px;
    }

    .calendarDish img {
        width: 100%;
        height: 100px;
    }

    .calendartable {
        border-collapse: collapse;
        width: 100%;
    }

    .calendartable th,
    .calendartable td {
        border: 1px solid #ccc;
        padding: 5px;
    }

    .calendartable th {
        background-color: #eee;
    }
</style>

<div id="content" style="margin-left:240px;"> 
    <section class="content-wrapper" style="width: 100%;padding: 70px 0 0;"> 
        <div class="container-fluid px-4 calendar">
            <h3>Danh sách thực đơn</h3><br>
            <form id="dateForm" action="" method="post">
                <input type="date" id="selectedDate" name="date" value="<?php echo date('Y-m-d', strtotime($ngayXemLich)); ?>">
                <button type="submit" name="prev">Trở về</button>
                <button type="submit" name="current">Hiện Tại</button>
                <button type="submit" name="next">Tiếp</button>
            </form>

            <div>
                <table class="calendartable">
                    <tr>
                        <?php foreach ($_SESSION['daysOfWeek'] as $day): ?>
                            <th id="day"><?php echo getDayInVietnamese(date('l', strtotime($day))); ?> <?php echo date('d/m/Y', strtotime($day)); ?></th>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <?php foreach ($_SESSION['daysOfWeek'] as $day): ?>
                            <td>
                                <?php
                                $list_menu = $menu->getMenuByDate($day);
                                if (!empty($list_menu)) {
                                    foreach ($list_menu as $item): ?>
                                        <div class="calendarDish">
                                            <img src="Design/image/<?php echo $item['hinhanh'] ?>" alt="">
                                            <a><?php echo $item['tenmonan'] ?></a>
                                            <br>
                                            <button class="btn btn-danger delete">
                                                <a class="text-light" href="admin.php?mod=DeleteMonan&idthucdon=<?php echo $item['idthucdon'] ?>&id_monan=<?php echo $item['id_monan'] ?>">Xóa</a>
                                            </button>
                                        </div>
                                    <?php endforeach;
                                } ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                </table>
            </div>
        </div>
    </section>
</div>

<script>
   document.getElementById('selectedDate').addEventListener('input', function() {
    console.log('Change event triggered');
    document.getElementById('dateForm').submit();
});

</script>
