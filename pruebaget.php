<?php

If ($_GET){
    if (isset($_GET["agente_id"]))
    {
    echo "si trae el parametro agente_1 es: "    ;
    echo $_GET["agente_id"];
    }
} else echo "Sin envio"

?>