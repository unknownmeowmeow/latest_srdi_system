<?php
session_start();
require_once "../../controller/Main.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../../auth/login.php");
    exit;
}

$session_user_id = $_SESSION['user_id'];
$type_id = $_SESSION['type_id'];
$format = $_POST['format'] ?? 'csv';

$db = new db();

// Fetch research
$allResearch = ($type_id == 1) ? $db->getAllResearch($session_user_id) : $db->getAllResearch();

// Prepare data
$data = [];
foreach ($allResearch as $r) {
    $data[] = [
        'Title' => $r['title'],
        'Description' => $r['description'],
        'File' => $r['filePath'] ?? '',
        'Start Date' => $r['startDate'],
        'End Date' => $r['endDate'],
        'Members' => $r['member'],
        'Leader' => $r['leader_firstname'] . ' ' . $r['leader_lastname'],
        'Compliance' => $r['compliance'] ?? '',
        'Comment' => $r['comment'] ?? '',
        'Status' => ($r['status_id'] == 3 ? 'Revision' :
                    ($r['status_id'] == 2 ? 'Approved' :
                    ($r['status_id'] == 1 ? 'Pending' : 'Other')))
    ];
}

// EXPORT CSV
if ($format === 'csv') {
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="research_report.csv"');
    $output = fopen('php://output', 'w');
    if (!empty($data)) {
        fputcsv($output, array_keys($data[0]));
        foreach ($data as $row) fputcsv($output, $row);
    }
    fclose($output);
    exit;
}

// EXPORT PDF using TCPDF
if ($format === 'pdf') {
    // Include Composer autoloader
    require_once __DIR__ . '/../../vendor/autoload.php';

    $pdf = new TCPDF();
    $pdf->AddPage();

    $html = '<h2>Research Report</h2>';
    $html .= '<table border="1" cellpadding="4" cellspacing="0"><thead><tr>';
    foreach (array_keys($data[0]) as $header) {
        $html .= '<th><b>' . htmlspecialchars($header) . '</b></th>';
    }
    $html .= '</tr></thead><tbody>';
    foreach ($data as $row) {
        $html .= '<tr>';
        foreach ($row as $cell) {
            $html .= '<td>' . htmlspecialchars($cell) . '</td>';
        }
        $html .= '</tr>';
    }
    $html .= '</tbody></table>';

    $pdf->writeHTML($html, true, false, true, false, '');
    $pdf->Output('research_report.pdf', 'D');
    exit;
}
?>
