<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
   
    

    <div class="row">
        <div class="container">
        <div class="col-md-4 col-md-offset-1">
            <?php $form = ActiveForm::begin(['id' => 'Search']); ?>
            <div class="form-inline-block">
                
               <?= $form->field($model, 'cid')->textInput(['maxlength' => true]) ?>

                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        </div>
        </div>
</div>

<?php if (isset($dataProvider)) { ?>

    <div class="row">
        <div class="col-md-12 col-md-offset-0">
            <div class="list">
                <?=
                GridView::widget([
                    'dataProvider' => $dataProvider,
                    //'filterModel' => $searchModel,
                    'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => '-'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
                        'hcode',
                        'hname',
                        'pname',
                        [
                            'label' => 'วันที่รับบริการ',
                            'format' => 'raw',
                            'value' => function ($model) {
                                $strYear = date("Y", strtotime($model['vstdate'])) + 543;
                                $strMonth = date("n", strtotime($model['vstdate']));
                                $strDay = date("j", strtotime($model['vstdate']));
                                $strMonthCut = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");
                                $strMonthThai = $strMonthCut[$strMonth];
                                return "$strDay $strMonthThai $strYear";
                            },
                                ],
                                'pdx',
                                'pdx_name',
                                'price',
//                                [
//                                    'header' => 'Detail',  
//                                    'format'=>'raw',
//                                    'value' => function ($data) {
//                                        return Html::a(' ดูข้อมูล', ['site/detail', 'vn' => $data['vn'], 'hcode' => '10769'], ['class' => 'btn btn-success glyphicon glyphicon-zoom-in']);
//                                    }],
                                        [

                                            'label' => 'detail View',
                                            'format' => 'raw',
                                            'value' => function ($data) {
                                                return Html::a('', ['site/detail2', 'vn' => $data['vn'], 'hcode' => '10769'], [
                                                    'class' => 'glyphicon glyphicon-zoom-in',
                                                            'data-toggle' => "modal",
                                                            'data-target' => "#myModal",
                                                            'data-title' => $data['pname'],
                                                ]);
                                            }],
                                            ],
                                        ]);
                                        ?>

                                    </div>
                                </div>
                            </div>

                        <?php } ?>
