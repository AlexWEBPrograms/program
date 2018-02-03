<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 25.03.2017
 * Time: 19:22
 */

namespace console\controllers;

use Yii;
use yii\console\Controller;
/**
 * Инициализатор RBAC выполняется в консоли php yii rbac/init
 */
class RbacController extends Controller {

    public function actionInit() {
        $auth = Yii::$app->authManager;

        $auth->removeAll(); //На всякий случай удаляем старые данные из БД...

        // Создадим роли админа и редактора новостей
        $root=$auth->createRole('root');
        $admin = $auth->createRole('admin');
        $operator = $auth->createRole('operator');

        // запишем их в БД
        $auth->add($root);
        $auth->add($admin);
        $auth->add($operator);

        // Создаем разрешения. Например, просмотр админки viewAdminPage и редактирование новости updateNews
        $rulesRoot= $auth->createPermission('rulesRoot');
        $rulesRoot->description='Права рут';

        $rulesAdmin = $auth->createPermission('rulesAdmin');
        $rulesAdmin->description = 'Права адміна';

        $rulesOperator = $auth->createPermission('rulesOperator');
        $rulesOperator->description = 'Права оператора';

        // Запишем эти разрешения в БД
        $auth->add($rulesRoot );
        $auth->add($rulesAdmin );
        $auth->add($rulesOperator);

        // Теперь добавим наследования. Для роли editor мы добавим разрешение updateNews,
        // а для админа добавим наследование от роли editor и еще добавим собственное разрешение viewAdminPage

        // Роли «Редактор новостей» присваиваем разрешение «Редактирование новости»
        $auth->addChild($operator,$rulesOperator);

        // админ наследует роль редактора новостей. Он же админ, должен уметь всё! :D
        $auth->addChild($admin, $operator);
        $auth->addChild($root,$admin);

        // Еще админ имеет собственное разрешение - «Просмотр админки»
        $auth->addChild($admin, $rulesAdmin);
        $auth->addChild($root, $rulesRoot);

        // Назначаем роль admin пользователю с ID 1
        $auth->assign($root, 1);
        $auth->assign($admin, 1);

        // Назначаем роль editor пользователю с ID 2
        $auth->assign($operator, 2);
    }
}