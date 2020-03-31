<?php

/**
 * HomeController short summary.
 *
 * HomeController description.
 *
 * @version 1.0
 * @author 79523
 */
namespace Controllers;

use Models\Tasks;

class HomeController extends Controller
{
    public function index()
    {
        session_start();

        $tasksObj = new Tasks;
        $all = $tasksObj -> select('tasks', []);

        $tasks = [];
        while ($row = $all->fetch()) {
            array_push($tasks,$row);
        }

        self::render('home', ['tasks' => $tasks]);
    }
    public function saveTask()
    {
        $name = $_POST['Name'] ?  htmlspecialchars( strip_tags($_POST['Name'])) : '';
        $email = $_POST['Email'] ?  htmlspecialchars( strip_tags($_POST['Email'])) : '';
        $content = $_POST['Content'] ?  htmlspecialchars( strip_tags($_POST['Content'])) : '';

        $fields = [
            ':name_user' => $name,
            ':email' => $email,
            ':content' => $content
        ];
        $TasksObj = new Tasks;
        $TasksObj -> insert('tasks', $fields);

        return true;
    }
}
