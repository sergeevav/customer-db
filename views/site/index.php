<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var $this yii\web\View
 * @var $searchModel app\models\UserSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

$this->title = Yii::t('app', 'Customers');

?>
<div class="user-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'username',
        ],
    ]); ?>


</div>
