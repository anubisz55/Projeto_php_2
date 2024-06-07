<?php
switch ($periodo) {
    case 1:
        echo 'Período identificado como manhã';
        echo '<br>';
        break;
    case 2:
        echo 'Período identificado como tarde';
        echo '<br>';
        break;
    case 3:
        echo 'Período identificado como noite';
        echo '<br>';
        break;
    default:
        echo 'Período não identificado';
        echo '<br>';
        break;
}
?>

