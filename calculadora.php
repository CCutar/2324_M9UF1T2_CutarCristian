<?php
//Iniciar la sesion
session_start();

//Incluir el historial
include ('historial.php');

// Llamamos la funcion para inicializar la array del historial si aun no existe
iniciarHistorial();

// Defino una constante llamada CALCULAR_FACTORIAL_ITERATIVO 
//con un valor booleano true. Esta constante se usa posteriormente 
//para determinar si se calculará el factorial de forma iterativa o 
//recursiva.
define('CALCULAR_FACTORIAL_ITERATIVO', true);

// Esta función calcula el factorial de un número $n.
function calcularFactorial($n) {
//Comprueba si la constante CALCULAR_FACTORIAL_ITERATIVO es true. 
//Si es así, calcula el factorial de forma iterativa usando un bucle 
//for, multiplicando sucesivamente los números desde 1 hasta $n.
    if (CALCULAR_FACTORIAL_ITERATIVO) {
        $resultado = 1;
        for ($i = 1; $i <= $n; $i++) {
            $resultado *= $i;
        }
        return $resultado;

//Si CALCULAR_FACTORIAL_ITERATIVO es false, la función calcula 
//el factorial de forma recursiva, utilizando una llamada a sí misma 
//para calcular el factorial de $n - 1. Esta es una implementación 
//típica de la recursión para calcular el factorial.
    } else {
        if ($n <= 1) {
            return 1;
        } else {
            return $n * calcularFactorial($n - 1);
        }
    }
}

//Esta función, calcular, toma varios argumentos: $operacion, 
//$numero1, $numero2, $string1, $substring.
function calcular($operacion, $numero1, $numero2 = null, $string1 = null, $substring = null) {
    //Usando una declaración switch, determina qué operación se 
    //debe realizar en función del valor de $operacion.
    switch ($operacion) {
        case 'suma':
            if (!empty($numero1) && is_numeric($numero1) && !empty($numero2) && is_numeric($numero2)) {
                return $numero1 + $numero2;
            } else {
                return "Error: Ambos números deben ser válidos para la suma.";
            }
        case 'resta':
            if (!empty($numero1) && is_numeric($numero1) && !empty($numero2) && is_numeric($numero2)) {
                return $numero1 - $numero2;
            } else {
                return "Error: Ambos números deben ser válidos para la resta.";
            }
        case 'multiplicacion':
            if (!empty($numero1) && is_numeric($numero1) && !empty($numero2) && is_numeric($numero2)) {
                return $numero1 * $numero2;
            } else {
                return "Error: Ambos números deben ser válidos para la multiplicación.";
            }
        case 'division':
            if (!empty($numero1) && is_numeric($numero1) && !empty($numero2) && is_numeric($numero2)) {
                return $numero1 / $numero2;
            } else {
                return "Error: Ambos números deben ser válidos y el divisor debe ser diferente de cero para la división.";
            }
        case 'factorial':
            if (!empty($numero1) && is_numeric($numero1) && $numero1 >= 0) {
                return calcularFactorial($numero1);
            } else {
                return "Error: El número para el factorial debe ser un entero no negativo.";
            }
        case 'concatenar':
            if (is_string($string1) && is_string($substring)) {
                return $string1 . $substring;
            } else {
                return "Error: Ambos campos deben ser cadenas de texto.";
            }
        case 'eliminarSubstring':
            if (is_string($string1) && is_string($substring)) {
                return str_replace($substring, '', $string1);
            } else {
                return "Error: Ambos campos deben ser cadenas de texto.";
            }
        default:
            return "Error: Operación no válida.";
    }
}

//El código asume que se ha enviado un formulario HTML mediante 
//el método POST. El formulario debe contener campos para operacion, 
//numero1, numero2, string1 y substring.
if (isset($_POST['submit'])) { //el método POST se utiliza para enviar los valores ingresados por el usuario en un formulario HTML al script PHP para su procesamiento.
//Si se ha enviado el formulario (cuando se presiona el botón 
//de envío con el nombre submit), el script PHP recupera los 
//valores enviados mediante $_POST.
    $operacion = $_POST['operacion'];
    $numero1 = $_POST['numero1'];
    $numero2 = $_POST['numero2'];
    $string1 = $_POST['string1'];
    $substring = $_POST['substring'];

//Luego, llama a la función calcular con los valores proporcionados 
//y almacena el resultado en la variable $resultado.
    $resultado = calcular($operacion, $numero1, $numero2, $string1, $substring);
}

// Guardar el resultado en el historial
if (isset($_POST['submit']) && ($resultado != 'Operacion no valida')) {
    $operacionRealizada = "$numero1 $operacion $numero2 = $resultado";
    array_push($_SESSION['history'], $operacionRealizada);
} 


if (isset($_POST['limpiar_historial'])) {
    limpiarHistorial();
  }

//Incluimos el codigo calculadora.php para que no nos redireccione de pagina y nos de error
include("calculadorabootstrap.html");
?>