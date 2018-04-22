<link href="<?php echo Yii::app()->request->baseUrl; ?>/modal/modal.css" media="screen" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/modal/modal.js"></script>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'hmo-form-items-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

  
	<div class="row">		
		<?php echo $form->hiddenField($model,'hmo_form_id'); ?>		
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
	</div>

	<div class="row">
		<label>Doctor Name (The claimant doctor if payable to the doctor)</label>
        <small>Search & Select the name of the Doctor</small>
        <?php 
            $doctors = new Doctor(); $docs = $doctors->findAll(); $a = array(); 
            $a[] = "Select a Doctor";
            foreach($docs as $doc){
                $a[$doc->id]= $doc->firstname. ' ' .$doc->lastname;
            }          
        ?>
        
        
        <?php echo $form->dropDownList($model,'claim_doctor_name', $a, array('options' => array($model->claim_doctor_id=>array('selected'=>true), 'empty'=>'Select a Doctor'))); ?>	   
        <!--<?php 
            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$model, 
                            'id'=>'HmoFormItems_claim_doctor_name',
                            'name'=>'HmoFormItems[claim_doctor_name]',
                            'attribute'=>'claim_doctor_name',
                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('doctor/lookup', array()),
                            'htmlOptions' => array("size"=>'50', "onblur"=>"checkIfEmtpry(this)"),  
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
        ?> -->
        
	</div>
    <script>
     function checkIfEmtpry(el){
         if(el.value == ''){
             document.getElementById("HmoFormItems_claim_doctor_id").value=0;
         }
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
    
    <div id="boxes">
        <div id="dialog" class="window">   
        <div style="width:100%;text-align:right" ><a href="#" class="close" /><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/closelabel.png" /></a></div> 
            
            <b>Select Medical Service</b><br/>                
            <?php 
            $rep = new Productservice();  
            echo $this->widget('zii.widgets.jui.CJuiAutoComplete',
                    array(
                            'model'=>$rep, 
                            'id'=>'HmoFormItems_name',
                            'name'=>'HmoFormItems[name]',
                            'attribute'=>'name',
                            'sourceUrl'=>Yii::app()->createAbsoluteUrl('productservice/test', array()),
                            'htmlOptions' => array("size"=>'50'),  
                            'options'=>array(
                                    'select'=>'js:function(event,ui){
                                            close();
                                            term=ui.item.value.split(":");                                  
                                            document.getElementById("ref_product_name").value=term[1];          
                                            document.getElementById("ref_product_price").value=term[2];
                                            document.getElementById("ref_product_id").value=term[0];
                                            ui.item.value=term[1];                                     
                                    }'                                    
                            ),

                    ),
                    true
            );
            
            ?>                                       
            <input type="hidden" id="ref_product_id"> 
            <input type="hidden" id="ref_product_name"> 
            <input type="hidden" id="ref_product_price">                 
            <button class="button" id="select">Select</button>
        </div>
    </div>
    <div id="mask"></div>

	<div class="row">
		<?php echo $form->labelEx($model,'med_service'); ?>
        
        <?php 
            echo $form->hiddenField($model,'med_service');
            $connection=Yii::app()->db;                                           
            $query ="select *
                    from hmo_form_item_service
                    where hmo_form_item_id = ".$model->itemid;
            $command=$connection->createCommand($query);
            $dataReader=$command->query();                    
            $rowcount = $dataReader->getRowCount(); 
            $med_count =$rowcount; 
            if ($rowcount > 0){          
                echo"<div id='services' > <small>Click [+] button to add services</small>
                <button id='show_modal'>+</button> ";
                                
                foreach($dataReader as $row) {
                    echo "<div class='service'>
                    <input name='HmoFormItems[service_id][]' class='service_id' type='hidden' value='". $row["ref_productservice_id"] ."'/>
                    <input type='hidden'  name='HmoFormItems[service_name][]' value='". $row["ref_productservice_name"] ."'/>
                    <span class='service_name'>". $row["ref_productservice_name"] ."</span>&nbsp&nbsp
                    <input name='HmoFormItems[price][]' class='price' type='hidden' value='". $row["ref_productservice_price"] ."'/>&nbsp;&nbsp;&nbsp;<button class='minus'>-</button></div>"; 
                }
                echo "</div>";
            }else{
                echo $form->textField($model,'med_service',array('size'=>60,'maxlength'=>250));
            }   
        ?>      
		<?php echo $form->error($model,'med_service'); ?>
	</div>
    
    <script>
        $(document).ready(function(){                                  
            $('.minus').css({ 'cursor': 'pointer'});
            $('button').css({ 'cursor': 'pointer'});
            $('#show_modal').css({ 'cursor': 'pointer'}).click(function(){ 
                showModal("dialog",500,400);   
                return false;
            });  
            
            $('.minus').live('click',function(){
                $(this).parent().html('');   
                calculate();
                return false;
            });
            $('#select').click(function(){
                //item = $('#HmoFormItems_name').val();
                ref_product_id = $('#ref_product_id').val();
                ref_product_name = $('#ref_product_name').val();
                ref_product_price = $('#ref_product_price').val();
                if(ref_product_name!='') {
                    $('#services').append("<div class='service'><input name='HmoFormItems[service_id][]' class='service_id' type='hidden' value='"+ ref_product_id+"'/><input type='hidden'  name='HmoFormItems[service_name][]' value='"+ref_product_name+"'/><span class='service_name'>"+ref_product_name+"</span>&nbsp&nbsp<input name='HmoFormItems[price][]' class='price' type='hidden' value='"+ref_product_price+"'/>&nbsp;&nbsp;&nbsp;<button class='minus'>-</button></div>");
                }
                $('.minus').css({ 'cursor': 'pointer'});
               
                calculate();                        
                return false;
            });
            if($('#HmoFormItems_payto').val()!='DOCTOR'){ 
                   $('#HmoFormItems_claim_doctor_name').attr({"disabled":'disabled'})                                         
                   $('#HmoFormItems_claim_doctor_name option[value="0"]').attr({"selected":"selected"}); 
            }
            
             $('#HmoFormItems_payto').live('change',function(){     
               if($(this).val() == 'DOCTOR'){    
                   $('#HmoFormItems_claim_doctor_name').removeAttr("disabled");                
               }else{     
                   $('#HmoFormItems_claim_doctor_name').attr({"disabled":'disabled'})                                         
                   $('#HmoFormItems_claim_doctor_name option[value="0"]').attr({"selected":"selected"});   
               }                            
            });
            
             $('input[type="submit"]').on('click',function(){
                    claim_doctor_name = $('#HmoFormItems_claim_doctor_name :selected').text();      
                    claim_doctor_id = $('#HmoFormItems_claim_doctor_name :selected').val();            
                    payto = $('#HmoFormItems_payto').val();            
                    service_type = $('#HmoFormItems_service_type').val();
                    diagnosis = $('#HmoFormItems_diagnosis').val();
                    med_service();                                          
                    medical_service = $('#HmoFormItems_med_service').val();   
                    charge_type = $('#HmoFormItems_charge_type').val();
                    charge_fee = $('#HmoFormItems_charge_fee').val();
                    if(payto==''){
                        alert('Please Payable To');
                        return false;     
                    }
                    if(payto!='DOCTOR'){
                         $('#HmoFormItems_claim_doctor_name option[value="0"]').attr({"selected":"selected"});
                         claim_doctor_id = 0;   
                    }
                    if(payto=='DOCTOR' && claim_doctor_id==0){
                        alert("Please Select a Doctor");
                        return false;
                    }
                    if(medical_service==''){
                        alert('Medical Service cannot be blank.');
                        return false;     
                    }
                    
                    if(diagnosis==''){
                        alert('Please Insert Diagnosis');
                        return false;     
                    } 
                     if(service_type==''){
                        alert('Please Service Type');
                        return false;     
                    }  
                     if(charge_type==''){
                        alert('Please Charge Type');
                        return false;     
                    }
                     if(charge_type=='' || charge_type==0){
                        alert('Please Charge Type');
                        return false;     
                    }
                    
                    if(claim_doctor_id==0){
                        $('#HmoFormItems_claim_doctor_name :selected').val("");
                        $('#HmoFormItems_claim_doctor_name :selected').text(''); 
                        new_claim_doc_id = $('#HmoFormItems_claim_doctor_id').val(0);      
                    }else{   
                        new_claim_doc_id = $('#HmoFormItems_claim_doctor_id').val(claim_doctor_id);      
                        new_claim_doc_name =  $('#HmoFormItems_claim_doctor_name :selected').val(claim_doctor_name); 
                    } 
                
             }); 
        });
        
        function med_service(){
            
            var service_name = "";                
            $('.service .service_name').each(function(index, value) {
                a = $(this).text();
                service_name = service_name+"\\\ "+a;  
            });   
            service_name = service_name.substr(1);
            $('#HmoFormItems_med_service').val(service_name);              
        }
        
        function calculate(){ 
            var  price = 0;
            $('.service .price').each(function(index, value){
                a = $(this).val();
                price +=  parseInt(a);  
            });
            $('#HmoFormItems_charge_fee').val(price);   
        }
        
        
        
    </script>

	<div class="row">
		<?php echo $form->labelEx($model,'service_type'); ?>		
        <?php echo $form->dropDownList($model,'service_type',array('DIAGNOSTIC'=>'Diagnostic','CONSULTATION'=>'Consultation','APE'=>'Annual Physical Exam')); ?>
		<?php echo $form->error($model,'service_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'req_doctor'); ?>
        <small>Type in the name of the requesting physician.</small><br/>
		<?php echo $form->textField($model,'req_doctor',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'req_doctor'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'charge_type'); ?>		
<?php echo $form->dropDownList($model,'charge_type',array('CCHARGE'=>'Clinic Charge','PROCEDURE'=>'Procedure','PROF_FEE'=>'Professional Fee')); ?>
		<?php echo $form->error($model,'charge_type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'charge_fee'); ?>
		<?php echo $form->textField($model,'charge_fee'); ?>
		<?php echo $form->error($model,'charge_fee'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->