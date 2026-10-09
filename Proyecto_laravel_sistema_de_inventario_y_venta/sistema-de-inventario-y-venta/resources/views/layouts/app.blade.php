<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('titulo', 'Sistema de Inventario y Venta — Ferretería')</title>

    {{-- Tipografía Inter --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <style>
        /* Tipografía general */
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            font-size: 16px;
            font-weight: 400;
            line-height: 1.6;
            color: #1f2937;
            background-color: #f9fafb;
        }

        /* Barra de navegación */
        nav {
            padding: 18px 32px;
            background-color: #111827;
            color: #ffffff;
            font-size: 18px;
            font-weight: 600;
        }

        /* Contenido principal */
        main {
            max-width: 1100px;
            margin: 32px auto;
            padding: 0 24px;
        }

        /* Encabezados */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Inter', sans-serif;
            color: #111827;
            font-weight: 600;
            line-height: 1.3;
        }

        h1 {
            font-size: 30px;
        }

        h2 {
            font-size: 23px;
        }

        /* Formularios y botones */
        input, select, textarea, button {
            font-family: inherit;
            font-size: inherit;
        }

        /* Pie de página */
        footer {
            padding: 20px;
            text-align: center;
            font-size: 13px;
            color: #6b7280;
        }
    </style>
</head>
<body>
    <nav>Sistema de Inventario y Venta — Ferretería</nav>

    <main>
        @yield('contenido')
    </main>

    <footer>
        &copy; {{ date('Y') }} ferreteria.com. Todos los derechos reservados.
    </footer>
</body>
</html>