<?php
// Need session_start so that user input is saved
session_start();
// Function to create the task list(to_do_list) array if it doesn't exist
function initTaskList() {
    if (!isset($_SESSION['to_do_list'])) { 
        $_SESSION['to_do_list'] = array();
    }
}
// Function to add a new task to the list
function addTask($task, $priority) {
    $_SESSION['to_do_list'][] = array('task' => $task, 'priority' => $priority);
}
// Function to delete tasks by their indexes from the session array
function deleteTasks($indexes) {
    foreach ($indexes as $index) {
        if (isset($_SESSION['to_do_list'][$index])) {
            array_splice($_SESSION['to_do_list'], $index, 1);
        }
    }
}
// Initialize the task list
initTaskList();
// Check if the form has been submitted
if (isset($_POST["task"]) && !empty($_POST["task"])) {
    $newTask = $_POST["task"]; // Get task from form
    $priority = $_POST["priority"]; // Get priority from form
    addTask($newTask, $priority); // Add task and priority to the session list
}
// Check if the "Delete" button was clicked
if (isset($_POST['delete']) && is_array($_POST['delete'])) {
    $deletedIndexes = $_POST['delete'];
    deleteTasks($deletedIndexes);
}
// Form setup
echo '<div style="text-align: center;">';
echo "<form method='post'>";
echo "<h1 class=center>Desarae's To-Do List</h1>";
echo "<h2 class=center2>Tasks:</h2>";
echo '<input type="text" name="task" placeholder="Enter a new task">';
echo 'Priority: <input type="number" name="priority" min="1" value="1">';
echo '<input type="submit" value="Add Task">';
echo '</form>';
// Format to display the list in a table
echo '<form method="post">';
echo '<div style="text-align: center;">';
echo '<table style="margin: 0 auto;">';
echo '<tr><th>N</th><th>Priority</th><th>Task</th><th>Delete</th></tr>';
foreach ($_SESSION['to_do_list'] as $index => $taskInfo) {
    echo "<tr>";
    echo "<td>" . ($index + 1) . "</td>";
    echo "<td>" . $taskInfo['priority'] . "</td>";
    echo "<td>" . $taskInfo['task'] . "</td>";
    echo '<td> <input type="checkbox" name="delete[]" value="' . $index . '"></td>';
    echo "</tr>";
}
echo '</table>';
echo '<input type="submit" value="Delete Selected Tasks">';
echo '</form>';
echo '</div>';
// adding style to the webpage
echo "<body style='background-color: lightblue; color: #000080; border: 2px solid navy;'>";
?>