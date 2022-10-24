<?php
// basic sequence with LDAP is connect, bind, search, interpret search
// result, close connection

echo "<h3>LDAP query test</h3>";
echo "Intentando Conexión ...";
$ds=ldap_connect("148.234.13.42");  // must be a valid LDAP server!
echo "connect result is " . $ds . "<br />";

if ($ds) { 
    echo "Conectandose ..."; 
    $r=ldap_bind($ds);     // this is an "anonymous" bind, typically
                           // read-only access
    echo "El resultado de la conexión es " . $r . "<br />";

    echo "Buscando por (sn=S*) ...";
    // Search surname entry
    $sr=ldap_search($ds, "o=My Company, c=US", "sn=S*");  
    echo "El resultado de la busqueda es " . $sr . "<br />";

    echo "Número de entradas regresadas " . ldap_count_entries($ds, $sr) . "<br />";

    echo "Obteiendo entradas ...<p>";
    $info = ldap_get_entries($ds, $sr);
    echo "Información de " . $info["count"] . " artículos obtenidos:<p>";

    for ($i=0; $i<$info["count"]; $i++) {
        echo "Nombre del dominio es: " . $info[$i]["dn"] . "<br />";
        echo "El primero acceso es: " . $info[$i]["cn"][0] . "<br />";
        echo "Primero correo es: " . $info[$i]["mail"][0] . "<br /><hr />";
    }

    echo "Closing connection";
    ldap_close($ds);

} else {
    echo "<h4>Unable to connect to LDAP server</h4>";
}
?>