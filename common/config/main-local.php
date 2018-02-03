<?php
return [
    'components' => [
		'yandexMapsApi' => [
        'class' => 'mirocow\yandexmaps\Api',
    ],
		
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=westnetwork',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com', // хост почтовго сервера
                'username' => 'alexwebprograms@gmail.com', // имя пользователя
                'password' => '6yhn1234', // пароль пользователя
                'port' => '465', // порт сервера
                'encryption' => 'ssl', // тип шифрования
            ],
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' =>  false,
        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
        ],
    ],
];
