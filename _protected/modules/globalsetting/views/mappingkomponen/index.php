<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\globalsetting\models\RefKomponenBosSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ref Komponen Bos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ref-komponen-bos-index">

    <?= GridView::widget([
        'id' => 'ref-komponen-bos',    
        'dataProvider' => $dataProvider,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'resizableColumns'=>true,
        'panel'=>['type'=>'primary', 'heading'=>$this->title],
        'responsiveWrap' => false,        
        'toolbar' => [
            [
                'content' => $this->render('_search', ['model' => $searchModel, 'Tahun' => $Tahun]),
            ],
        ],       
        'pager' => [
            'firstPageLabel' => 'Awal',
            'lastPageLabel'  => 'Akhir'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'referensi-pjax', 'timeout' => 5000],
        ],        
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'komponen',
            'refRekKomponens.refRek5.Nm_Rek_5',

            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{mapping} {deletemapping}', //'{view} {update} {delete}',
                'noWrap' => true,
                'vAlign'=>'top',
                'buttons' => [
                        'mapping' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-random"></span>', ['update', 'id' => $model->id],
                              [  
                                 'title' => Yii::t('yii', 'Mapping'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalubah",
                                 'data-title'=> "Mapping ".$model->komponen,                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        }, 
                        'deletemapping' => function ($url, $model) {
                            IF(isset($model->refRekKomponen)){
                              return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['deletemapping', 'id' => $model->id, 'Kd_Rek_1' => $model->reRekKomponen->Kd_Rek_1],
                                  [  
                                     'title' => Yii::t('yii', 'Mapping'),
                                     // 'data-toggle'=>"modal",
                                     // 'data-target'=>"#myModalubah",
                                     // 'data-title'=> "Mapping ".$model->komponen,                                 
                                     'data-confirm' => "Yakin menghapus mapping ini?",
                                     'data-method' => 'POST',
                                     'data-pjax' => 1
                                  ]);
                            }
                        },                                                
                ]
            ],
        ],
    ]); ?>
</div>
<?php Modal::begin([
    'id' => 'myModal',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
        'options' => [
            'tabindex' => false // important for Select2 to work properly
        ], 
]);
 
echo '...';
 
Modal::end();

Modal::begin([
    'id' => 'myModalubah',
    'header' => '<h4 class="modal-title">Lihat lebih...</h4>',
        'options' => [
            'tabindex' => false // important for Select2 to work properly
        ], 
]);
 
echo '...';
 
Modal::end();

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
$this->registerJs("
    $('#myModalubah').on('show.bs.modal', function (event) {
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