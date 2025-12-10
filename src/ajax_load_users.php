<?php
require "start.php";

if (!isset($_SESSION['user'])) {
    http_response_code(401); // not authorized
    return;
}

// Backend aufrufen
$users = $service->loadUsers();
if ($users) {
    // erhaltene Friend-Objekte im JSON-Format senden 
    echo json_encode($users);
}
/* http status code setzen
 * - 200 Friends gesendet
 * - 404 Fehler
 */
http_response_code($users ? 200 : 404);
?>
