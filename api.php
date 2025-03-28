<?php

$section = $_GET['section'];
$page = $_GET['page'] ?? 'index';
include('function.php');

$result = $db->query("SELECT queue_no,print_no FROM queues WHERE section = '$section'");
$row = $result->fetchArray();

if ($row) {
    echo $page == 'form' ? $row['print_no'] : $row['queue_no'];
} else {
    echo '0';
}
