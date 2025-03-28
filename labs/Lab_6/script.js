async function register() {
    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    if (!username || !email || !password) return alert('Fill all fields');
    
    const res = await fetch('labs/Lab_6/register.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ username, email, password })
    });
    const data = await res.json();
    alert(data.message || 'User registered');
}

async function getUsers() {
    const res = await fetch('labs/Lab_6/get_users.php');
    const users = await res.json();
    const list = document.getElementById('userList');
    list.innerHTML = '';
    users.forEach(u => {
        list.innerHTML += `<li>${u.username} (${u.email}) 
            <button onclick="deleteUser(${u.id})">Delete</button>
            <button onclick="editUser(${u.id}, '${u.username}', '${u.email}')">Edit</button>
        </li>`;
    });
}

async function logout() {
    localStorage.removeItem('user');

    // Очищуємо блок з логіном
    const loginuser = document.getElementById('loginusers');
    if (loginuser) {
        loginuser.innerHTML = `
            <h2>Login</h2>
            <input id="loginEmail" placeholder="Email"><br>
            <input id="loginPassword" type="password" placeholder="Password"><br>
            <button onclick="login()">Login</button>
        `;
    }

    // location.reload();
}


async function deleteUser(id) {
    await fetch(`labs/Lab_6/delete_user.php?id=${id}`);
    getUsers();
}

async function login() {
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;

    if (!email || !password) return alert('Заповніть всі поля');

    const res = await fetch('labs/Lab_6/login.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password })
    });

    const data = await res.json();

    if (data.status === 'success') {
        // alert('Вітаю, ' + data.user.username);
        console.log(data);

        const loginuser = document.getElementById('loginusers');
        if (loginuser) {
            loginuser.innerHTML = `Привіт, ${data.user.username}! <a href="#" onclick="logout()">Вихід</a>`;
        }
        
        localStorage.setItem('user', JSON.stringify(data.user));
        
    } else {
        alert(data.message);
    }
}


async function editUser(id, username, email) {
    const newName = prompt('New name', username);
    const newEmail = prompt('New email', email);
    if (newName && newEmail) {
        await fetch('labs/Lab_6/update_user.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, username: newName, email: newEmail })
        }).then(getUsers);
    }
}
