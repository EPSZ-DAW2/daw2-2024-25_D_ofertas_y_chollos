<?php
namespace app\commands;

use yii\console\Controller;
use Yii;

class CopiasSeguridadController extends Controller
{
    public function actionDatabase()
    {
        $db = Yii::$app->db;
        $dsn = $db->dsn;
        preg_match('/dbname=([^;]+)/', $dsn, $matches);
        $dbName = $matches[1];
        $username = $db->username;
        $password = $db->password;
        $backupFile = Yii::getAlias('@app') . "/backups/{$dbName}_" . date('Y-m-d_H-i-s') . ".sql";

        $command = "mysqldump -u{$username} -p{$password} {$dbName} > {$backupFile}";
        system($command);
        echo "Copia de seguridad de la base de datos creada: {$backupFile}\n";
    }

    public function actionFiles()
    {
        $projectPath = Yii::getAlias('@app/copiaSeguridad');
        $backupFile = Yii::getAlias('@app') . "/backups/project_" . date('Y-m-d_H-i-s') . ".tar.gz";

        $command = "tar -czvf {$backupFile} {$projectPath}";
        system($command);
        echo "Copia de seguridad de los archivos creada: {$backupFile}\n";
    }
}