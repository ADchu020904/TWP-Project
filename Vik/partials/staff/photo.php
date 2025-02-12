<?php
require_once __DIR__ . '/../../connect.php';

              if (isset($_SESSION['email'])) {
                  $email = $_SESSION['email'];

                  $stmt = $conn->prepare("
                      SELECT name, position, photo
                      FROM staff
                      WHERE email = ?
                  ");
                  $stmt->bind_param("s", $email);
                  $stmt->execute();
                  $result = $stmt->get_result()->fetch_assoc();

                  $staffName     = $result['name']      ?? 'Guest';
                  $staffPosition = $result['position']  ?? '';
                  $photoBlob     = $result['photo']     ?? null;

                  if ($photoBlob) {
                      // Convert the raw BLOB to base64
                      $encoded = base64_encode($photoBlob);
                      // Build a data URI (assuming JPEG; adjust if PNG, etc.)
                      $photo = "data:image/jpeg;base64," . $encoded;
                  } else {
                      $photo = './images/user/user-03.png';
                  }
              } else {
                  $staffName     = 'Guest';
                  $staffPosition = '';
                  $photo         = './images/user/user-02.png';
              }              
?>