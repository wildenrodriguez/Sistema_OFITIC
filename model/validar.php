<?php

class ValidadorExpresionesRegulares {

    /**
     * Valida una cadena contra un conjunto de expresiones regulares.
     *
     * @param string $cadena La cadena a validar.
     * @param array $expresionesRegulares Un array de expresiones regulares.
     * @return array Un array asociativo con los resultados de la validación.
     */
    public function validarCadena(string $cadena, array $expresionesRegulares): array {
        $resultados = [];
        foreach ($expresionesRegulares as $nombre => $expresion) {
            $resultados[$nombre] = preg_match($expresion, $cadena) === 1;
        }
        return $resultados;
    }
}

// Ejemplo de uso


$expresiones = [
    'email' => '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
    'telefono' => '/^\+?[1-9]\d{1,14}$/',
    'codigo_postal' => '/^\d{5}(-\d{4})?$/',
];

$validador = new ValidadorExpresionesRegulares();

    $cadenaAValidar = 'usuario@dominio.com';
    $resultadosValidacion = $validador->validarCadena($cadenaAValidar, $expresiones);

    echo "<br><h3>";
    print_r($resultadosValidacion);
    echo "<br></h3>";
?>