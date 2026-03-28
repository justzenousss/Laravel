<?php
session_start();
require_once 'controller/StudentController.php';

$controller = new StudentController();

$action = $_GET['action'] ?? 'list';

switch ($action) {
    case 'list':
        $controller->index();
        break;
    case 'add':
        $controller->add();
        break;
    case 'store':
        $controller->store();
        break;
    case 'delete':
        $controller->delete();
        break;
    case 'edit':
        $controller->edit();
        break;
    case 'update':
        $controller->update();
        break;
    case 'search':
        $controller->search();
        break;
    default:
        $controller->index();
}