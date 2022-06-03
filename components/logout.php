<?php
session_start();

if(session_destroy()) {
    sleep(3);
    header("location:home.php");
}
