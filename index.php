<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>D'Or Locadora</title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Locadora D'Or</h1>
        
        <!-- Exemplo de interface com Bootstrap -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Catalogo de Filmes</h5>
                <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Filme</th>
                        <th>Sinopse</th>
                        <th>Rating</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                pageLength: 5,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                },
                ajax: {
                    url: 'http://app-node:3000/movies', // URL da API
                    dataSrc: 'movie' // Define a propriedade que contém os dados no JSON (ajuste conforme necessário)
                },
                columns: [
                    { data: 'name' },       // Mapeia a coluna "Nome" com a propriedade "nome" no JSON
                    { data: 'sinopsys' },      // Mapeia a coluna "Idade" com a propriedade "idade"
                    { data: 'rating' },  // Mapeia a coluna "Profissão" com a propriedade "profissao"
                ],
            });
        });
    </script>

    
</body>
</html>
