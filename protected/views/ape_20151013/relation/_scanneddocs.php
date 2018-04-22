<?php
  
$scanneddocs = ApeScanneddocs::model()->findAll(array("condition"=>"ape_id = $model->id")); 

$dataSource = new CActiveDataProvider('ApeScanneddocs', array(
        'criteria'=>array(
                'condition'=>'ape_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
    'id'=>'ape-scanneddocs-grid',
    'dataProvider'=>$dataSource, //new CArrayDataProvider($scanneddocs, array()),   
    'columns'=>array(    
        'title',   
        'description',
        array(
        'header'=>'File Path',
        'name'  => 'filepath',
        'value' => 'CHtml::link($data->filepath, Yii::app()->controller->createUrl("$data->filepath"), array("target"=>"_new"))',
        'type'  => 'raw',
         ),
                array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}{delete}',
                    'buttons'=>array
                (
                        'view' => array
                        (
                            'label'=>'View Scanned Documents',
                            'url'=>'Yii::app()->createUrl("apeScanneddocs/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Scanned Document',
                            'url'=>'Yii::app()->createUrl("apeScanneddocs/update", array("id"=>$data->id))',
                        ),
                        'delete' => array
                        (
                            'label'=>'Delete Scanned Document',
                            'url'=>'Yii::app()->createUrl("apeScanneddocs/delete", array("id"=>$data->id))',
                        ),
                ),
        ),
    ),
)); ?>
<a href="<?php echo Yii::app()->controller->createUrl('apeScanneddocs/create',array("id"=>$model->id)); ?>">Add Scanned Document</a>
