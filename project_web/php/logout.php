<?php
session_start(); // Memulai session
session_unset();  // Menghapus semua data session
session_destroy(); // Menghancurkan session
header("Location: ../home_page.html"); // Redirect
exit(); // Menyelesaikan eksekusi script
?>
