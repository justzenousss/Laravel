<?php
require_once 'model/Student.php';

class StudentController
{
    private $model;

    public function __construct()
    {
        $this->model = new Student();
    }

    public function index()
    {
        $students = $this->model->getAll();
        include 'view/student_list.php';
    }

    public function add()
    {
        $student = ['id'=>'','name'=>'','major'=>''];
        $errors = [];
        $action = 'store';
        include 'view/student_form.php';
    }

    public function store()
    {
        $name = trim($_POST['name'] ?? '');
        $major = trim($_POST['major'] ?? '');

        $errors = $this->validate($name, $major);

        if ($errors) {
            $student = ['id'=>'','name'=>$name,'major'=>$major];
            $action = 'store';
            include 'view/student_form.php';
            return;
        }

        $this->model->add($name, $major);
        header("Location: index.php");
        exit;
    }

    public function delete()
    {
        $id = $_GET['id'] ?? 0;
        $this->model->delete($id);
        header("Location: index.php");
        exit;
    }

    public function edit()
    {
        $id = $_GET['id'] ?? 0;
        $student = $this->model->findById($id);

        if (!$student) {
            header("Location: index.php");
            exit;
        }

        $errors = [];
        $action = 'update';
        include 'view/student_form.php';
    }

    public function update()
    {
        $id = $_POST['id'] ?? 0;
        $name = trim($_POST['name'] ?? '');
        $major = trim($_POST['major'] ?? '');

        $errors = $this->validate($name, $major);

        if ($errors) {
            $student = ['id'=>$id,'name'=>$name,'major'=>$major];
            $action = 'update';
            include 'view/student_form.php';
            return;
        }

        $this->model->update($id, $name, $major);
        header("Location: index.php");
        exit;
    }

    public function search()
    {
        $keyword = $_GET['keyword'] ?? '';
        $students = $keyword ? $this->model->search($keyword) : $this->model->getAll();
        include 'view/student_list.php';
    }

    private function validate($name, $major)
    {
        $errors = [];

        if ($name == '') {
            $errors['name'] = 'Không để trống';
        } elseif (strlen($name) < 3) {
            $errors['name'] = 'Ít nhất 3 ký tự';
        } elseif (preg_match('/\d/', $name)) {
            $errors['name'] = 'Không chứa số';
        }

        if ($major == '') {
            $errors['major'] = 'Không để trống';
        }

        return $errors;
    }
}