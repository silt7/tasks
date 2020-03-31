<?php

/**
 * LoginController short summary.
 *
 * LoginController description.
 *
 * @version 1.0
 * @author 79523
 */
namespace Controllers;

use Models\Users;
use Models\Tasks;

class LoginController extends Controller
{
    public function index()
    {
        session_start();

        if ($_SESSION['user_id']){
            header("Location: /admin");
        }

        self::render('login', array());
    }

    public function login()
    {
        session_start();

        $login = $_POST['Login'] ? $_POST['Login'] : '';
        $password = $_POST['Password'] ? md5($_POST['Password']) : '';

        if ( ($login != '') && ( $password != '' ) ) {
            $userObj = new Users;
            $where = "login = '{$login}' and password = '{$password}'";
            $result = $userObj -> select('users', ['where' => $where]);

            $user_arr = [];
            while ($row = $result->fetch()) {
                array_push($user_arr,$row);
            }

            if (count($user_arr) == 1){
                $_SESSION['user_id'] = $user_arr[0]['id'];
                echo json_encode(['response' => 'y']);
            }
            else
            {
                echo json_encode(['response' => 'err']);
            }
        }
    }

    public function logout()
    {
        session_start();

        session_destroy();

        header("Location: /");
    }

    public function admin()
    {
        session_start();

        if (!isset($_SESSION['user_id'])){
            header("Location: /auth");
        }

        $tasksObj = new Tasks;
        $all = $tasksObj -> select('tasks', []);

        $tasks = [];
        while ($row = $all->fetch()) {
            array_push($tasks,$row);
        }

        self::render('admin', ['tasks' => $tasks]);
    }
    public function edit()
    {
        session_start();

        if (isset($_SESSION['user_id'])){
            $id = $_POST['id'] ? $_POST['id'] : '';
            $content = $_POST['content'] ? $_POST['content'] : '';
            $done = $_POST['done'] == 'true' ? 1 : 0;
            $update = 0;

            $tasksObj = new Tasks;
            $all = $tasksObj -> select('tasks', ['where' => "id = {$id}" ]);

            while ($row = $all->fetch()) {
                if(($row['content'] != $content) || ($row['edit'] == 1)){
                    $update = 1;
                }
            }
            $fields = [
                ':content' => $content,
                ':edit' => $update,
                ':done' => $done
            ];
            $tasksObj -> update('tasks', $fields,['where' => "id = {$id}" ]);
        }
        else{
            throw new \Exception();
        }
    }
}
