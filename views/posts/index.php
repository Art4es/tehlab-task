<?php

use app\models\User;
use yii\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $user User */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (!Yii::$app->user->isGuest): ?>
        <p>
            <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'text:ntext',
            [
                'label' => 'Created by',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    return !empty($data->createdBy) ? $data->createdBy->username : 'unknown user';
                },
            ],
            [
                'label' => 'Last Updated by',
                'class' => 'yii\grid\DataColumn',
                'value' => function ($data) {
                    return (!empty($data->updatedBy)) ? $data->updatedBy->username : 'unknown user';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'buttons' => [
                    'update' => function ($url, $model) use ($user) {
                        if (!$user) {
                            return null;
                        }
                        if ($user->isAdmin() || $model->created_by === $user->id) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => 'Edit',
                            ]);
                        }
                        return null;
                    },
                    'delete' => function ($url, $model) use ($user) {
                        if (!$user) {
                            return null;
                        }
                        if ($user->isAdmin() || $model->created_by === $user->id) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => 'Delete',
                            ]);
                        }
                        return null;
                    },
                ]
            ],
        ],
    ]); ?>


</div>
