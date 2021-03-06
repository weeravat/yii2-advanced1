<?php
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use kartik\mpdf\Pdf;
use kartik\helpers\Html;

?>
<div class="breadcrumbs">
    <div class="container">
        <h3 class="pull-left"><?= $mText; ?></h3>
        <ul class="pull-right breadcrumb">
            <li><?= Html::a('Home', ['/site/index']); ?></li>
            <li><?=
                Html::a($mText, ['/ncd-clinic/index']);
                ;
                ?></li>
            <li class="active"><?= Html::a($names, ['/ncd-clinic1/clinic7-index']); ?></li>
        </ul>
    </div>
</div>
<div class="service-info margin-left-5 margin-right-5">
<?php
        $gridColumns = [
               [
                      'class' => '\kartik\grid\SerialColumn',
                      'header' => 'ลำดับที่',
                      'headerOptions' => ['style'=>'text-align:center','class'=>'warning blue'],  
                      'hAlign'=>'center',
                      'width'=>'60px',
               ],
               [   
                      'headerOptions' => ['style'=>'text-align:center','class'=>'warning blue'],          
                      'attribute'=>'pname',
                      'label'=>'รายการ(กิจกรรม DMHT)',
                      'vAlign'=>'middle',
                      'hAlign'=>'center',  
                      'hAlign'=>'left',    
                      'format'=>'raw',               
               ],    
               [   
                      'headerOptions' => ['style'=>'text-align:center','class'=>'warning blue'],          
                      'attribute'=>'numh',
                      'header'=>'ในเขต<br>รับผิดชอบ(รพ.)',
                      'vAlign'=>'middle',
                      'hAlign'=>'center',   
               ],
               [   
                      'headerOptions' => ['style'=>'text-align:center','class'=>'warning blue'],          
                      'attribute'=>'numi',
                      'header'=>'ในเขต<br>(อำเภอ)',
                      'vAlign'=>'middle',
                      'hAlign'=>'center',   
               ],    
               [ 
                      'headerOptions' => ['style'=>'text-align:center','class'=>'warning blue'],              
                      'attribute'=>'numo',
                      'header'=>'นอกเขต<br>(อำเภอ)',
                      'vAlign'=>'middle',
                      'hAlign'=>'center',   
               ],       
               [  
                      'headerOptions' => ['style'=>'text-align:center','class'=>'warning blue'],          
                      'attribute'=>'total',
                      'label'=>'รวม',
                      'vAlign'=>'middle',
                      'hAlign'=>'center',   
               ],    
        ];
        $fullExportMenu = ExportMenu::widget([
                      'dataProvider' => $dataProvider,
                      'columns' => $gridColumns,
                      'target' => ExportMenu::TARGET_BLANK,
                      'exportConfig' => [
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_HTML => false,
                      ],    
                      'fontAwesome' => true,
                      'pjaxContainerId' => 'kv-pjax-container',
                      'columnSelectorOptions'=>[
                             'label' => 'Cols',
                             'class' => 'btn btn-success btn-sm ',    
                      ],        
                      'dropdownOptions' => [
                             'label' => 'Export All',
                             'class' => 'btn btn-danger btn-sm',
                             'itemsBefore' => ['<li class="dropdown-header">Export All Data</li>'],
                      ], 
        ]);
echo GridView::widget([
                      'dataProvider' => $dataProvider,
                      'columns' => $gridColumns, 
                      'tableOptions' =>['class'=>'table table-striped table-bordered table-hover'], 
                      'summary' =>"แสดง {begin} - {end} จาก {totalCount} record",          
                      'pjax' => true, 
                      'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container']], 
                      'panel' => [
                             'type' => 'primary',
                             'heading' => '<i class="glyphicon glyphicon-book"></i>&nbsp;' .  $names . '  '.$clinic_n.'   ตั้งแต่วันที่    ' .  
                                            Yii::$app->mycomponent->ShortDateThai($date1) .'   ถึงวันที่     '.  
                                            Yii::$app->mycomponent->ShortDateThai($date2),
                                            //Yii::$app->currency->convert('152.35'),
                      ],
                      'beforeHeader'=>[
                             [
                                    'columns'=>[
                                        ['content'=>'', 'options'=>['colspan'=>2, 'class'=>'text-center warning']], 
                                        ['content'=>'ผลการดำเนินงาน', 'options'=>['colspan'=>4, 'class'=>'text-center warning']],                
                                    ],
                                    'options'=>['class'=>'skip-export']
                             ]
                      ],    
                      'toolbar' => [ 
                             $fullExportMenu,
                             ['content'=>'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' 
                             ],               
                      ]
        ]);
?>
</div>
        