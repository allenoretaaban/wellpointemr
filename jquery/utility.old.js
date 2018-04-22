function getCurrentDate()
{
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var day = currentTime.getDate();
    var year = currentTime.getFullYear();
    return month + "/" + day + "/" + year;
}

// add dependency of a grid to another grid
function addGridDependency(grid, dependentGrid)
{
    if ($(grid).data('Dependency') == null)
        $(grid).data('Dependency', Array(dependentGrid));
    else
    {
        var dependency = $(grid).data('Dependency');
        dependency[dependency.length] = dependentGrid;
    }
}


function initPaidTrnxsGrid(title, gridElement, pagerElement, dataUrl)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['itemid','Pay To', "HMO", "Patient", "Doctor", "Med Svc", "Charge Type", "Charge Fee", "Avail Date", "Encode Date","Patient-Service","Charged","Applied", "Action"],
        colModel:[
            {name:'itemid',index:'itemid',width:80,hidden:true},
            {name:'payto',index:'payto', width:120,sortable:false,hidden:true},            
            {name:'hmo_name',index:'hmo_name', width:120,sortable:false,hidden:true},            
            {name:'patient_name',index:'patient_name', width:120,sortable:false,hidden:true}, 
            {name:'claim_doctor_name',index:'claim_doctor_name', width:120,sortable:false,hidden:true},            
            {name:'med_service',index:'med_service', width:120,sortable:false,hidden:true},            
            {name:'charge_type',index:'charge_type', width:120,sortable:false,hidden:true},            
            {name:'charge_fee',index:'charge_fee', width:120,sortable:false,hidden:true},            
            {name:'avail_date',index:'avail_date', width:120,sortable:false,hidden:true},            
            {name:'entry_date',index:'entry_date', width:120,sortable:false,hidden:true},  
            {name:'paid_details',index:'paid_details', width:200,sortable:false,hidden:false},            
            {name:'paid_charge',index:'paid_charge', width:120,sortable:false,hidden:false},            
            {name:'paid_applied',index:'paid_applied', width:120,sortable:false,hidden:false},  
            {name:'Action',index:'Action',width:80,sortable:false}          
            
        ],
        multiselect: false,
        multiboxonly: false,
        height:450,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'itemid',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            
            var ids = $(this).getDataIDs();
            for (var i = 0; i < ids.length; i++) {
                var rowId = ids[i];
                $(this).jqGrid('setRowData', rowId, {Action:"<a href='#' onclick='disApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Disapply</a>&nbsp" });
            }
            
            
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false,search:false},{},{},{},{multipleSearch:true});
}



function initTrnxsGrid(title, gridElement, pagerElement, dataUrl)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['itemid','Pay To', "HMO", "Patient", "Doctor", "Med Svc", "Charge Type", "Charge Fee", "Avail Date", "Encode Date","Patient-HMO","Service","Charge","Is Applied", "Action"],
        colModel:[
            {name:'itemid',index:'itemid',width:80,hidden:true},
            {name:'payto',index:'payto', width:120,sortable:false,hidden:true},            
            {name:'hmo_name',index:'hmo_name', width:120,sortable:false,hidden:true},            
            {name:'patient_name',index:'patient_name', width:120,sortable:false,hidden:true}, 
            {name:'claim_doctor_name',index:'claim_doctor_name', width:120,sortable:false,hidden:true},            
            {name:'med_service',index:'med_service', width:120,sortable:false,hidden:true},            
            {name:'charge_type',index:'charge_type', width:120,sortable:false,hidden:true},            
            {name:'charge_fee',index:'charge_fee', width:120,sortable:false,hidden:true},            
            {name:'avail_date',index:'avail_date', width:120,sortable:false,hidden:true},            
            {name:'entry_date',index:'entry_date', width:120,sortable:false,hidden:true},  
            {name:'detail_patient',index:'detail_patient', width:120,sortable:false,hidden:false},            
            {name:'detail_service',index:'detail_service', width:200,sortable:false,hidden:false},            
            {name:'detail_charge',index:'detail_charge', width:120,sortable:false,hidden:false},  
            {name:'isapplied',index:'isapplied',width:80,hidden:true},
            {name:'Action',index:'Action',width:100,sortable:false}          
            
        ],
        multiselect: false,
        multiboxonly: false,
        height:500,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'itemid',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            
            var ids = $(this).getDataIDs();
            for (var i = 0; i < ids.length; i++) {
                var rowId = ids[i];
                flagapplied = $(this).getCell(rowId, 'isapplied');
                if (parseInt(flagapplied) == 0){
                    $(this).jqGrid('setRowData', rowId, {Action:"<a href='#' onclick='applyCheck(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Apply Check</a>&nbsp" });
                }else{
                    $(this).jqGrid('setRowData', rowId, {Action:"<span style='color:red'>Applied</span>" });
                }
                
                
                
            }
            
            
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false,search:false},{},{},{},{multipleSearch:true});
}

function initHmoTrnxsGrid(title, gridElement, pagerElement, dataUrl)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json', 
        colNames:['itemid', "Patient", 'HMO', 'Pay To', 'Medical Service',  "Fee", "Encode Date","Paid","Tax","Provider Excess","Member Excess","HMO Excess","Is Applied", "Check No", "Action"],
        //colNames:['itemid', "Patient", 'HMO', 'Pay To', 'Doctor', "Med Svc", "Fee", "Avail Date", "Encode Date","Paid","Tax","Provider Excess","Member Excess","HMO Excess","Is Applied", "Check No", "Action"],
        colModel:[
            {name:'itemid',index:'itemid',width:80,hidden:true},
            {name:'patient_name',index:'patient_name', width:120,sortable:false,hidden:false},
            {name:'hmo_name',index:'hmo_name', width:120,sortable:false,hidden:true},            
            {name:'payto',index:'payto', width:50,sortable:false,hidden:false},        
            {name:'claim_doctor_name',index:'claim_doctor_name', width:140,sortable:false,hidden:false},            
            //{name:'med_service',index:'med_service', width:120,sortable:false,hidden:false},            
            {name:'charge_fee',index:'charge_fee', width:100,sortable:false,hidden:false},            
            //{name:'avail_date',index:'avail_date', width:120,sortable:false,hidden:false},            
            {name:'entry_date',index:'entry_date', width:120,sortable:false,hidden:true},  
            {name:'paid_amnt',index:'paid_amnt',width:80,hidden:false},
            {name:'wtax',index:'wtax',width:50,hidden:false},
            {name:'provider_xces',index:'provider_xces',width:50,hidden:false},
            {name:'member_xces',index:'member_xces',width:50,hidden:false},
            {name:'hmo_xces',index:'hmo_xces',width:50,hidden:false},
            {name:'isapplied',index:'isapplied',width:50,hidden:true},
            {name:'hmo_billing_id',index:'hmo_billing_id',width:80,hidden:false},       
            {name:'Action',index:'Action',width:100,sortable:false}   
            
            
        ],
        multiselect: false,
        multiboxonly: false,
        height:500,
        width:1450,
        rowNum:50,
        rowList:[50,100,500,1000],
        pager:pagerElement,
        sortname:'itemid',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            
            var ids = $(this).getDataIDs();
            for (var i = 0; i < ids.length; i++) {
                var rowId = ids[i];
                flagapplied = $(this).getCell(rowId, 'isapplied');
                if (parseInt(flagapplied) == 0){
                    /*
                    $(this).jqGrid('setRowData', rowId, {Action:"<a href='#' onclick='applyCheck(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Apply Check</a>&nbsp" });*/
                    $(this).jqGrid('setRowData', rowId, {Action:"<button style='z-index:99999; cursor: pointer; margin: 5px 1px 1px 5px;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\"  onclick='applyCheck(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Manual</button><br/>"+
                    "<button style='z-index:99999; cursor: pointer; margin: 1px 1px 5px 5px;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\" onclick='QuickCheckApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ",2)'>2%</button>"+
                    "<button style='z-index:99999; cursor: pointer; margin: 1px 1px 5px 1px;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\" onclick='QuickCheckApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ",10)'>10%</button>"+
                    "<button style='z-index:99999; cursor: pointer; margin: 1px 1px 5px 1px;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\" onclick='QuickCheckApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ",15)'>15%</button>" 
                    });
                    
                }else{
                  $(this).jqGrid('setRowData', rowId, {Action:"<span style='color:red'>Applied</span><br/><button style='z-index:99999; cursor: pointer;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\" onclick='disApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Disapply</button>&nbsp" });
                    
                /*$(this).jqGrid('setRowData', rowId, {Action:"<a href='#' onclick='disApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Disapply</a>&nbsp" });*/
                }
                
  
            }
            
            
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false,search:false},{},{},{},{multipleSearch:true});
}

function initHmoPaidTrnxsGrid(title, gridElement, pagerElement, dataUrl)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['itemid', "Patient", 'HMO', 'Pay To', 'Doctor', "Med Svc", "Fee", "Avail Date", "Encode Date","Paid","Tax","Provider Excess","Member Excess","HMO Excess","Is Applied", "HMO Excess Rem", "SOA No", "Action"],
        colModel:[
            {name:'itemid',index:'itemid',width:80,hidden:true},
            {name:'patient_name',index:'patient_name', width:120,sortable:false,hidden:false},
            {name:'hmo_name',index:'hmo_name', width:120,sortable:false,hidden:false},            
            {name:'payto',index:'payto', width:120,sortable:false,hidden:false},        
            {name:'claim_doctor_name',index:'claim_doctor_name', width:120,sortable:false,hidden:false},            
            {name:'med_service',index:'med_service', width:120,sortable:false,hidden:false},            
            {name:'charge_fee',index:'charge_fee', width:120,sortable:false,hidden:false},            
            {name:'avail_date',index:'avail_date', width:120,sortable:false,hidden:true},            
            {name:'entry_date',index:'entry_date', width:120,sortable:false,hidden:true},  
            {name:'paid_amnt',index:'paid_amnt',width:80,hidden:false},
            {name:'wtax',index:'wtax',width:80,hidden:false},
            {name:'provider_xces',index:'provider_xces',width:80,hidden:false},
            {name:'member_xces',index:'member_xces',width:80,hidden:false},
            {name:'hmo_xces',index:'hmo_xces',width:80,hidden:false},
            {name:'isapplied',index:'isapplied',width:80,hidden:true},
            {name:'hmo_xces_rem',index:'hmo_xces_rem',width:80,hidden:false},
            {name:'hmo_billing_id',index:'hmo_billing_id',width:80,hidden:false},       
            {name:'Action',index:'Action',width:100,sortable:false}   
            
            
        ],
        multiselect: false,
        multiboxonly: false,
        height:500,
        rowNum:50,
        rowList:[50,100,500,1000],
        pager:pagerElement,
        sortname:'itemid',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            
            var ids = $(this).getDataIDs();
            for (var i = 0; i < ids.length; i++) {
                var rowId = ids[i];
                flagapplied = $(this).getCell(rowId, 'isapplied');
                if (parseInt(flagapplied) == 0){
                    $(this).jqGrid('setRowData', rowId, {Action:"<span style='z-index:99999; cursor: pointer;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\" onclick='applyCheck(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Apply Check</span>&nbsp" });
                }else{
                  //$(this).jqGrid('setRowData', rowId, {Action:"<span style='color:red'>Applied</span>" });
                    
                $(this).jqGrid('setRowData', rowId, {Action:"<span style='z-index:99999; cursor: pointer;'  onMouseOver=\"this.style.color='#000'\"  onMouseOut=\"this.style.color='#000'\" onclick='disApply(\"" +
                    $(this).getCell(rowId, 'itemid') + "\", " +
                    "\"" + $(this).getCell(rowId, 'charge_fee') + "\"," + 
                    "\"" + $(this).getCell(rowId, 'patient_name') + "\"," +
                    "\"" + $(this).getCell(rowId, 'med_service') + "\"" +
                    ")'>Disapply</span>&nbsp" });
                }
                
                
                
            }
            
            
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false,search:false},{},{},{},{multipleSearch:true});
}