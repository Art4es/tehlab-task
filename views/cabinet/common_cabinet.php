<?php

use yii\widgets\DetailView;

?>

    <h1>Common Cabinet</h1>
    <p>
        Same info for all users
    </p>

<?= DetailView::widget([
    'model' => $user,
    'attributes' => [
        'id',
        'username',
        'role',
        'is_active',
    ],
]) ?>