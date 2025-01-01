<?php

session_start();
session_destroy();

echo "<script>alert('Logout sukses');
window.location.href = 'login.php'</script>";
