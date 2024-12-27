// Dummy user data (Replace with a database or backend)
const users = [
    { username: 'user1', password: 'password1' },
    { username: 'user2', password: 'password2' }
];

const loginForm = document.querySelector('.signup-form');

signup-form.addEventListener('submit', function (e) {
    e.preventDefault();
    const usernameInput = document.getElementById('Username');
    const passwordInput = document.getElementById('Password');
    const username = usernameInput.value;
    const password = passwordInput.value;
    
    if (authenticateUser(username, password)) {
        alert('Login successful!');
        // Redirect to the main application page or perform other actions
    } else {
        alert('Login failed. Please check your username and password.');
    }

    loginForm.reset();
});

function authenticateUser(username, password) {
    const user = users.find((u) => u.username === username && u.password === password);
    return !!user;
}
