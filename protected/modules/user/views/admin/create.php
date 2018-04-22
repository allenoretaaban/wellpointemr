<?php
$this->breadcrumbs=array(
	UserModule::t('Users')=>array('admin'),
	'Add',
);
?>
<h1>Add User</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'profile'=>$profile)); ?>