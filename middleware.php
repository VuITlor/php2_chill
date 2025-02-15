<?php
function checkLogin() {
    if (!isset($_SESSION['users'])) {
      redirect("/login");
    }
    return true;
}

function checkAdmin() {
    checkLogin();
    if (!isset($_SESSION['users']['role']) || $_SESSION['users']['role'] !== 'admin') {
        redirect("/unauthorized");
    }
    return true;
}

function checkUserOrAdmin() {
    checkLogin();
    $role = $_SESSION['users']['role'];
    if ($role !== 'user' && $role !== 'admin') {
        redirect("/");
    }
    return true;
}

function logRequest() {
    error_log("Request received at " . date('Y-m-d H:i:s'));
    return true;
}