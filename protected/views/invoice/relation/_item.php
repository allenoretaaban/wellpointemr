<?php
$dataSource = new CActiveDataProvider('InvoiceItem', array(
        'criteria'=>array(
                'condition'=>'invoice_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'invoiceItem-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'description',
        'total',
        'isvatable:boolean',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Invoice Item',
                            'url'=>'Yii::app()->createUrl("invoiceItem/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Invoice Item',
                            'url'=>'Yii::app()->createUrl("invoiceItem/update", array("id"=>$data->id))',
                        ),
                        /*'delete' => array
                        (
                            'label'=>'Delete Invoice Item',
                            'url'=>'Yii::app()->createUrl("invoiceItem/delete", array("id"=>$data->id))',
                        ),*/
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('invoiceItem/create',array("id"=>$model->id)); ?>">Add Invoice Item</a>