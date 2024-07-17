<?php

require 'config.php';

$input = file_get_contents("php://input");
$ticketData = json_decode($input, true);

$params = array(
    $ticketData['Incident'],
    $ticketData['StartDate'],
    $ticketData['Priority'],
    $ticketData['Status'],
    $ticketData['LastModifiedDate'],
    $ticketData['AssignedDate'],
    $ticketData['AssignedPerson'],
    $ticketData['ID'],
    );

$sql = "UPDATE Tickets SET Incident = ?, StartDate = ?, Priority = ?, Status = ?, LastModifiedDate = ?, AssignedDate = ?, AssignedPerson = ? WHERE ID = ?";

$stmt = sqlsrv_query($conn, $sql, $params);
if (!$stmt) {
    die(print_r(sqlsrv_errors(), true));
}

echo json_encode(array("message" => "Ticket edited successfully"));
sqlsrv_free_stmt($stmt);
sqlsrv_close($conn);

?>