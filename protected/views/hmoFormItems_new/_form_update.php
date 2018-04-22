
<div class="form">
<style>
	select { width:300px;padding:2px 2px; font-size:1HmoFormItems4px; }
	input, input[type=number] { width:570px;padding:2px 4px; font-size:14px; }
	#HmoFormItems_service_type { width:300px;padding:2px 2px; font-size:14px; }
	input[type=submit], input[type=button], button { width:200px!important;padding:4px 0px; float:right; }
	#cs_table { width:100%; }
	#cs_table td { vertical-align:top;border:1px solid gray;padding:10px 10px; }
	#cs_normal_table td { padding:0px;border:none; }
	#HmoFormItems_med_service { margin:0.2em 0em 0em 0em; width:100%; font-size:14px; }
	#medical_services_box input[type=button] { float:left;width:100%!important;padding:2px 5px;margin:0px 0px 5px 0px; }
	#medical_services_box { padding:5px;border: 1px solid #dedede;width:90%;display:table; }
	#HmoFormItems_charge_fee { text-align:right; }
</style>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-form-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

  
	<div class="row">		
		<?php echo $form->hiddenField($model,'hmo_form_id', array('value'=>$_GET["id"])); ?>		
	</div>
    <!-- 
	<div class="row">
		<?php echo $form->labelEx($model,'item_entry_date'); ?>
		<?php echo $form->textField($model,'item_entry_date'); ?>
		<?php echo $form->error($model,'item_entry_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_avail_date'); ?>
		<?php echo $form->textField($model,'item_avail_date'); ?>
		<?php echo $form->error($model,'item_avail_date'); ?>
	</div-->

	<div class="row">				        
        <?php echo $form->labelEx($model,'payto'); ?>
        <?php echo $form->dropDownList($model,'payto',array('WPCLINIC'=>'WellPoint Clinic','DOCTOR'=>'Doctor')); ?>
        <?php echo $form->error($model,'payto'); ?>       

    	<div style="float:right;margin:7px 0px 0px 3px;">Double Transaction Tag: <input type="text" name="HmoFormItems[double_transaction_tag]" value="<?=$model->double_transaction_tag == 0 ? '' : $model->double_transaction_tag ; ?>" style="width:auto;"> </div>
 
	</div>
	<hr>

	<table border="0" cellpadding="0" cellspacing="0" id="cs_table">
		<tr>
			<td>

				<div class="row">
					<label>Doctor Name (The claimant doctor if payable to the doctor)</label>
			        <small>Search & Select: Type in a character or word to search a doctor name </small>
			        <br>	   
			        <?php 
			            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
			                    array(
			                            'model'=>$model, 
			                            'id'=>'HmoFormItems_claim_doctor_name',
			                            'name'=>'HmoFormItems[claim_doctor_name]',
			                            'attribute'=>'claim_doctor_name',
			                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookup', array()),
			                            'htmlOptions' => array("size"=>'50', "onblur"=>"checkIfEmpty(this)"),  
			                            'options'=>array(
			                                    'select'=>'js:function(event,ui){
			                                            close();
			                                            term=ui.item.value.split(":");
			                                            document.getElementById("HmoFormItems_claim_doctor_id").value=term[0];
			                                            ui.item.value=term[1];
			                                    }'                                    
			                            ),

			                    ),
			                    true
			            );
			        ?>
				</div>

			    <script>
			     	function checkIfEmpty(el){ if(el.value == ''){ document.getElementById("HmoFormItems_claim_doctor_id").value=0; }
			     }
			    </script>
			    
			    <div class="row">        
			        <?php echo $form->hiddenField($model,'claim_doctor_id'); ?>        
			    </div>

				<div class="row">
					<?php echo $form->labelEx($model,'diagnosis'); ?>
					<?php echo $form->textField($model,'diagnosis',array('size'=>60,'maxlength'=>250)); ?>
					<?php echo $form->error($model,'diagnosis'); ?>
				</div>

				<div class="row">
					<?php echo $form->labelEx($model,'req_doctor'); ?>
			        <small>Type in the name of the requesting physician.</small><br/>
					<?php echo $form->textField($model,'req_doctor',array('size'=>60,'maxlength'=>250)); ?>
					<?php echo $form->error($model,'req_doctor'); ?>
				</div>

				<table  border="0" cellpadding="0" cellspacing="0" id="cs_normal_table">
					<tr>
						<td >
							<div class="row">
								<?php echo $form->labelEx($model,'service_type'); ?>		
						        <?php echo $form->dropDownList($model,'service_type',array('DIAGNOSTIC'=>'Diagnostic','CONSULTATION'=>'Consultation','APE'=>'Annual Physical Exam')); ?>
								<?php echo $form->error($model,'service_type'); ?>
							</div>
						</td>
						<td style="padding:0px 0px 0px 5px;">
							<div class="row">
								<?php echo $form->labelEx($model,'charge_type'); ?>		
								<?php echo $form->dropDownList($model,'charge_type',array('CCHARGE'=>'Clinic Charge','PROCEDURE'=>'Procedure','PROF_FEE'=>'Professional Fee')); ?>		<?php echo $form->error($model,'charge_type'); ?>
							</div>
						</td>
					</tr>
				</table>



			</td>
		<tr>
		</tr>
			<td>

				<div class="row">
					<label>Medical Service</label>
			        <small>Search & Select: Type in a character or word to search a medical services </small>
			        <br>	   

			        <table cellpadding="0" cellspacing="0" border="0" style="width:90%;">
			        	<tr>
			        		<td style="border:none;padding:0px;">
								<div class="row" style="margin:0px;">
									<div style="float:left;">
							        <?php 
							            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
							                    array(
							                            'model'=>$model, 
							                            'id'=>'HmoFormItems_med_service_selection',
							                            'name'=>'HmoFormItems[med_service_selection]',
							                            //'attribute'=>'med_service',
							                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('hmoProductService/lookup', array()),
							                            'htmlOptions' => array("size"=>'50', "onblur"=>"checkIfEmptyMedSrvc(this)", "placeholder"=>"Services"),  
							                            'options'=>array(
							                                    'select'=>'js:function(event,ui){
						                                            //console.log(ui.item.value);
						                                            close();
			                                            			document.getElementById("tempMedService").value=ui.item.value;
						                                            term=ui.item.value.split(":");
			                                            			document.getElementById("HmoFormItems_med_service_selection").value=term[0];
			                                            			document.getElementById("HmoFormItems_med_service_amount").value=term[1];
			                                            			document.getElementById("HmoFormItems_med_service_category").value=term[2];
						                                            ui.item.value=term[0];
							                                    }'                                    
							                            ),

							                    ),
							                    true
							            );
							        ?>
									</div>
									<div style="width:5%;float:left;margin:0px 0px 0px 5px;">
			        					<!--/td>
			        					<td style="border:none;padding:0px 0px 0px 10px;"-->
										<input type="button" name="hmo_form_items_category_clinic_add_med_service" value="&nbsp;+&nbsp;" onclick="addMedServices()" style="width:100%!important;padding:2px 0px;margin:3px 0px 0px 0px;">

									</div>
									<input type="hidden" id="tempMedService" value="" name="">
									<input type="hidden" name="HmoFormItems[med_service]" value="" id="HmoFormItems_med_service">
								</div>
			        		</td>
			        	</tr>	
			        </table>
			        <table cellpadding="10" cellspacing="0" width="90%" border="0" id="">
			        	<tr>
			        		<td width="30%;" style="border:none;padding:0px 5px 0px 0px;">
								<div class="row">
									<input style="width:100%;" type="number" placeholder="Amount" id="HmoFormItems_med_service_amount" step="0.01">
								</div>
			        		</td>
			        		<td style="border:none;padding:0px 0px 0px 10px;">
								<div class="row" style="">
									<!--input style="width:100%;" type="text" placeholder="Category" id="HmoFormItems_med_service_category"-->
							        <?php 
							            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
						                    array(
					                            'id'=>'HmoFormItems_med_service_category',
					                            'name'=>'HmoFormItems_med_service_category',
												'source'=>array(
													'Aesthetics',
													'Annual Physical Exam',
													'Clinic Procedure',
													'Consultation',
													'Doctors and Procedures',
													'Laboratory',
													'Medical Clinic',
													'Others',
													'Radiology and Ancillary',
													'Rehabilitation Medicine And Physical Therapy'
												),
					                            'htmlOptions' => array(
					                            	"size"=>'50', 
					                            	"onblur"=>"checkIfEmpty(this)",
					                            	"placeholder"=>"Category",
					                            	"width"=>"100%"
					                            ),  
					                            'options'=>array(
				                                    'select'=>'js:function(event,ui){
					                                    close();
					                                }'                                    
					                            ),
						                    ),
						                    true
							            );
							        ?>											
								</div>
			        		</td>
			        	</tr>	
			        </table>
				</div>
				<!--div class="row">
					<?php //echo $form->labelEx($model,'med_service'); ?>
					<?php //echo $form->textField($model,'med_service',array('size'=>60,'maxlength'=>250)); ?>
					<?php //echo $form->error($model,'med_service'); ?>
				</div-->
				<div id="medical_services_box" class="row"></div>

				<div class="row">
					<?php echo $form->labelEx($model,'charge_fee'); ?>
					<?php echo $form->textField($model,'charge_fee'); ?>
					<?php echo $form->error($model,'charge_fee'); ?>
				</div>

			    <script>
    				var hmoMedIndex = 0;
    				var currentChargeFee = 0;
    				
			     	function checkIfEmptyMedSrvc(el){
			        	if(el.value == ''){ document.getElementById("HmoFormItems_med_service").value=""; }
			     	}
			     	function addMedServices(){
            			srvc = document.getElementById("HmoFormItems_med_service_selection").value;
            			amt = document.getElementById("HmoFormItems_med_service_amount").value;
            			cat = document.getElementById("HmoFormItems_med_service_category").value;
            			msComplete = srvc+":"+amt+":"+cat+":0";

            			if(srvc == null || srvc == "") { alert("Please enter medical service."); return false;}
            			if(isNumeric(amt) == false) { alert("Invalid medical service amount."); return false; }
            			if(cat == null || cat == "") { alert("Please enter medical service category."); return false;}

			     		hmoMedIndex++;
			     		document.getElementById("tempMedService").value = msComplete;
            			var btn = "<input type='button' id='btn"+hmoMedIndex+"' onclick='removeMedServices("+hmoMedIndex+")' value='"+document.getElementById("tempMedService").value+" &nbsp;&nbsp;(x)'>";
            			var valhddn = "<input type='hidden' id='val"+hmoMedIndex+"' value='"+document.getElementById("tempMedService").value+"' name='HmoFormItems[med_service_category][]' class='msv_class'>";
            			btn = btn+valhddn;
						$('#medical_services_box').append(btn);
						computeChargeFee();

						document.getElementById("HmoFormItems_med_service_selection").value = "";
						document.getElementById("HmoFormItems_med_service_amount").value = "";
						document.getElementById("HmoFormItems_med_service_category").value = "";
			     	}
			     	function isNumeric(n) {
  						return !isNaN(parseFloat(n)) && isFinite(n);
					}
					var removeMedServices = function(indexNumber){
						$('#val'+indexNumber).remove();
						$('#btn'+indexNumber).remove();
						computeChargeFee();
					}
					var computeChargeFee = function() {
				        var total_medical_service = 0;
				        var categoryArr = [];
				        $('.msv_class').each(function(index,value){
				            amtArr = $(value).val().split(':');
				            if(parseFloat(amtArr[1])){
				                total_medical_service = total_medical_service + parseFloat(amtArr[1]);
				            }
				            categoryArr.push(amtArr[0]);
				        })
				   
				   		if(categoryArr.length != 0){
					        $('#HmoFormItems_med_service').val(categoryArr.toString());
					        $('#HmoFormItems_charge_fee').val(parseFloat(total_medical_service).toFixed(2));
				   		}else{
				   			var Hmss = document.getElementById("HmoFormItems_med_service_selection").value;
					        $('#HmoFormItems_med_service').val(Hmss);
				   		}
				    }
    				computeChargeFee();

				   $(document).ready(function() {
        				$('#button_form_submit').click(function(ev) {
        					ev.preventDefault();
        					computeChargeFee();
							$('#hmo-form-items-form').submit();
        				});
        			});	
			    </script>

				<?php 
					if($model->is_categorized == 1){
				        /*$msArr = explode(",",$model->med_service);
				        foreach($msArr as $mS){
				            //$hps = HmoProductService::model()->findByAttributes(array('name'=>$mS));
				            if($hps){
				                echo "<script>hmoMedIndex++;".
	            					"var btn = \"<input type='button' id='btn\"+hmoMedIndex+\"' onclick='removeMedServices(\"+hmoMedIndex+\")' value='".$hps->name.":".$hps->amount.":".$hps->category.":".$hps->isvatable." &nbsp;&nbsp;(x)'>\";".
	            					"var valhddn = \"<input type='hidden' id='val\"+hmoMedIndex+\"' value='".$hps->name.":".$hps->amount.":".$hps->category.":".$hps->isvatable."' name='HmoFormItems[med_service_category][]' class='msv_class'>\";".
	            					"btn = btn+valhddn;$('#medical_services_box').append(btn); computeChargeFee();".
									"document.getElementById(\"HmoFormItems_med_service_selection\").value = \"\";document.getElementById(\"HmoFormItems_med_service_amount\").value = \"\";document.getElementById(\"HmoFormItems_med_service_category\").value = \"\";</script>";
				            }
				        }*/

            			$connection=Yii::app()->db;
			            $query = "select * from hmo_form_items_category where hmo_form_item_id = ".(int)$model->itemid." order by category asc";
			            $command = $connection->createCommand($query);
			            $hficat = $command->query();
				        foreach($hficat as $hps){
			                echo "<script>hmoMedIndex++;".
	        					"var btn = \"<input type='button' id='btn\"+hmoMedIndex+\"' onclick='removeMedServices(\"+hmoMedIndex+\")' value='".$hps['med_service'].":".$hps['amount'].":".$hps['category'].":0 &nbsp;&nbsp;(x)'>\";".
	        					"var valhddn = \"<input type='hidden' id='val\"+hmoMedIndex+\"' value='".$hps['med_service'].":".$hps['amount'].":".$hps['category'].":0' name='HmoFormItems[med_service_category][]' class='msv_class'>\";".
	        					"btn = btn+valhddn;$('#medical_services_box').append(btn); computeChargeFee();".
								"document.getElementById(\"HmoFormItems_med_service_selection\").value = \"\";document.getElementById(\"HmoFormItems_med_service_amount\").value = \"\";document.getElementById(\"HmoFormItems_med_service_category\").value = \"\";</script>";
						}
					}else{
		            	echo "<script>document.getElementById(\"HmoFormItems_med_service_selection\").value = \"".$model->med_service."\"</script>";
					}

				?>

			</td>
		</tr>
	</table>

	<div class="row buttons">
		&nbsp;<input type="Button" value="Back" onclick="window.location = '/sandbox/hmoForm/<?=$model->hmo_form_id ?>'">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save', array('id' => 'button_form_submit', 'style' => 'margin-right:2px;') ); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->