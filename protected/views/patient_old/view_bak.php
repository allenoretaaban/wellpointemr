<?php
$this->breadcrumbs=array(
	'Patients'=>array('admin'),
	$model->firstname
);
?>

<h1>View Patient <?php echo $model->firstname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
                array(        
                     'name'=>'filename',
                     'type'=>'raw',
                     'value'=>'<img src="../'.$model->filename.'" style="height:128px" />',
                ),
		'firstname',
		'lastname',
		'middleinitial',
		'gender',
		'birthdate',
		'civilstatus',
		'street1',
		'street2',
		'barangay',
		'city',
		'province',
        'mobile_no',      
        'tel_no',      
		'occupation',
		'company',
		'spousename',
		'spouseoccupation',
		'emergencycontactname',
		'emergencycontactrelation',
		'emergencycontactaddress',
		'emergencycontactnos',
	),
)); ?>
<a href="<?= Yii::app()->createUrl("Patient/update", array("id"=>$model->id));  ?>">Update Patient</a>        
<br/>
<br/>
<fieldset>
    <legend>Patient Data Sheet (PDS)</legend>
    <?php echo $this->renderPartial('relation/_pds', array('model'=>$model)); ?>
</fieldset>
<br/>
<fieldset>
    <legend>HMO</legend>
    <?php
    /*$this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                    'Contact'=>$this->renderPartial('relation/_contact', array('model'=>$model), $this),
                    'HMO'=>$this->renderPartial('relation/_hmo', array('model'=>$model), $this),
            ),
    )); */
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(                    
                    'HMO'=>$this->renderPartial('relation/_hmo', array('model'=>$model), $this),
            ),
    ));
    ?>
</fieldset>
<br/>
<fieldset>
    <legend>Diagnostics</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                    'Fecalysis'=>$this->renderPartial('relation/_fecalysis', array('model'=>$model), $this),
                    'Hematology'=>$this->renderPartial('relation/_hematology', array('model'=>$model), $this),
                    'Urinalysis'=>$this->renderPartial('relation/_urinalysis', array('model'=>$model), $this),
                    'Blood Chemistry'=>$this->renderPartial('relation/_bloodchem', array('model'=>$model), $this),
            ),
    ));
    ?>
</fieldset>
<br/>

<fieldset>
    <legend>Medical History</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                    'Chronic Illness'=>$this->renderPartial('relation/_chronicillness', array('model'=>$model), $this),
                    'Medical Status'=>$this->renderPartial('relation/_medicalstatus', array('model'=>$model), $this),
                    'Vacinnation'=>$this->renderPartial('relation/_vaccination', array('model'=>$model), $this),
                    'Family History'=>$this->renderPartial('relation/_familyhistory', array('model'=>$model), $this),
                    'Medication History'=>$this->renderPartial('relation/_medicationhistory', array('model'=>$model), $this),
                    'Allergy'=>$this->renderPartial('relation/_allergy', array('model'=>$model), $this),
                    'Present Illness History'=>$this->renderPartial('relation/_presentillnesshistory', array('model'=>$model), $this),
            ),
    ));
    ?>
</fieldset>
<br/>
<fieldset>
    <legend>OB/GYN</legend>
    <?php
    $this->widget('zii.widgets.jui.CJuiTabs', array(
            'tabs'=>array(
                    'Obstetrical History'=>$this->renderPartial('relation/_obstetrical', array('model'=>$model), $this),
                    'Pregnancy Problem'=>$this->renderPartial('relation/_pregnancyproblem', array('model'=>$model), $this),
            ),
    ));
    ?>
</fieldset>