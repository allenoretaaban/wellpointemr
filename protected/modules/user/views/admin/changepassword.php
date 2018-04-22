<?php
$this->breadcrumbs=array(
	(UserModule::t('Users'))=>array('admin'),
	$usermodel->username=>array('view','id'=>$usermodel->id),
	'Change Password',
);
?>

<h1>Change Password</h1>

<?php echo $this->renderPartial('_password', array('model'=>$model,'usermodel'=>$usermodel)); ?>