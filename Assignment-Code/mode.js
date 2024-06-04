document.addEventListener('DOMContentLoaded', function () {
    const body = document.body;
    const modeSwitch = document.getElementById('modeSwitch');

    // Check if dark mode was selected previously
    if (localStorage.getItem('darkMode') === 'true') {
        body.classList.add('dark-mode');
        modeSwitch.innerText = 'Switch to Light Mode';
    }

    modeSwitch.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        let isDarkMode = body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode);
        modeSwitch.innerText = isDarkMode ? 'Switch to Light Mode' : 'Switch to Dark Mode';
    });
});
