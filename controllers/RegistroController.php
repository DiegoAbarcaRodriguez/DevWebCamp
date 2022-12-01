<?php

namespace Controllers;

use Model\Paquete;
use Model\Registro;
use MVC\Router;
use Model\Usuario;
use Model\Evento;
use Model\Categoria;
use Model\Dia;
use Model\EventosRegistros;
use Model\Hora;
use Model\Ponente;
use Model\Regalo;

class RegistroController
{
    public static function crear(Router $router)
    {
        if (!is_auth()) {
            header('Location:/');
            return;
        }

        $registro = Registro::where('usuario_id', $_SESSION['id']);

        if (isset($registro) && $registro->paquete_id === '3') {
            header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQL
            return;
        }

        if (isset($registro) && $registro->paquete_id === '2') {
            header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQL
            return;
        }

        if (isset($registro) && $registro->paquete_id === '1') {
            header('Location:/finalizar-registro/conferencias');
            return;
        }

        $router->render('registro/crear', [
            'titulo' => 'Finalizar Registro'
        ]);
    }

    public static function gratis(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location:/login');
            }



            $registro = Registro::where('usuario_id', $_SESSION['id']);

            if (isset($registro) && $registro->paquete_id === '3') {
                header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQL
            }

            $token = substr(md5(uniqid(rand(), true)), 0, 8);

            //Crear registro
            $datos = [
                'paquete_id' => '3',
                'pago_id' => '',
                'token' => $token,
                'usuario_id' => $_SESSION['id']
            ];

            $registro = new Registro($datos);
            $resultado = $registro->guardar();

            if ($resultado) {
                header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQL
            }
        }
    }
    public static function pagar(Router $router)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location:/login');
                return;
            }


            if (empty($_POST)) {
                echo json_encode([]);
                return;
            }


            //Crear registro
            $datos = $_POST;
            $datos['token'] = substr(md5(uniqid(rand(), true)), 0, 8);
            $datos['usuario_id'] = $_SESSION['id'];




            try {

                $registro = new Registro($datos);
                $resultado = $registro->guardar();
                echo json_encode($resultado);
            } catch (\Throwable $th) {
                echo json_encode([
                    'resultado' => 'error'
                ]);
            }
        }
    }

    public static function boleto(Router $router)
    {
        //Validar la URL
        $id = $_GET['id'];

        if (!$id || !strlen($id) === 8) {
            header('Location:/');
            return;
        }

        //Buscar registro en la BD
        $registro = Registro::where('token', $id);
        if (!$registro) {
            header('Location:/');
            return;
        }

        //Llenar tablas de referencia
        $registro->usuario = Usuario::find($registro->usuario_id);
        $registro->paquete = Paquete::find($registro->paquete_id);



        $router->render('registro/boleto', [
            'titulo' => 'Asistencia a DevWebCamp',
            'registro' => $registro
        ]);
    }
    public static function conferencias(Router $router)
    {
        if (!is_auth()) {
            header('Location:/login');
            return;
        }

        //Validar que el usuario tenga el plan presencial
        $usuario_id = $_SESSION['id'];
        $registro = Registro::where('usuario_id', $usuario_id);

        if (!isset($registro)) {
            header('Location:/login');
            return;
        }


        if (isset($registro) && $registro->paquete_id === '2') {
            header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQLç
            return;
        }

        if (isset($registro) && $registro->paquete_id === '3') {
            header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQLç
            return;
        }

        //Redireccionar si el usuario ya ha completado su registro
        if (isset($registro->regalo_id) && $registro->paquete_id==='1') {
            header('Location:/boleto?id=' . urlencode($registro->token)); //urlencode se emplea para sanitizar los carácteres y así evita inyecciones SQL
            return;
        }

        $eventos = Evento::ordenar('hora_id', 'ASC');

        $eventosFormateados = [];

        foreach ($eventos as $evento) {

            $evento->categoria = Categoria::find($evento->categoria_id);
            $evento->dia = Dia::find($evento->dia_id);
            $evento->hora = Hora::find($evento->hora_id);
            $evento->ponente = Ponente::find($evento->ponente_id);



            if ($evento->dia_id === '1' && $evento->categoria_id === '1') {
                $eventosFormateados['conferencias_v'][] = $evento;
            }
            if ($evento->dia_id === '2' && $evento->categoria_id === '1') {
                $eventosFormateados['conferencias_s'][] = $evento;
            }
            if ($evento->dia_id === '1' && $evento->categoria_id === '2') {
                $eventosFormateados['workshops_v'][] = $evento;
            }
            if ($evento->dia_id === '2' && $evento->categoria_id === '2') {
                $eventosFormateados['workshops_s'][] = $evento;
            }
        }


        $regalos = Regalo::all('ASC');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!is_auth()) {
                header('Location:/login');
                return;
            }

            $eventos = explode(',', $_POST['eventos']);
            if (empty($eventos)) {
                echo json_encode(['resultado' => false]);
                return;
            }

            $registro = Registro::where('usuario_id', $_SESSION['id']);

            if (!isset($registro) || $registro->paquete_id !== '1') {
                echo json_encode(['resultado' => false]);
                return;
            }

            //Validar la disponibilad de los eventos seleccionados
            $eventosArray = [];
            foreach ($eventos as $eventoId) {
                $evento = Evento::find($eventoId);

                if (!isset($evento) || $evento->disponibles === '0') {
                    echo json_encode(['resultado' => false]);
                    return;
                }

                $eventosArray[] = $evento;
            }


            foreach ($eventosArray as $evento) {
                $evento->disponibles -= 1;
                $evento->guardar();

                //Almacenar el registro

                $datos = [
                    'evento_id' => (int)  $evento->id,
                    'registro_id' => (int) $registro->id
                ];

                $registro_usuario = new EventosRegistros($datos);
                $registro_usuario->guardar();
            }

            //Almacenar regalo
            $registro->sincronizar(['regalo_id' => $_POST['regalo_id']]);
            $resultado = $registro->guardar();

            if ($resultado) {
                echo json_encode(['resultado' => $resultado, 'token' => $registro->token]);
            } else {
                echo json_encode(['resultado' => false]);
            }

            return; //Para evitar que se renderize la vista en el JS, definido para conectar via Fetch con la BD
        }

        $router->render('registro/conferencias', [
            'titulo' => 'Elige Workshops y Conferencias',
            'eventos' => $eventosFormateados,
            'regalos' => $regalos
        ]);
    }
}
