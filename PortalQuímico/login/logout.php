<?php
    session_start();
    session_destroy(); // destrói a sessão
    header('Location: index.php');

