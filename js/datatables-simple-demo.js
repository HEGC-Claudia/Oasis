window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimple = document.getElementById('datatablesSimple');
    if (datatablesSimple) {
        new simpleDatatables.DataTable(datatablesSimple);
    }

    const datatablesDocto1 = document.getElementById('datatablesDocto1');
    if (datatablesDocto1) {
        new simpleDatatables.DataTable(datatablesDocto1);
    }

    const datatablesDocto2 = document.getElementById('datatablesDocto2');
    if (datatablesDocto2) {
        new simpleDatatables.DataTable(datatablesDocto2);
    }
    
    const datatablesDocto3 = document.getElementById('datatablesDocto3');
    if (datatablesDocto3) {
        new simpleDatatables.DataTable(datatablesDocto3);
    }
});


