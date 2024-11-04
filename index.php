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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1 class="text-center my-4">Locadora D'Or</h1>
        
        <!-- Exemplo de interface com Bootstrap -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Catalogo de Filmes</h5>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalMovies">Novo Filme</button>
                <table id="myTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Filme</th>
                        <th>Sinopse</th>
                        <th>Rating</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Formulário de Contato</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário -->
                    <form id="contactForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <input type="hidden" class="form-control" id="id" name="id">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Telefone</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" form="contactForm" class="btn btn-primary">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalMovies" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Filmes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulário -->
                    <form id="movieForm">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="movieName" name="movieName" required>
                            <input type="hidden" class="form-control" id="idMovie" name="idMovie" value="0">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Sinopse</label>
                            <textarea class="form-control" id="movieSynopsis" name="movieSynopsis" rows="4" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Rating</label>
                            <input type="text" class="form-control" id="rating" name="rating" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="submit" form="movieForm" class="btn btn-primary">Confirmar</button>
                </div>
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
                    url: 'http://localhost:3000/movies', // URL da API
                    dataSrc: 'movies' // Define a propriedade que contém os dados no JSON (ajuste conforme necessário)
                },
                columns: [
                    {
                        // Coluna para os botões
                        data: null,
                        render: function(data, type, row) {
                            return `
                                <button type="button" class="btn btn-warning btn-sm me-2 edit-btn" data-id="${row.id}" data-name="${row.name}" data-synopsis="${row.synopsis}" data-rating="${row.rating}">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm delete-btn" data-id="${row.id}">
                                    <i class="bi bi-trash"></i>
                                </button>
                            `;
                        }
                    },
                    { data: 'name' },       // Mapeia a coluna "Nome" com a propriedade "nome" no JSON
                    { data: 'synopsis' },      // Mapeia a coluna "Idade" com a propriedade "idade"
                    { data: 'rating' },  // Mapeia a coluna "Profissão" com a propriedade "profissao"
                    {
                        // Coluna para os botões
                        data: null,
                        render: function(data, type, row) {
                            
                            const reservedMovieId = row.reservedMovies && row.reservedMovies.length > 0 ? row.reservedMovies[0].id : null;
                            const scheduleId = reservedMovieId > 0 && row.reservedMovies[0].scheduleMovies && row.reservedMovies[0].scheduleMovies.length > 0 
                                    ? row.reservedMovies[0].scheduleMovies[0].id 
                                    : null;

                            return `
                                ${!reservedMovieId ? `
                                    <button class="btn btn-primary btn-sm reserve-btn" data-id="${row.id}">Reservar</button>
                                ` : `
                                    <button class="btn btn-primary btn-sm reserve-btn" disabled>Reservar</button>
                                `}

                                ${reservedMovieId && !scheduleId ? `
                                    <button class="btn btn-success btn-sm confirm-btn" data-id="${reservedMovieId}">Confirmar Locação</button>
                                    <button class="btn btn-danger btn-sm cancel-reserve-btn" data-id="${reservedMovieId}">Cancelar Reservar</button>
                                ` : `
                                    <button class="btn btn-secondary btn-sm" disabled>Confirmar Locação</button>
                                `}

                                ${scheduleId ? `
                                    <button class="btn btn-danger btn-sm return-btn" data-id="${reservedMovieId}">Devolver Filme</button>
                                ` : `
                                    <button class="btn btn-secondary btn-sm" disabled>Devolver Filme</button>
                                `}
                            `;
                        }
                    }
                ],
            });
        });

        $('#myTable tbody').on('click', '.reserve-btn', function() {
            const id = $(this).data('id');
            const settings = {
                "async": true,
                "crossDomain": true,
                "url": "http://localhost:3000/reserve/"+id,
                "method": "POST",
                "headers": {}
            };

            $.ajax(settings).done(function (response) {
                location.reload();
            });
        });

        $('#myTable tbody').on('click', '.confirm-btn', function() {
            const id = $(this).data('id');
            $("#id").val(id);
            $('#myModal').modal('show');
        });

        $('#myTable tbody').on('click', '.cancel-reserve-btn', function() {
            const id = $(this).data('id');
            const settings = {
                "async": true,
                "crossDomain": true,
                "url": "http://localhost:3000/reserve/"+id,
                "method": "DELETE",
                "headers": {}
                };

            $.ajax(settings).done(function (response) {
                location.reload();
            });
        });

        $('#myTable tbody').on('click', '.return-btn', function() {
            const id = $(this).data('id');
            const settings = {
                "async": true,
                "crossDomain": true,
                "url": "http://localhost:3000/reserve/"+id,
                "method": "DELETE",
                "headers": {}
                };

            $.ajax(settings).done(function (response) {
                location.reload();
            });
        });

        $('#contactForm').submit(function(event) {
            // Previne o comportamento padrão de enviar o formulário e recarregar a página
            event.preventDefault();

            // Captura os dados do formulário
            const formData = {
                name: $('#name').val(),
                email: $('#email').val(),
                phone: $('#phone').val()
            };

            const settings = {
                "async": true,
                "crossDomain": true,
                "url": "http://localhost:3000/reserve/"+$("#id").val(),
                "method": "PUT",
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": formData
            };

            $.ajax(settings).done(function (response) {
                location.reload();
            });
        });

        $('#movieForm').submit(function(event) {
            // Previne o comportamento padrão de enviar o formulário e recarregar a página
            event.preventDefault();

            const id = $("#idMovie").val();

            const formData = {
                name: $('#movieName').val(),
                synopsis: $('#movieSynopsis').val(),
                rating: $('#rating').val()
            };

            if (id == 0){
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "http://localhost:3000/movies",
                    "method": "POST",
                    "headers": {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    "data": formData
                };
            } else {
                var settings = {
                    "async": true,
                    "crossDomain": true,
                    "url": "http://localhost:3000/movies/"+id,
                    "method": "PUT",
                    "headers": {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    "data": formData
                };
            }

            $.ajax(settings).done(function (response) {
                location.reload();
            });
        });

        $('#myTable tbody').on('click', '.edit-btn', function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const synopsis = $(this).data('synopsis');
            const rating = $(this).data('rating');

            $("#idMovie").val(id);
            $("#movieName").val(name);
            $("#movieSynopsis").val(synopsis);
            $("#rating").val(rating);

            $('#modalMovies').modal('show');
        });

        $('#myTable tbody').on('click', '.delete-btn', function() {
            const id = $(this).data('id');
            const settings = {
                "async": true,
                "crossDomain": true,
                "url": "http://localhost:3000/movies/"+id,
                "method": "DELETE",
                "headers": {}
            };

            $.ajax(settings).done(function (response) {
                location.reload();
            });    
        });
    </script>

    
</body>
</html>
