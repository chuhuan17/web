<?php
function formatDate($date) {
    return date('F j, Y, g:i a', strtotime($date));
}

function formatCurrency($amount) {
    return '$' . number_format($amount, 2);
}
?>
