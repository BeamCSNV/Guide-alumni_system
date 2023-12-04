<?php
include '../config/conf.php';
if ($_POST["type"] == 'activity' and $_POST["date_start"] and $_POST["date_end"]) {

    $date_start = $_POST["date_start"];
    $date_end = $_POST["date_end"];

    $sql = "SELECT activity_register.activity_id,
    COUNT(DISTINCT activity_register.user_id) AS num_users,
    COUNT(CASE WHEN activity_register.status_payment = 1 THEN activity_register.status_payment END) AS num_payments_1,
    COUNT(CASE WHEN activity_register.status_payment = 0 THEN activity_register.status_payment END) AS num_payments_0,
    COUNT(CASE WHEN activity_register.status = 1 THEN activity_register.status END) AS num_status_ap,
    COUNT(CASE WHEN activity_register.status = 0 THEN activity_register.status END) AS num_status_no
     FROM event_list INNER JOIN activity ON activity.activity_id = event_list.event_list_type
     INNER JOIN activity_register ON activity_register.activity_id = event_list.event_list_id
     WHERE activity_register.create_dattime BETWEEN '$date_start' AND '$date_end'
     GROUP BY activity_register.activity_id
    ";
    $query = $conn->prepare($sql);
    $query->execute();
    // echo $sql;
    $total_all_1 = '';
    $total_all_0 = '';
    $user_all_1 = '';
    $user_all_0 = '';
    while ($row = $query->fetch(PDO::FETCH_OBJ)) {
        $charges = 0;
        $user_all_1 = $user_all_1 + intval($row->num_status_ap);
        $user_all_0 = $user_all_0 + intval($row->num_status_no);

        $row->activity_id;
        $sql_ev = "SELECT * FROM `event_list`  INNER JOIN activity ON activity.activity_id = event_list.event_list_type   WHERE event_list.event_list_id = '$row->activity_id'";
        $query_ev = $conn->prepare($sql_ev);
        $query_ev->execute();
        while ($row_ev = $query_ev->fetch(PDO::FETCH_OBJ)) {
            $row_ev->event_list_name;
            $row_ev->activity_name;
            // $total_all_1 = $total_all + intval($row->num_payments_1 * $row_ev->charges);
            // $total_all_0 = $total_all + intval($row->num_payments_0 * $row_ev->charges);
            $charges = $charges + intval($row->num_payments_1 * $row_ev->charges);
            $total_all_1 += $charges;

            $data[] = [
                $row_ev->event_list_name,
                $row_ev->activity_name,
                $row_ev->charges . " บาท",
                $row->num_users . " คน",
                $row->num_status_ap . " คน",
                $row->num_payments_1 . " คน",
                $charges . " บาท",
                // $row->num_status_no." คน",
            ];
        }
    }

    $data[] = [
        '',
        '',
        '',
        '',
        'ทั้งหมด',
        $user_all_1 . " คน",
        $total_all_1 . " บาท",
        // $row->num_status_no." คน",
    ];

    function compareByName($a, $b)
    {
        return strcmp($a[0], $b[0]);
    }

    usort($data, 'compareByName');

    echo json_encode([
        'data_total' => count($data),
        'data' => $data,
        'total_all_0' => $total_all_0,
        'total_all_1' => $total_all_1,
        'user_all_1' => $user_all_1,
        'user_all_0' => $user_all_0,
        'sql' => $sql,
    ]);
}

if ($_POST["type"] == 'salary') {
    $salary_end = $_POST["salary_end"];
    $salary_start = $_POST["salary_start"];

    $sql = "SELECT
        CASE
            WHEN std_job_salary BETWEEN 1 AND 10000 THEN 'น้อยกว่า 10,000 บาท'
            WHEN std_job_salary BETWEEN 10001 AND 20000 THEN 'มากกว่า 10,000 - 20,000 บาท'
            WHEN std_job_salary BETWEEN 20001 AND 25000 THEN 'มากกว่า 20,000 - 25,000 บาท'
            WHEN std_job_salary BETWEEN 25001 AND 30000 THEN 'มากกว่า 25,000 - 30,000 บาท'
            WHEN std_job_salary BETWEEN 30001 AND 10000000 THEN 'มากกว่า 30,000 บาท ขึ้นไป'
        END AS salary_range,
            COUNT(*) AS count
        FROM alumni
        GROUP BY salary_range;
    ";
    $query = $conn->prepare($sql);
    $query->execute();
    while ($row = $query->fetch(PDO::FETCH_OBJ)) {

        $data[] = [
            $row->salary_range,
            $row->count . " คน",

        ];
    }
    echo json_encode([
        'salary_start' => $salary_start,
        'salary_end' => $salary_end,
        'data_total' => count($data),
        'data' => $data,
    ]);
}
