<?php
   class JQGridResults{
        public $page = 0;
        public $total = 0;
        public $records = 0;  
        public $rows  = 0;
    }
    /*
    Public Structure JQGridRow
        Public id As Integer
        Public cell As String()
    End Structure
    */
    class JQGridRow{
        public $id = 0;
        public $cell = "";
        
    }
    
    class Trnx{
        public $itemid  = 0;
        public $payto  = "";
        public $hmo_name  = "";
        public $patient_name  = "";
        public $claim_doctor_name  = "";
        public $med_service  = "";
        public $service_type  = "";
        public $charge_type  = "";
        public $charge_fee  = "";
        public $avail_date  = "";
        public $entry_date  = "";   
        public $detail_patient = "";
        public $detail_service = "";
        public $detail_charge = "";
        
        public $paid_details = "";
        public $paid_charge = "";
        public $paid_applied = "";
        
        
        
    }
?>
