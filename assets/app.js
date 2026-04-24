/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

// Load tasks
function loadTasks() {
    console.log("load");
    fetch('/getTasks')
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById('taskList');
            list.innerHTML = '';
            console.log(data);
            data.forEach(task => {
                const li = document.createElement('li');
                li.textContent = task.name;
                list.appendChild(li);
            });
        });
}

//add task functionality
function addTask() {
    const input = document.getElementById('taskInput');
    console.log('add');
    console.log(input);
    fetch('/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            name: input.value
        })
    })
    .then(() => {
        input.value = '';
        loadTasks();
    });
}

// expose to HTML
window.addTask = addTask;

// initial load
// loadTasks();