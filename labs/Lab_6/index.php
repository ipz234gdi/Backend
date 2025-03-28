<?php

$task1 = '
<h2>Register</h2>
<input id="username" placeholder="Name"><br>
<input id="email" placeholder="Email"><br>
<input id="password" type="password" placeholder="Password"><br>
<button onclick="register()">Register</button>

<h2>Users</h2>
<button onclick="getUsers()">Load Users</button>
<ul id="userList"></ul>

<script src="../labs/Lab_6/script.js"></script>
';

$task1 .= '<div id="loginusers">';
if (isset($_SESSION['user_id'])) {
    $task1 .= "Привіт, " . htmlspecialchars($_SESSION['username']) . "!";
    $task1 .= ' <a href="#" onclick="logout()">Вихід</a>'; // Виклик JS-logout
} else {
    $task1 .= '<h2>Login</h2>
    <input id="loginEmail" placeholder="Email"><br>
    <input id="loginPassword" type="password" placeholder="Password"><br>
    <button onclick="login()">Login</button>';
}
$task1 .= "</div>";

$task2 = '
<h2>Notes</h2>
<input id="title" placeholder="Title"><br>
<textarea id="content" placeholder="Content"></textarea><br>
<button onclick="addNote()">Add Note</button>
<ul id="notesList"></ul>

<script src="../labs/Lab_6/script_notes.js"></script>
<script>getNotes();</script>
';


?>
