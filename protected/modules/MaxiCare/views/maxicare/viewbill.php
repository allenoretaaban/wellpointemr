<?php
  $model = HmoBilling::model()->findByPk($_GET["id"]);  
  
?>
<h1>MaxiCare Billing # <?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',        
         array(
                    'name'=>'HMO',
                    'value'=> Hmo::model()->findByPk($model->hmo_id)->name
                ),        
        'prepared_by',
        //'by_userid',
        'date_prepared',
        'date_due',
        //'pds_hmo_id',        
         array(
                    'name'=>'bill_total',
                    'value'=> number_format($model->bill_total,2 )
                ),
    ),
)); ?>


<div>
    <fieldset>
        <legend>ValuCare Forms </legend>
        
        <?php
              $dataSource = new CActiveDataProvider('HmoForm', array(
                    'criteria'=>array(
                            'condition'=>'hmo_billing_id = ' . $model->id
                    ),
                    'pagination'=>array(
                            'pageSize'=>100,
                    ),
             ));
             
             $this->widget('zii.widgets.grid.CGridView', array(
                    'template'=>"{summary}\n{pager}\n{items}\n{pager}\n{summary}",
                    'id'=>'pds-grid',
                    'dataProvider'=>$dataSource,
                    'ajaxUpdate' => false,
                    'columns'=>array(
                    'id',
                    'avail_date',
                    //'hmo_name',
                    'patient_name',
                     array(
                                'name'=>'form_total',
                                'value'=> 'number_format($data->form_total,2 )'
                            ),
                    array(
                                'class'=>'CButtonColumn',
                                'template'=>'{view}',
                                'buttons'=>array
                                (
                                    'view' => array
                                    (
                                        'label'=>'View Details',
                                        'url'=>'Yii::app()->createUrl("MaxiCare/MaxiCare/viewform", array("id"=>$data->id))',
                                         'label'=>'View Transaction Items',
                                        
                                    ),
                                    'update' => array
                                    (
                                        
                                    ),
                                    'delete' => array
                                    (
                                        
                                    ),
                                ),
                    ),
                ),
            ));
            ?>

        
        
    </fieldset>

</div>


<a href="<?= Yii::app()->createUrl("ValuCare/", array());  ?>">Back to ValuCare Billings List</a>

<br/>
<br/>   <br/>   

<div id="sidebar">
<div class="portlet" style="bottom:0;">
        <div class="portlet-title">Print Custom Billing Options   </div>
            <ul>
                <li>
                    <a target="_blank" href="<?= Yii::app()->createUrl("MaxiCare/MaxiCare/printWpPayable", array("id"=>$model->id));  ?>">Print WellPoint Clinic Payable Billing</a><br/>
                </li>
                <li>
                    <a target="_blank" href="<?= Yii::app()->createUrl("MaxiCare/MaxiCare/printWpPayableCategories", array("id"=>$model->id));  ?>">Print WellPoint Clinic Payable Billing with Categories</a><br/>
                </li>
                <li>
                    <a target="_blank"  href="<?= Yii::app()->createUrl("MaxiCare/MaxiCare/printDoctorPayable", array("id"=>$model->id));  ?>">Print Doctor Payable Billing </a>     <br/>
                </li>
                
            </ul>   
    </div>
</div>

</div>