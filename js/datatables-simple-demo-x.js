
window.addEventListener('DOMContentLoaded', event => {
    // Simple-DataTables
    // https://github.com/fiduswriter/Simple-DataTables/wiki

    const datatablesSimplex = document.getElementById('datatablesSimplex');
    if (datatablesSimplex) {
        new simpleDatatables.DataTable(datatablesSimplex);
    }
});
