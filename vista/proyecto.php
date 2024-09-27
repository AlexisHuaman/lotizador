<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Estilo de las pestañas */
        .tabs {
            display: flex;
            cursor: pointer;
        }

        .tab {
            padding: 10px 20px;
            background-color: #f3f3f3;
            border: 1px solid #ddd;
            margin-right: 5px;
        }

        .tab.active {
            background-color: #007bff;
            color: white;
        }

        .tab-content {
            display: none;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: white;
        }

        .tab-content.active {
            display: block;
        }

        /* Estilos para el zoom */
        #mapContainer {
            width: 100%;
            height: 600px;
            overflow: hidden;
            position: relative;
            border: 1px solid #ccc;
        }

        #mapImage {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transform-origin: center center;
        }
    </style>
</head>

<body>
    <?php include_once("../components/layout.php") ?>

    <!-- Pestañas (Tabs) -->
    <div class="tabs">
        <div class="tab active" data-tab="tab1">Inicio</div>
        <div class="tab" data-tab="tab2">Plano</div>
    </div>

    <!-- Contenido de cada pestaña -->
    <div id="tab1" class="tab-content active">
        <h1>Contenido de Inicio</h1>
        <p>Aquí puedes mostrar información del proyecto, como detalles generales.</p>
    </div>

    <div id="tab2" class="tab-content">
        <h1>Plano Interactivo</h1>

        <!-- Contenedor para el plano -->
        <div id="mapContainer">
            <img id="mapImage" src="../imagenes/proyecto_plano.png" alt="Plano del Proyecto">
        </div>
    </div>

    <script src="../js/proyecto.js"></script>

    <!-- Script para las pestañas y el zoom -->
    <script>
        $(document).ready(function() {
            // Manejo de pestañas
            $(".tab").click(function() {
                $(".tab").removeClass("active");
                $(".tab-content").removeClass("active");

                $(this).addClass("active");
                let tabToShow = $(this).data("tab");
                $("#" + tabToShow).addClass("active");
            });

            // Variables para el zoom
            let scale = 1;
            const zoomStep = 0.1;
            const img = document.getElementById('mapImage');

            // Manejar el zoom con la rueda del mouse
            $('#mapContainer').on('wheel', function(e) {
                e.preventDefault();

                // Aumentar o reducir el zoom
                if (e.originalEvent.deltaY < 0) {
                    scale += zoomStep; // Zoom In
                } else {
                    scale = Math.max(1, scale - zoomStep); // Zoom Out
                }

                // Aplicar la escala al contenedor de la imagen
                img.style.transform = `scale(${scale})`;
            });
        });
    </script>
</body>

</html>