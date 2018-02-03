<?php
/**
 * Created by PhpStorm.
 * User: Alex
 * Date: 25.05.2017
 * Time: 15:54
 */
namespace app\modules\admin\controllers;
use app\models\User;
use app\models\UserSearch;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;


class AdminController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $model=new User();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }
    public function actionSignup()
    {
        if (\Yii::$app->user->can('rulesRoot')) {
            $model = new SignupForm();
            if ($model->load(\Yii::$app->request->post())) {
                if($model->type==0)
                    $type='admin';
                else
                    $type='operator';
                $auth = \Yii::$app->authManager;
                $editor = $auth->getRole($type); // Получаем роль editor
                $auth->assign($editor, $this->id);
                if ($user = $model->signup($type)) {
                    $searchModel = new UserSearch();
                    $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
                    $model=new User();
                        return $this->render('index', [
                            'searchModel' => $searchModel,
                            'dataProvider' => $dataProvider,
                            'model'=>$model
                        ]);
                }
            }

            return $this->render('signup', [
                'model' => $model,
            ]);
        }
        else
            throw new \yii\web\ForbiddenHttpException(\Yii::$app->params['errorRules']);
    }

    public function actionAlex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
        $model=new User();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                \Yii::$app->session->setFlash('success', 'Перевірте свою електронну пошту для подальших інструкцій.');

                return $this->goHome();
            } else {
                \Yii::$app->session->setFlash('error', 'На жаль, ми не можемо скинути пароль для вказаної електронної адреси.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(\Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            \Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionMap()
    {

    


        return $this->render('map');
    }
}