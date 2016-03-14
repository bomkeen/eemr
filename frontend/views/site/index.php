<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use kartik\widgets\Growl;
?>
<!--///////////modal////////////////////-->
<?php
Modal::begin([
    'id' => 'activity-modal',
    'header' => '<h4 class="modal-title">รายละเอียด</h4>',
    'size' => 'modal-lg',
    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
]);
Modal::end();

?>
<!--///////////////Grow-->
<?php if (isset($len)) { 
    echo Growl::widget([
    'type' => Growl::TYPE_WARNING,
    'title' => 'Warning! .ใส่เลขบัตรประชาชนไม่ครบจำนวน',
    'icon' => 'glyphicon glyphicon-exclamation-sign',
    'body' => 'ใส่เป็นตัวเลข 13 หลักเท่านั้น',
    'showSeparator' => true,
    'delay' => 0,
    'pluginOptions' => [
        'showProgressbar' => true,
        'placement' => [
            'from' => 'top',
            'align' => 'center',
        ]
    ]
]);
    
}
?>
<!--////////////////////////-->

<div class="page-header">

    <div class="container">
        <div class="col-md-4 col-md-offset-0">
            <form  method="post" class="form-inline" >
                <div class="form-group">

                    <input type="text" placeholder="เลขบัตรประชาชน 13 หลัก"
                    class="form-control" id="scid" name="scid" 
                    required onKeyUp="if(isNaN(this.value)){ alert('กรุณากรอกตัวเลข'); this.value='';}"
                    />

                </div>

                <button type="submit" class="btn btn-primary glyphicon glyphicon-search"> ค้นหา</button>
            </form>
        </div>

        
        <div class="col-md-7 col-md-offset-1">

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

                        <?php
                        Modal::begin([
                            'id' => 'myModal',
                            'header' => '<h4 class="modal-title">...</h4>',
                            'size' => 'modal-lg',
                            'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">ปิด</a>',
                        ]);
                        Modal::end();
                        ?>
                        <?php
                        $this->registerJs("
    $('#myModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget)
        var modal = $(this)
        var title = button.data('title') 
        var href = button.attr('href') 
        modal.find('.modal-title').html(title)
        modal.find('.modal-body').html('<i class=\"fa fa-spinner fa-spin\"></i>')
        $.post(href)
            .done(function( data ) {
                modal.find('.modal-body').html(data)
            });
        })
");
                  ?>  
