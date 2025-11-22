<?php
require_once '../includes/security.php';
session_destroy();
redirect('../index.php');
