<?php $this->pageTitle=Yii::app()->name; ?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>

<!--
<ul>
	<li>View file: <tt><?php echo __FILE__; ?></tt></li>
	<li>Layout file: <tt><?php echo $this->getLayoutFile('main'); ?></tt></li>
</ul>
-->

<div style="width:100%;border-bottom:1px solid #FF0000">
<span style="color:#FF0000;font-weight:bold;font-size:16px">Latest Announcements</span>
    <?php
	$arrayAuthRoleItems = Yii::app()->authManager->getAuthItems(2, Yii::app()->user->getId());
$arrayKeys = array_keys($arrayAuthRoleItems);
$role = strtolower ($arrayKeys[0]);
 
    if ($role == "admin"):
    ?>
    <div style="float:right">
        <a href="<?= Yii::app()->createUrl("announce/update", array("id"=>1)) ?>">Update (Admin only)</a>
    </div>
    <?php endif ?>
</div>
<br/>
<?php
 $announce = Yii::app()->db->createCommand()
    ->select('id, text')
    ->from('announce')    
    ->where('id=:id', array(':id'=>1))
    ->queryRow();
    
 echo $announce["text"];
?>