<?php

return [
    'adminEmail' => 'admin@example.com',
    'senderEmail' => 'noreply@example.com',
    'senderName' => 'Example.com mailer',
    // Mantenimiento de configuraciones
    'limiteComentarios' => 100, // Límite de comentarios por usuario
    'limiteValoraciones' => 50, // Límite de valoraciones por usuario
    'intentosAccesoFallidos' => 3, // Intentos de acceso fallidos permitidos
    'rutaBackup' => '@app/backups', // Ruta para almacenar las copias de seguridad
    'diasRegistroObsoleto' => 30, // Días para considerar un registro como obsoleto
    'palabrasProhibidas' => ['palabra1', 'palabra2', 'palabra3'], // Lista de palabras prohibidas
];
