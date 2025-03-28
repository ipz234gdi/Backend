
async function addNote() {
    const title = document.getElementById('title').value;
    const content = document.getElementById('content').value;
    const datauser = JSON.parse(localStorage.getItem('user'))
    console.log(datauser);
    username = datauser.username;
    console.log(username);
    if (!title || !content || !username) return alert('Fill all fields');
    
    await fetch('labs/Lab_6/notes.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ title, content, username })
    });
    console.log('Add note');
    
    getNotes();
}

function escapeHTML(str) {
    return str.replace(/&/g, "&amp;")
              .replace(/</g, "&lt;")
              .replace(/>/g, "&gt;")
              .replace(/"/g, "&quot;")
              .replace(/'/g, "&#039;");
}


async function getNotes() {
    const res = await fetch('labs/Lab_6/notes.php');
    const notes = await res.json();
    const list = document.getElementById('notesList');
    list.innerHTML = '';
    notes.forEach(n => {
        list.innerHTML += `<li>${n.username} - <b>${escapeHTML(n.title)}</b>: <input><textarea id="content" placeholder="Content">${n.content}</textarea><br>
            <button onclick="deleteNote(${n.id})">Delete</button>
            <button onclick="editNote(${n.id}, '${escapeHTML(n.title)}', '${escapeHTML(n.content)}')">Edit</button>
        </li>`;
    });
}

async function deleteNote(id) {
    await fetch('labs/Lab_6/notes.php', { method: 'DELETE', body: `id=${id}` });
    getNotes();
}

async function editNote(id, title, content) {
    const newTitle = prompt('New title', title);
    const newContent = prompt('New content', content);
    if (newTitle && newContent) {
        await fetch('labs/Lab_6/notes.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id, title: newTitle, content: newContent })
        }).then(getNotes);
    }
}

