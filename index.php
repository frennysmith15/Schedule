<?php
require 'conexionbd.php';
session_start();

if(!isset($_SESSION['nombre_de_usuario'])) {
    header("location: iniciodesesion.php");
}

?>
<!doctype html>
<html lang="es">

<head>
    <title>Agenda</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="Imagenes/agenda.png" type="image/x-icon" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://unpkg.com/gridjs-jquery/dist/gridjs.production.min.js"></script>
</head>

<body>
    <header">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="Imagenes/agenda.png" alt="Bootstrap" width="48" height="48">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php"><i class="bi bi-house"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" type="button" data-bs-toggle="modal" data-bs-target="#modalAgregar"><i class="bi bi-person-plus""></i> Agregar</a>
                        </li>
                        <li class=" nav-item">
                                    <a href="restaurarDatos.php" class="nav-link"><i class="bi bi-info-circle"></i> Restaurar</a>
                        </li>
                    </ul>
                    <form class="d-flex" role="search" action="cierrasesion.php">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Salir</button>
                    </form>
                </div>
            </div>
        </nav>
        </header>
        <main>

            <div class="container my-2">
                <div id="alertasDiv"></div>
                <div class="table-responsive">
                    <table id="tablaDatos" class="table table-bordered table-sm table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Nombre</th>
                                <th class="text-center">Apellido</th>
                                <th class="text-center">Direccion</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Accion</th>
                            </tr>
                        </thead>

                        <tbody class="tbody"></tbody>

                    </table>
                </div>
                <div class="modal fade" id="modalAgregar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class=" " id="exampleModalLabel"></h1>
                                <h2 class="fs-4 modal-title">Agregar</h2>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="?" class="needs-validation" name="formularioAgregar" method="get" needs-validation>
                                <div class="modal-body">
                                    <div class="">
                                        <div class="mb-1">
                                            <label class="form-label">Nombre</label>
                                            <input id="your_input_id" type="text" class="form-control" name="nombre" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>
                                        
                                        <div class="mb-1">
                                            <label class="form-label">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <label class="form-label">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <label class="form-label">Correo</label>
                                            <input type="text" class="form-control" name="correo" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" aria-expanded="false" data-bs-dismiss="modal">Salir</button>
                                    <button type="submit" id="botonNuevoGuardar" class="btn btn-success">Guardar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="modalModificar" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="modalEditar">Editar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="?" class="needs-validation" name="formularioEditar" method="get" needs-validation>
                                <div class="modal-body">
                                    <div class="">

                                        <input type="text" name="id" class="form-control" id="id"></input>

                                        <div class="mb-1">
                                            <label class="form-label">Nombre</label>
                                            <input type="text" class="form-control" name="nombre" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <label class="form-label">Apellido</label>
                                            <input type="text" class="form-control" name="apellido" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <label class="form-label">Dirección</label>
                                            <input type="text" class="form-control" name="direccion" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>

                                        <div class="mb-1">
                                            <label class="form-label">Correo</label>
                                            <input type="text" class="form-control" name="correo" required></input>
                                            <div class="invalid-feedback">
                                                Debe de introducir un valor.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                    <button id="botonModificarDatos" type="submit" data-bs-dismiss="modal" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalTelefonos" tabindex="-1" aria-labelledby="modalEditar" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="">Telefono</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="?" class="needs-validation" name="formularioTelefono" method="get" needs-validation>
                                <div class="modal-body">
                                    <div class="">
                                        <input type="text" name="id" style="display:none" class="form-control" id="id"></input>
                                        <fieldset disabled>
                                            <div class="mb-1">
                                                <label class="form-label">Contacto</label>
                                                <input type="text" class="form-control" id="disabledInput" name="nombre" required></input>
                                                <div class="invalid-feedback">
                                                    Debe de introducir un valor.
                                                </div>
                                            </div>
                                            <div class="mb-1">
                                                <label class="form-label">Correo</label>
                                                <input type="text" class="form-control" id="disabledInput" name="correo" required></input>
                                                <div class="invalid-feedback">
                                                    Debe de introducir un valor.
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="carga-telefonos row">
                                            <label for="inputPassword" class="form-label">Telefonos</label>
                                            <div class="col-6">
                                                <label class="visually-hidden">Telefono</label>
                                                <input type="text" class="form-control" id="inputTelefono" name="telefono" placeholder="Ingrese su telefono aqui">
                                            </div>
                                            <div class="col-auto">
                                                <select class="form-select form-select" aria-label=".form-select-sm example" require>
                                                    <option selected>Tipo de telefono</option>
                                                    <option value="1">Trabajo</option>
                                                    <option value="2">Celular</option>
                                                    <option value="3">Residencial</option>
                                                    <option value="4">Flota</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="pt-3">
                                            <button id="botonAgregarNumero" type="button" class="btn btn-primary">
                                                <i class="bi bi-plus"></i> Agregar otro numero
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                    <button id="botonModificarDatos" type="submit" data-bs-dismiss="modal" class="btn btn-success">Guardar Cambios</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="modal fade" id="modalEliminar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p class="text-center">¿Estas seguro que desea eliminar esta informacion?</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salir</button>
                                <button type="button" class="btn btn-danger" id="botonBorrar" data-bs-dismiss="modal">Aceptar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
        </script>
        <script src="https://unpkg.com/gridjs/dist/gridjs.umd.js"></script>
        <script src="src/main.js"></script>

</body>

</html>