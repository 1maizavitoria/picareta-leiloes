function toggleSidebar() {
    sidebar = document.getElementById("sidebar");
    if (sidebar.classList.contains('opened')) {
        sidebar.classList.remove('opened');
        sidebar.classList.add('closed');
    } else {
        sidebar.classList.remove('closed');
        sidebar.classList.add('opened');
    }

}