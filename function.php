<?php
require_once "../config.php";

/* Handle appointment actions */
function handleAppointmentAction($conn, $appointment_ID, $action) {
    if ($action === 'approve') {
        $sql = "UPDATE appointment SET status='approved' WHERE appointment_ID=?";
    } elseif ($action === 'pending') {
        $sql = "UPDATE appointment SET status='pending' WHERE appointment_ID=?";
    } elseif ($action === 'canceled') {
        $sql = "UPDATE appointment SET status='canceled' WHERE appointment_ID=?";
    } elseif ($action === 'delete') {
        $sql = "DELETE FROM appointment WHERE appointment_ID=?";
    } else {
        return false;
    }

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $appointment_ID);
    return $stmt->execute();
}

/* Fetch appointments with optional status filter */
function fetchAppointments($conn, $status = null) {
    if ($status) {
        $sql = "SELECT * FROM appointment WHERE status=? ORDER BY appointment_ID DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $status);
    } else {
        $sql = "SELECT * FROM appointment ORDER BY appointment_ID DESC";
        $stmt = $conn->prepare($sql);
    }
    $stmt->execute();
    return $stmt->get_result();
}

/* Count appointments with optional status filter */
function countAppointments($conn, $status = null) {
    if ($status) {
        $sql = "SELECT COUNT(*) AS total FROM appointment WHERE status=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $status);
    } else {
        $sql = "SELECT COUNT(*) AS total FROM appointment";
        $stmt = $conn->prepare($sql);
    }
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['total'];
}
?>
