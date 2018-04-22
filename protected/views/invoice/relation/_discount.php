<?php
$dataSource = new CActiveDataProvider('InvoiceDiscount', array(
        'criteria'=>array(
                'condition'=>'invoice_id = ' . $model->id
        ),
        'pagination'=>array(
                'pageSize'=>10,
        ),
 ));
$this->widget('zii.widgets.grid.CGridView', array( 'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
        'id'=>'invoiceDiscount-grid',
        'dataProvider'=>$dataSource,
        'ajaxUpdate' => false,
	'columns'=>array(
		'description',
                'percentage',
                'flat',
		array(
                    'class'=>'CButtonColumn',
                    'template'=>'{view}{update}',
                    'buttons'=>array
                    (
                        'view' => array
                        (
                            'label'=>'View Invoice Discount',
                            'url'=>'Yii::app()->createUrl("invoiceDiscount/view", array("id"=>$data->id))',
                        ),
                        'update' => array
                        (
                            'label'=>'Update Invoice Discount',
                            'url'=>'Yii::app()->createUrl("invoiceDiscount/update", array("id"=>$data->id))',
                        ),
                        /*'delete' => array
                        (
                            'label'=>'Delete Invoice Discount',
                            'url'=>'Yii::app()->createUrl("invoiceDiscount/delete", array("id"=>$data->id))',
                        ),*/
                    ),
		),
	),
));
?>
<a href="<?php echo Yii::app()->controller->createUrl('invoiceDiscount/create',array("id"=>$model->id)); ?>">Add Invoice Discount</a>