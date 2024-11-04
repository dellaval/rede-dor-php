$(document).ready(function() {
    $('#myTable').DataTable({
        // Opções do DataTables
        paging: true,         // Habilita paginação
        searching: true,      // Habilita a barra de pesquisa
        ordering: true,       // Habilita a ordenação nas colunas
        pageLength: 5,        // Define o número de linhas por página
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/Portuguese-Brasil.json' // Traduz para Português
        }
    });
});
