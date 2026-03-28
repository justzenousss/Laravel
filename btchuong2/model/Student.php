<?php
class Student
{
    public function __construct()
    {
        if (!isset($_SESSION['students'])) {
            $_SESSION['students'] = [
                ['id' => 1, 'name' => 'Nguyen Van A', 'major' => 'CNTT'],
                ['id' => 2, 'name' => 'Tran Thi B', 'major' => 'Ke toan']
            ];
        }
    }

    public function getAll()
    {
        return $_SESSION['students'];
    }

    public function findById($id)
    {
        foreach ($_SESSION['students'] as $s) {
            if ($s['id'] == $id) return $s;
        }
        return null;
    }

    public function add($name, $major)
    {
        $ids = array_column($_SESSION['students'], 'id');
        $newId = empty($ids) ? 1 : max($ids) + 1;

        $_SESSION['students'][] = [
            'id' => $newId,
            'name' => $name,
            'major' => $major
        ];
    }

    public function update($id, $name, $major)
    {
        foreach ($_SESSION['students'] as &$s) {
            if ($s['id'] == $id) {
                $s['name'] = $name;
                $s['major'] = $major;
            }
        }
    }

    public function delete($id)
    {
        foreach ($_SESSION['students'] as $k => $s) {
            if ($s['id'] == $id) {
                unset($_SESSION['students'][$k]);
            }
        }
        $_SESSION['students'] = array_values($_SESSION['students']);
    }

    public function search($keyword)
    {
        $result = [];
        foreach ($_SESSION['students'] as $s) {
            if (stripos($s['name'], $keyword) !== false) {
                $result[] = $s;
            }
        }
        return $result;
    }
}