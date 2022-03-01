<?php 

function debuguear($variable) : string {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

// Escapa / Sanitizar el HTML
function s($html) : string {
    $s = htmlspecialchars($html);
    return $s;
}

function debug_to_console( $data ) { 
    if ( is_array( $data ) ) 
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>"; 
    else 
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>"; echo $output; 
}

?>