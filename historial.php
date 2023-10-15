<?php

function iniciarHistorial()
{
  // Inicializa la array del historial 
  if (!isset($_SESSION['history'])) { //si aun no existe

//Verifica si $_SESSION['history'] está definido; si 
//no lo está, lo inicializa como una matriz vacía. Esto 
//se hace para asegurarse de que haya un historial en el 
//que se puedan almacenar las operaciones realizadas por el usuario.
    $_SESSION['history'] = array();
  }
}

//Esta función se utiliza para mostrar el historial 
//de operaciones almacenadas en la matriz $_SESSION['history'].
function monstrarHistorial()
{
//Calcula el número total de operaciones almacenadas en el 
//historial usando count($_SESSION['history']).
  $total_operacions = count($_SESSION['history']);
// itera a través del historial en orden inverso, 
//comenzando desde el último elemento hasta el primero 
//(esto se hace para mostrar las operaciones en el orden en que 
//se realizaron).
  for ($i = $total_operacions - 1; $i >= 0; $i--) {
    $operacion = $_SESSION['history'][$i];
//En cada iteración, obtiene la operación del historial 
//y la muestra en la página web con un formato simple 
//(echo "$operacion<br><hr>"), separando cada operación con una 
//línea horizontal.
    echo "$operacion<br><hr>";
  }
}

//Esta función se utiliza para limpiar completamente el 
//historial, es decir, eliminar todas las operaciones 
//almacenadas en $_SESSION['history'].
function limpiarHistorial()
{
//Simplemente establece $_SESSION['history'] como una matriz 
//vacía, lo que elimina todas las operaciones anteriores del historial.
  $_SESSION['history'] = array();
}
