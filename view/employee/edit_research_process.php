<?php
session_start();
require_once "../../controller/Main.php";

$db = new db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $research_id = $_POST['research_id'] ?? 0;
    $title = $_POST['title'] ?? '';
    $member = $_POST['member'] ?? '';
    $startDate = $_POST['startDate'] ?? null;
    $endDate = $_POST['endDate'] ?? null;

    if (!$research_id) {
        die("Invalid research ID.");
    }

    // Handle revised PDF upload (keep original name + date)
    $revised_pdf_filename = null;
    if (isset($_FILES['revised_pdf']) && $_FILES['revised_pdf']['error'] === 0) {
        $fileTmpPath = $_FILES['revised_pdf']['tmp_name'];
        $originalName = $_FILES['revised_pdf']['name'];
        $fileExtension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        if ($fileExtension === 'pdf') {
            // Clean original name (remove spaces/special chars)
            $baseName = pathinfo($originalName, PATHINFO_FILENAME);
            $baseName = preg_replace("/[^a-zA-Z0-9_-]/", "_", $baseName);

            // Append date/time for uniqueness
            $newFileName = $baseName . '_' . date('Ymd_His') . '.' . $fileExtension;

            // Absolute path to your research folder
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/srdi_system_v1/view/employee/research/';
            if (!is_dir($uploadDir)) {
                die("Research folder does not exist at: $uploadDir");
            }

            $destPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $revised_pdf_filename = $newFileName;
            } else {
                die("Failed to move uploaded file.");
            }
        } else {
            die("Only PDF files are allowed.");
        }
    }

    // Prepare data for update
    $updateData = [
        'title' => $title,
        'member' => $member,
        'startDate' => $startDate,
        'endDate' => $endDate,
        'status_id' => 1 // back to Pending
    ];

    if ($revised_pdf_filename) {
        $updateData['revised_pdf'] = $revised_pdf_filename;
    }

    // Update research in database
    $db->updateResearch($research_id, $updateData);

    // Redirect back with success
    header("Location: revised.php?success=1");
    exit;
}
