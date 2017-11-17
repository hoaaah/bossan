<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\bootstrap\Modal;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\anggaran\models\TaRkasKegiatan */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>
<div class="ta-rkas-kegiatan-index">
<div class="col-md-12">
    <p>
        <?= Html::a('Tambah Rincian Pendapatan', [
            'creatependapatanrinci',
                'tahun' => $model->tahun,
                'sekolah_id' => $model->sekolah_id,
                'Kd_Rek_1' => $model->Kd_Rek_1,
                'Kd_Rek_2' => $model->Kd_Rek_2,
                'Kd_Rek_3' => $model->Kd_Rek_3,
                'Kd_Rek_4' => $model->Kd_Rek_4,
                'Kd_Rek_5' => $model->Kd_Rek_5,
                'kd_penerimaan_1' => $model->kd_penerimaan_1,
                'kd_penerimaan_2' => $model->kd_penerimaan_2
            ], [
                'class' => 'btn btn-xs btn-success',
                'data-toggle'=>"modal",
                'data-target'=>"#myModalrinci",
                'data-title'=>"Tambah Rincian Pendapatan",
            ]) ?>
    </p>
    <?= GridView::widget([
        'id' => 'ta-belanja_rinci'.$model->Kd_Rek_3.$model->Kd_Rek_4.$model->Kd_Rek_5,    
        'dataProvider' => $dataProvider,
        'export' => false, 
        'responsive'=>true,
        'hover'=>true,     
        'resizableColumns'=>true,
        // 'panel'=>['type'=>'primary', 'heading'=>$this->title],
        'responsiveWrap' => false,        
        'toolbar' => [
            [
                // 'content' => $this->render('_search', ['model' => $searchModel, 'Tahun' => $Tahun]),
            ],
        ],
        'pager' => [
            'firstPageLabel' => 'Awal',
            'lastPageLabel'  => 'Akhir'
        ],
        'pjax'=>true,
        'pjaxSettings'=>[
            'options' => ['id' => 'belanjarinci-pjax'.$model->Kd_Rek_3.$model->Kd_Rek_4.$model->Kd_Rek_5, 'timeout' => 5000],
        ],        
        // 'filterModel' => $searchModel,
        'showPageSummary'=>true,
        'columns' => [
            'no_rinc',        
            [
                'label' => 'Rincian',
                'value' => function($model){
                    return $model->keterangan;
                }
            ],
            [
                'label' => 'Satuan',
                'attribute' => 'satuan123',
            ],            
            [
                'label' => 'Harga Satuan',
                'format' => 'decimal',
                'hAlign' => 'right',
                'attribute' => 'nilai_rp',
            ],         
            [
                'label' => 'Volume',
                'attribute' => 'jml_satuan',
                'hAlign' => 'right',
                'format' => 'decimal'
            ],            
            [
                'label' => 'Total',
                'format' => 'decimal',
                'hAlign' => 'right',
                'attribute' => 'total',
                'pageSummary'=>true
            ],
            [
                'class' => 'kartik\grid\ActionColumn',
                'template' => '{updatependapatanrinci} {deletependapatanrinci}',
                'noWrap' => true,
                'vAlign'=>'top',
                'buttons' => [
                        'updatependapatanrinci' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'ubah'),
                                 'data-toggle'=>"modal",
                                 'data-target'=>"#myModalrinciubah",
                                 'data-title'=> "Ubah Rincian Pendapatan",                                 
                                 // 'data-confirm' => "Yakin menghapus sasaran ini?",
                                 // 'data-method' => 'POST',
                                 // 'data-pjax' => 1
                              ]);
                        },
                        'deletependapatanrinci' => function ($url, $model) {
                          return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url,
                              [  
                                 'title' => Yii::t('yii', 'hapus'),
                                 // 'data-toggle'=>"modal",
                                 // 'data-target'=>"#myModalubah",
                                 // 'data-title'=> "Ubah Unit",                                 
                                 'data-confirm' => "Yakin menghapus pendapatan ini?",
                                 'data-method' => 'POST',
                                 'data-pjax' => 1
                              ]);
                        },
                ]
            ],
        ],
    ]); ?>
</div><!--col-->
</div>