<?php
$this->breadcrumbs=array(
	$this->module->id,
);
?>
<h1>Programmed Results</h1>

<span>Select from Available Programmed Results</span><br/>

<style>
.results li{
    padding:5px;
}
</style>

<div>
    <ul class="results">
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagResBloodchem/admin',array()) ?>" >Blood Chemistry Result</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagUrinalysis/admin',array()) ?>" >Urinalysis</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagFecalysis/admin',array()) ?>" >Fecalysis</a>
        </li>
        <li>
            <a href="<?= Yii::app()->createAbsoluteUrl('DiagHematology/admin',array()) ?>" >Hematology</a>
        </li>        
    </ul>
</div>