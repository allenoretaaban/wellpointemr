function getCurrentDate()
{
    var currentTime = new Date();
    var month = currentTime.getMonth() + 1;
    var day = currentTime.getDate();
    var year = currentTime.getFullYear();
    return month + "/" + day + "/" + year;
}

function initCourierAutocomplete(inputElement, courierList)
{
    $(inputElement).autocomplete({source:courierList});
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

function initGrid(title, gridElement, pagerElement, dataUrl, courierList)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['BookingNo','Ref','Account','Remarks','Courier',
            'ReferenceNo','DateCreated','CancelledFlag','AccountNo','AccountName',
            'FirstName','LastName','Address1','Address2','City','Province','PostalCodeOnly',
            'Landmark','ContactNo','Courier','Remarks','ClientNotes','Status','PrintedFlag',
            'RelayedFlag','LastCallFlag','CancelRelayedFlag','CancelNotedFlag',
            'RemarksRelayedFlag', 'RemarksNotedFlag',
            'DatePrintedString','DateRelayedString', 'DateLastCallString',
            'DateCancelRelayedString','DateCancelNotedString', 'DateRemarksRelayedString',
            'DateRemarksNotedString', 'DateCancelledString', 'DateLastRemarksChangedString',
            'DatePrintedNullFlag'],
        colModel:[
            {name:'BookingNo', index:'BookingNo', width:80, hidden:true},
            {name:'BookingString', index:'ReferenceNo', width:70, sortable:true,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Account', index:'AccountString', width:250, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'RemarksString', index:'RemarksString', width:100, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Courier', index:'Courier', width:50, sortable:true,
                editable: true, edittype:'select', editoptions:{value: courierList},
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'ReferenceNo', index:'ReferenceNo', hidden:true},
            {name:'DateCreated', index:'DateCreated', hidden:true},
            {name:'CancelledFlag', index:'CancelledFlag', hidden:true},
            {name:'AccountNo', index:'AccountNo', hidden:true},
            {name:'AccountName', index:'AccountName', hidden:true},
            {name:'FirstName', index:'FirstName', hidden:true},
            {name:'LastName', index:'LastName', hidden:true},
            {name:'Address1', index:'Address1', hidden:true},
            {name:'Address2', index:'Address2', hidden:true},
            {name:'City', index:'City', hidden:true},
            {name:'Province', index:'Province', hidden:true},
            {name:'PostalCodeOnly', index:'PostalCodeOnly', hidden:true},
            {name:'Landmark', index:'Landmark', hidden:true},
            {name:'ContactNo', index:'ContactNo', hidden:true},
            {name:'Courier', index:'Courier', hidden:true},
            {name:'Remarks', index:'Remarks', hidden:true},
            {name:'ClientNotes', index:'ClientNotes', hidden:true},
            {name:'Status', index:'Status',width:100,sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'PrintedFlag', index:'PrintedFlag',width:100, hidden:true},
            {name:'RelayedFlag', index:'RelayedFlag',width:100, hidden:true},
            {name:'LastCallFlag', index:'LastCallFlag',width:100, hidden:true},
            {name:'CancelRelayedFlag', index:'CancelRelayedFlag',width:100, hidden:true},
            {name:'CancelNotedFlag', index:'CancelNotedFlag',width:100, hidden:true},
            {name:'RemarksRelayedFlag', index:'RemarksRelayedFlag',width:100, hidden:true},
            {name:'RemarksNotedFlag', index:'RemarksNotedFlag',width:100, hidden:true},
            {name:'DatePrintedString', index:'DatePrintedString',width:100, hidden:true},
            {name:'DateRelayedString', index:'DateRelayedString',width:100, hidden:true},
            {name:'DateLastCallString', index:'DateLastCallString',width:100, hidden:true},
            {name:'DateCancelRelayedString', index:'DateCancelRelayedString',width:100, hidden:true},
            {name:'DateCancelNotedString', index:'DateCancelNotedString',width:100, hidden:true},
            {name:'DateRemarksRelayedString', index:'DateRemarksRelayedString',width:100, hidden:true},
            {name:'DateRemarksNotedString', index:'DateRemarksNotedString',width:100, hidden:true},
            {name:'DateCancelledString', index:'DateCancelledString',width:100, hidden:true},
            {name:'DateLastRemarksChangedString', index:'DateLastRemarksChangedString',width:100, hidden:true},
            {name:'DatePrintedNullFlag', index:'DatePrintedNullFlag',width:100, hidden:true}
        ],
        multiselect: true,
        multiboxonly: true,
        height:500,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'ReferenceNo',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            $(this).setCaption(title + ' (' + count + ')');
            
            // reload dependent grids
            if ($(this).data('Dependency') != null)
            {
                var i;
                var dependency = $(this).data('Dependency');
                for (i = 0; i < dependency.length; i++)
                {
                    $(dependency[i]).trigger("reloadGrid");
                }
            }
        },
        ondblClickRow:function(rowid, iRow, iCol, e){
            var gridRow = $(this).jqGrid('getRowData',rowid);
            document.getElementById("spanReferenceNo").innerHTML = gridRow.ReferenceNo;
            document.getElementById("spanDateCreated").innerHTML = gridRow.DateCreated;
            document.getElementById("spanCancelledFlag").innerHTML = (gridRow.CancelledFlag ? "Cancelled" : "Active");
            document.getElementById("spanAccount").innerHTML = gridRow.AccountName + " (" + gridRow.AccountNo + ")";
            document.getElementById("spanFirstName").innerHTML = gridRow.FirstName;
            document.getElementById("spanLastName").innerHTML = gridRow.LastName;
            document.getElementById("spanAddress1").innerHTML = gridRow.Address1;
            document.getElementById("spanAddress2").innerHTML = gridRow.Address2;
            document.getElementById("spanCity").innerHTML = gridRow.City;
            document.getElementById("spanPostalCode").innerHTML = gridRow.PostalCodeOnly;
            document.getElementById("spanLandmark").innerHTML = gridRow.Landmark;
            document.getElementById("spanContactNo").innerHTML = gridRow.ContactNo;
            document.getElementById("spanCourier").innerHTML = gridRow.Courier;
            document.getElementById("spanRemarks").innerHTML = gridRow.Remarks;
            document.getElementById("spanClientNotes").innerHTML = gridRow.ClientNotes;
            document.getElementById("textCopyPaste").innerHTML = "[" + gridRow.ReferenceNo + "] " + gridRow.FirstName + " " +
                gridRow.LastName + " (" + gridRow.AccountNo + ") " + gridRow.Address1 + " " + (gridRow.Address2 == "" ? "" : gridRow.Address2 + " ") +
                gridRow.City + (gridRow.Landmark == "" ? "" : " (" + gridRow.Landmark + ")") +
                (gridRow.ContactNo == "" ? "" : " " + gridRow.ContactNo) + (gridRow.ClientNotes == "" ? "" : " (" + gridRow.ClientNotes + ")");
            document.getElementById("spanPrinted").innerHTML = (gridRow.DatePrintedNullFlag == "True" ? "For Printing" : (gridRow.PrintedFlag == "True" ? "Yes (" + gridRow.DatePrintedString + ")" : "No"));
            document.getElementById("spanRelayed").innerHTML = (gridRow.RelayedFlag == "True" ? "Yes (" + gridRow.DateRelayedString + ")" : "No");
            document.getElementById("spanLastCall").innerHTML = (gridRow.LastCallFlag == "True" ? "Yes (" + gridRow.DateLastCallString + ")" : "No");
            document.getElementById("spanCancelRelayed").innerHTML = (gridRow.CancelRelayedFlag == "True" ? "Yes (" + gridRow.DateCancelRelayedString + ")" : "No");
            document.getElementById("spanCancelNoted").innerHTML = (gridRow.CancelNotedFlag == "True" ? "Yes (" + gridRow.DateCancelNotedString + ")" : "No");
            document.getElementById("spanRemarksRelayed").innerHTML = (gridRow.RemarksRelayedFlag == "True" ? "Yes (" + gridRow.DateRemarksRelayedString + ")" : "No");
            document.getElementById("spanRemarksNoted").innerHTML = (gridRow.RemarksNotedFlag == "True" ? "Yes (" + gridRow.DateRemarksNotedString + ")" : "No");
            $("#divBookingDetails").dialog("open");
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});
}

function initCancelledGrid(title, gridElement, pagerElement, dataUrl, courierList)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['BookingNo','Ref','Account','Remarks','Courier',
            'ReferenceNo','DateCreated','CancelledFlag','AccountNo','AccountName',
            'FirstName','LastName','Address1','Address2','City','Province','PostalCodeOnly',
            'Landmark','ContactNo','Courier','Remarks','ClientNotes','Status','PrintedFlag',
            'RelayedFlag','LastCallFlag','CancelRelayedFlag','CancelNotedFlag',
            'RemarksRelayedFlag', 'RemarksNotedFlag',
            'DatePrintedString','DateRelayedString', 'DateLastCallString',
            'DateCancelRelayedString','DateCancelNotedString','DateRemarksRelayedString',
            'DateRemarksNotedString', 'DateCancelledString', 'DateLastRemarksChangedString',
            'DatePrintedNullFlag'],
        colModel:[
            {name:'BookingNo', index:'BookingNo', width:80, hidden:true},
            {name:'CancelledBookingString', index:'ReferenceNo', width:70, sortable:true,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Account', index:'AccountString', width:250, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'RemarksString', index:'RemarksString', width:100, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Courier', index:'Courier', width:50, sortable:true,
                editable: true, edittype:'select', editoptions:{value: courierList},
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'ReferenceNo', index:'ReferenceNo', hidden:true},
            {name:'DateCreated', index:'DateCreated', hidden:true},
            {name:'CancelledFlag', index:'CancelledFlag', hidden:true},
            {name:'AccountNo', index:'AccountNo', hidden:true},
            {name:'AccountName', index:'AccountName', hidden:true},
            {name:'FirstName', index:'FirstName', hidden:true},
            {name:'LastName', index:'LastName', hidden:true},
            {name:'Address1', index:'Address1', hidden:true},
            {name:'Address2', index:'Address2', hidden:true},
            {name:'City', index:'City', hidden:true},
            {name:'Province', index:'Province', hidden:true},
            {name:'PostalCodeOnly', index:'PostalCodeOnly', hidden:true},
            {name:'Landmark', index:'Landmark', hidden:true},
            {name:'ContactNo', index:'ContactNo', hidden:true},
            {name:'Courier', index:'Courier', hidden:true},
            {name:'Remarks', index:'Remarks', hidden:true},
            {name:'ClientNotes', index:'ClientNotes', hidden:true},
            {name:'Status', index:'Status',width:100,sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'PrintedFlag', index:'PrintedFlag',width:100, hidden:true},
            {name:'RelayedFlag', index:'RelayedFlag',width:100, hidden:true},
            {name:'LastCallFlag', index:'LastCallFlag',width:100, hidden:true},
            {name:'CancelRelayedFlag', index:'CancelRelayedFlag',width:100, hidden:true},
            {name:'CancelNotedFlag', index:'CancelNotedFlag',width:100, hidden:true},
            {name:'RemarksRelayedFlag', index:'RemarksRelayedFlag',width:100, hidden:true},
            {name:'RemarksNotedFlag', index:'RemarksNotedFlag',width:100, hidden:true},
            {name:'DatePrintedString', index:'DatePrintedString',width:100, hidden:true},
            {name:'DateRelayedString', index:'DateRelayedString',width:100, hidden:true},
            {name:'DateLastCallString', index:'DateLastCallString',width:100, hidden:true},
            {name:'DateCancelRelayedString', index:'DateCancelRelayedString',width:100, hidden:true},
            {name:'DateCancelNotedString', index:'DateCancelNotedString',width:100, hidden:true},
            {name:'DateRemarksRelayedString', index:'DateRemarksRelayedString',width:100, hidden:true},
            {name:'DateRemarksNotedString', index:'DateRemarksNotedString',width:100, hidden:true},
            {name:'DateCancelledString', index:'DateCancelledString',width:100, hidden:true},
            {name:'DateLastRemarksChangedString', index:'DateLastRemarksChangedString',width:100, hidden:true},
            {name:'DatePrintedNullFlag', index:'DatePrintedNullFlag',width:100, hidden:true}
        ],
        multiselect: true,
        multiboxonly: true,
        height:500,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'ReferenceNo',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            $(this).setCaption(title + ' (' + count + ')');
            
            // reload dependent grids
            if ($(this).data('Dependency') != null)
            {
                var i;
                var dependency = $(this).data('Dependency');
                for (i = 0; i < dependency.length; i++)
                {
                    $(dependency[i]).trigger("reloadGrid");
                }
            }
        },
        ondblClickRow:function(rowid, iRow, iCol, e){
            var gridRow = $(this).jqGrid('getRowData',rowid);
            document.getElementById("spanReferenceNo").innerHTML = gridRow.ReferenceNo;
            document.getElementById("spanDateCreated").innerHTML = gridRow.DateCreated;
            document.getElementById("spanCancelledFlag").innerHTML = (gridRow.CancelledFlag ? "Cancelled" : "Active");
            document.getElementById("spanAccount").innerHTML = gridRow.AccountName + " (" + gridRow.AccountNo + ")";
            document.getElementById("spanFirstName").innerHTML = gridRow.FirstName;
            document.getElementById("spanLastName").innerHTML = gridRow.LastName;
            document.getElementById("spanAddress1").innerHTML = gridRow.Address1;
            document.getElementById("spanAddress2").innerHTML = gridRow.Address2;
            document.getElementById("spanCity").innerHTML = gridRow.City;
            document.getElementById("spanPostalCode").innerHTML = gridRow.PostalCodeOnly;
            document.getElementById("spanLandmark").innerHTML = gridRow.Landmark;
            document.getElementById("spanContactNo").innerHTML = gridRow.ContactNo;
            document.getElementById("spanCourier").innerHTML = gridRow.Courier;
            document.getElementById("spanRemarks").innerHTML = gridRow.Remarks;
            document.getElementById("spanClientNotes").innerHTML = gridRow.ClientNotes;
            document.getElementById("textCopyPaste").innerHTML = "[" + gridRow.ReferenceNo + "] " + gridRow.FirstName + " " +
                gridRow.LastName + " (" + gridRow.AccountNo + ") " + gridRow.Address1 + " " + (gridRow.Address2 == "" ? "" : gridRow.Address2 + " ") +
                gridRow.City + (gridRow.Landmark == "" ? "" : " (" + gridRow.Landmark + ")") +
                (gridRow.ContactNo == "" ? "" : " " + gridRow.ContactNo) + (gridRow.ClientNotes == "" ? "" : " (" + gridRow.ClientNotes + ")");
            document.getElementById("spanPrinted").innerHTML = (gridRow.DatePrintedNullFlag == "True" ? "For Printing" : (gridRow.PrintedFlag == "True" ? "Yes (" + gridRow.DatePrintedString + ")" : "No"));
            document.getElementById("spanRelayed").innerHTML = (gridRow.RelayedFlag == "True" ? "Yes (" + gridRow.DateRelayedString + ")" : "No");
            document.getElementById("spanLastCall").innerHTML = (gridRow.LastCallFlag == "True" ? "Yes (" + gridRow.DateLastCallString + ")" : "No");
            document.getElementById("spanCancelRelayed").innerHTML = (gridRow.CancelRelayedFlag == "True" ? "Yes (" + gridRow.DateCancelRelayedString + ")" : "No");
            document.getElementById("spanCancelNoted").innerHTML = (gridRow.CancelNotedFlag == "True" ? "Yes (" + gridRow.DateCancelNotedString + ")" : "No");
            document.getElementById("spanRemarksRelayed").innerHTML = (gridRow.RemarksRelayedFlag == "True" ? "Yes (" + gridRow.DateRemarksRelayedString + ")" : "No");
            document.getElementById("spanRemarksNoted").innerHTML = (gridRow.RemarksNotedFlag == "True" ? "Yes (" + gridRow.DateRemarksNotedString + ")" : "No");
            $("#divBookingDetails").dialog("open");
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});
}

function initRemarksChangedGrid(title, gridElement, pagerElement, dataUrl, courierList)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['BookingNo','Ref','Account','Remarks','Courier',
            'ReferenceNo','DateCreated','CancelledFlag','AccountNo','AccountName',
            'FirstName','LastName','Address1','Address2','City','Province','PostalCodeOnly',
            'Landmark','ContactNo','Courier','Remarks','ClientNotes','Status','PrintedFlag',
            'RelayedFlag','LastCallFlag','CancelRelayedFlag','CancelNotedFlag',
            'RemarksRelayedFlag', 'RemarksNotedFlag',
            'DatePrintedString','DateRelayedString', 'DateLastCallString',
            'DateCancelRelayedString','DateCancelNotedString','DateRemarksRelayedString',
            'DateRemarksNotedString', 'DateCancelledString', 'DateLastRemarksChangedString',
            'DatePrintedNullFlag'],
        colModel:[
            {name:'BookingNo', index:'BookingNo', width:80, hidden:true},
            {name:'RemarksChangedBookingString', index:'ReferenceNo', width:70, sortable:true,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Account', index:'AccountString', width:250, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'RemarksString', index:'RemarksString', width:100, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Courier', index:'Courier', width:50, sortable:true,
                editable: true, edittype:'select', editoptions:{value: courierList},
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'ReferenceNo', index:'ReferenceNo', hidden:true},
            {name:'DateCreated', index:'DateCreated', hidden:true},
            {name:'CancelledFlag', index:'CancelledFlag', hidden:true},
            {name:'AccountNo', index:'AccountNo', hidden:true},
            {name:'AccountName', index:'AccountName', hidden:true},
            {name:'FirstName', index:'FirstName', hidden:true},
            {name:'LastName', index:'LastName', hidden:true},
            {name:'Address1', index:'Address1', hidden:true},
            {name:'Address2', index:'Address2', hidden:true},
            {name:'City', index:'City', hidden:true},
            {name:'Province', index:'Province', hidden:true},
            {name:'PostalCodeOnly', index:'PostalCodeOnly', hidden:true},
            {name:'Landmark', index:'Landmark', hidden:true},
            {name:'ContactNo', index:'ContactNo', hidden:true},
            {name:'Courier', index:'Courier', hidden:true},
            {name:'Remarks', index:'Remarks', hidden:true},
            {name:'ClientNotes', index:'ClientNotes', hidden:true},
            {name:'Status', index:'Status',width:100,sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'PrintedFlag', index:'PrintedFlag',width:100, hidden:true},
            {name:'RelayedFlag', index:'RelayedFlag',width:100, hidden:true},
            {name:'LastCallFlag', index:'LastCallFlag',width:100, hidden:true},
            {name:'CancelRelayedFlag', index:'CancelRelayedFlag',width:100, hidden:true},
            {name:'CancelNotedFlag', index:'CancelNotedFlag',width:100, hidden:true},
            {name:'RemarksRelayedFlag', index:'RemarksRelayedFlag',width:100, hidden:true},
            {name:'RemarksNotedFlag', index:'RemarksNotedFlag',width:100, hidden:true},
            {name:'DatePrintedString', index:'DatePrintedString',width:100, hidden:true},
            {name:'DateRelayedString', index:'DateRelayedString',width:100, hidden:true},
            {name:'DateLastCallString', index:'DateLastCallString',width:100, hidden:true},
            {name:'DateCancelRelayedString', index:'DateCancelRelayedString',width:100, hidden:true},
            {name:'DateCancelNotedString', index:'DateCancelNotedString',width:100, hidden:true},
            {name:'DateRemarksRelayedString', index:'DateRemarksRelayedString',width:100, hidden:true},
            {name:'DateRemarksNotedString', index:'DateRemarksNotedString',width:100, hidden:true},
            {name:'DateCancelledString', index:'DateCancelledString',width:100, hidden:true},
            {name:'DateLastRemarksChangedString', index:'DateLastRemarksChangedString',width:100, hidden:true},
            {name:'DatePrintedNullFlag', index:'DatePrintedNullFlag',width:100, hidden:true}
        ],
        multiselect: true,
        multiboxonly: true,
        height:500,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'ReferenceNo',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            $(this).setCaption(title + ' (' + count + ')');
            
            // reload dependent grids
            if ($(this).data('Dependency') != null)
            {
                var i;
                var dependency = $(this).data('Dependency');
                for (i = 0; i < dependency.length; i++)
                {
                    $(dependency[i]).trigger("reloadGrid");
                }
            }
        },
        ondblClickRow:function(rowid, iRow, iCol, e){
            var gridRow = $(this).jqGrid('getRowData',rowid);
            document.getElementById("spanReferenceNo").innerHTML = gridRow.ReferenceNo;
            document.getElementById("spanDateCreated").innerHTML = gridRow.DateCreated;
            document.getElementById("spanCancelledFlag").innerHTML = (gridRow.CancelledFlag ? "Cancelled" : "Active");
            document.getElementById("spanAccount").innerHTML = gridRow.AccountName + " (" + gridRow.AccountNo + ")";
            document.getElementById("spanFirstName").innerHTML = gridRow.FirstName;
            document.getElementById("spanLastName").innerHTML = gridRow.LastName;
            document.getElementById("spanAddress1").innerHTML = gridRow.Address1;
            document.getElementById("spanAddress2").innerHTML = gridRow.Address2;
            document.getElementById("spanCity").innerHTML = gridRow.City;
            document.getElementById("spanPostalCode").innerHTML = gridRow.PostalCodeOnly;
            document.getElementById("spanLandmark").innerHTML = gridRow.Landmark;
            document.getElementById("spanContactNo").innerHTML = gridRow.ContactNo;
            document.getElementById("spanCourier").innerHTML = gridRow.Courier;
            document.getElementById("spanRemarks").innerHTML = gridRow.Remarks;
            document.getElementById("spanClientNotes").innerHTML = gridRow.ClientNotes;
            document.getElementById("textCopyPaste").innerHTML = "[" + gridRow.ReferenceNo + "] " + gridRow.FirstName + " " +
                gridRow.LastName + " (" + gridRow.AccountNo + ") " + gridRow.Address1 + " " + (gridRow.Address2 == "" ? "" : gridRow.Address2 + " ") +
                gridRow.City + (gridRow.Landmark == "" ? "" : " (" + gridRow.Landmark + ")") +
                (gridRow.ContactNo == "" ? "" : " " + gridRow.ContactNo) + (gridRow.ClientNotes == "" ? "" : " (" + gridRow.ClientNotes + ")");
            document.getElementById("spanPrinted").innerHTML = (gridRow.DatePrintedNullFlag == "True" ? "For Printing" : (gridRow.PrintedFlag == "True" ? "Yes (" + gridRow.DatePrintedString + ")" : "No"));
            document.getElementById("spanRelayed").innerHTML = (gridRow.RelayedFlag == "True" ? "Yes (" + gridRow.DateRelayedString + ")" : "No");
            document.getElementById("spanLastCall").innerHTML = (gridRow.LastCallFlag == "True" ? "Yes (" + gridRow.DateLastCallString + ")" : "No");
            document.getElementById("spanCancelRelayed").innerHTML = (gridRow.CancelRelayedFlag == "True" ? "Yes (" + gridRow.DateCancelRelayedString + ")" : "No");
            document.getElementById("spanCancelNoted").innerHTML = (gridRow.CancelNotedFlag == "True" ? "Yes (" + gridRow.DateCancelNotedString + ")" : "No");
            document.getElementById("spanRemarksRelayed").innerHTML = (gridRow.RemarksRelayedFlag == "True" ? "Yes (" + gridRow.DateRemarksRelayedString + ")" : "No");
            document.getElementById("spanRemarksNoted").innerHTML = (gridRow.RemarksNotedFlag == "True" ? "Yes (" + gridRow.DateRemarksNotedString + ")" : "No");
            $("#divBookingDetails").dialog("open");
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});
}

function initDispatchGrid(title, gridElement, pagerElement, dataUrl, courierList)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['BookingNo','Ref','Account','Remarks','Courier',
            'ReferenceNo','DateCreated','CancelledFlag','AccountNo','AccountName',
            'FirstName','LastName','Address1','Address2','City','Province','PostalCodeOnly',
            'Landmark','ContactNo','Courier','Remarks','ClientNotes','Status','PrintedFlag',
            'RelayedFlag','LastCallFlag','CancelRelayedFlag','CancelNotedFlag',
            'RemarksRelayedFlag', 'RemarksNotedFlag',
            'DatePrintedString','DateRelayedString', 'DateLastCallString',
            'DateCancelRelayedString','DateCancelNotedString','DateRemarksRelayedString',
            'DateRemarksNotedString', 'DateCancelledString', 'DateLastRemarksChangedString',
            'DatePrintedNullFlag'],
        colModel:[
            {name:'BookingNo', index:'BookingNo', width:80, hidden:true},
            {name:'BookingString', index:'ReferenceNo', width:70, sortable:true,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Account', index:'AccountString', width:250, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'RemarksString', index:'RemarksString', width:100, sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'Courier', index:'Courier', width:50, sortable:true,
                editable: true, edittype:'select', editoptions:{value: courierList},
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'ReferenceNo', index:'ReferenceNo', hidden:true},
            {name:'DateCreated', index:'DateCreated', hidden:true},
            {name:'CancelledFlag', index:'CancelledFlag', hidden:true},
            {name:'AccountNo', index:'AccountNo', hidden:true},
            {name:'AccountName', index:'AccountName', hidden:true},
            {name:'FirstName', index:'FirstName', hidden:true},
            {name:'LastName', index:'LastName', hidden:true},
            {name:'Address1', index:'Address1', hidden:true},
            {name:'Address2', index:'Address2', hidden:true},
            {name:'City', index:'City', hidden:true},
            {name:'Province', index:'Province', hidden:true},
            {name:'PostalCodeOnly', index:'PostalCodeOnly', hidden:true},
            {name:'Landmark', index:'Landmark', hidden:true},
            {name:'ContactNo', index:'ContactNo', hidden:true},
            {name:'Courier', index:'Courier', hidden:true},
            {name:'Remarks', index:'Remarks', hidden:true},
            {name:'ClientNotes', index:'ClientNotes', hidden:true},
            {name:'Status', index:'Status',width:100,sortable:false,
                searchoptions:{sopt:['eq','cn','nc']}},
            {name:'PrintedFlag', index:'PrintedFlag',width:100, hidden:true},
            {name:'RelayedFlag', index:'RelayedFlag',width:100, hidden:true},
            {name:'LastCallFlag', index:'LastCallFlag',width:100, hidden:true},
            {name:'CancelRelayedFlag', index:'CancelRelayedFlag',width:100, hidden:true},
            {name:'CancelNotedFlag', index:'CancelNotedFlag',width:100, hidden:true},
            {name:'RemarksRelayedFlag', index:'RemarksRelayedFlag',width:100, hidden:true},
            {name:'RemarksNotedFlag', index:'RemarksNotedFlag',width:100, hidden:true},
            {name:'DatePrintedString', index:'DatePrintedString',width:100, hidden:true},
            {name:'DateRelayedString', index:'DateRelayedString',width:100, hidden:true},
            {name:'DateLastCallString', index:'DateLastCallString',width:100, hidden:true},
            {name:'DateCancelRelayedString', index:'DateCancelRelayedString',width:100, hidden:true},
            {name:'DateCancelNotedString', index:'DateCancelNotedString',width:100, hidden:true},
            {name:'DateRemarksRelayedString', index:'DateRemarksRelayedString',width:100, hidden:true},
            {name:'DateRemarksNotedString', index:'DateRemarksNotedString',width:100, hidden:true},
            {name:'DateCancelledString', index:'DateCancelledString',width:100, hidden:true},
            {name:'DateLastRemarksChangedString', index:'DateLastRemarksChangedString',width:100, hidden:true},
            {name:'DatePrintedNullFlag', index:'DatePrintedNullFlag',width:100, hidden:true}
        ],
        multiselect: true,
        multiboxonly: true,
        height:500,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'ReferenceNo',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            $(this).setCaption(title + ' (' + count + ')');
            
            // reload dependent grids
            if ($(this).data('Dependency') != null)
            {
                var i;
                var dependency = $(this).data('Dependency');
                for (i = 0; i < dependency.length; i++)
                {
                    $(dependency[i]).trigger("reloadGrid");
                }
            }
        },
        ondblClickRow:function(rowid, iRow, iCol, e){
            var gridRow = $(this).jqGrid('getRowData',rowid);
            document.getElementById("spanReferenceNo").innerHTML = gridRow.ReferenceNo;
            document.getElementById("spanDateCreated").innerHTML = gridRow.DateCreated;
            document.getElementById("spanCancelledFlag").innerHTML = (gridRow.CancelledFlag ? "Cancelled" : "Active");
            document.getElementById("spanAccount").innerHTML = gridRow.AccountName + " (" + gridRow.AccountNo + ")";
            document.getElementById("spanFirstName").innerHTML = gridRow.FirstName;
            document.getElementById("spanLastName").innerHTML = gridRow.LastName;
            document.getElementById("spanAddress1").innerHTML = gridRow.Address1;
            document.getElementById("spanAddress2").innerHTML = gridRow.Address2;
            document.getElementById("spanCity").innerHTML = gridRow.City;
            document.getElementById("spanPostalCode").innerHTML = gridRow.PostalCodeOnly;
            document.getElementById("spanLandmark").innerHTML = gridRow.Landmark;
            document.getElementById("spanContactNo").innerHTML = gridRow.ContactNo;
            document.getElementById("spanCourier").innerHTML = gridRow.Courier;
            document.getElementById("spanRemarks").innerHTML = gridRow.Remarks;
            document.getElementById("spanClientNotes").innerHTML = gridRow.ClientNotes;
            document.getElementById("textCopyPaste").innerHTML = "[" + gridRow.ReferenceNo + "] " + gridRow.FirstName + " " +
                gridRow.LastName + " (" + gridRow.AccountNo + ") " + gridRow.Address1 + " " + (gridRow.Address2 == "" ? "" : gridRow.Address2 + " ") +
                gridRow.City + (gridRow.Landmark == "" ? "" : " (" + gridRow.Landmark + ")") +
                (gridRow.ContactNo == "" ? "" : " " + gridRow.ContactNo) + (gridRow.ClientNotes == "" ? "" : " (" + gridRow.ClientNotes + ")");
            document.getElementById("spanPrinted").innerHTML = (gridRow.DatePrintedNullFlag == "True" ? "For Printing" : (gridRow.PrintedFlag == "True" ? "Yes (" + gridRow.DatePrintedString + ")" : "No"));
            document.getElementById("spanRelayed").innerHTML = (gridRow.RelayedFlag == "True" ? "Yes (" + gridRow.DateRelayedString + ")" : "No");
            document.getElementById("spanLastCall").innerHTML = (gridRow.LastCallFlag == "True" ? "Yes (" + gridRow.DateLastCallString + ")" : "No");
            document.getElementById("spanCancelRelayed").innerHTML = (gridRow.CancelRelayedFlag == "True" ? "Yes (" + gridRow.DateCancelRelayedString + ")" : "No");
            document.getElementById("spanCancelNoted").innerHTML = (gridRow.CancelNotedFlag == "True" ? "Yes (" + gridRow.DateCancelNotedString + ")" : "No");
            document.getElementById("spanRemarksRelayed").innerHTML = (gridRow.RemarksRelayedFlag == "True" ? "Yes (" + gridRow.DateRemarksRelayedString + ")" : "No");
            document.getElementById("spanRemarksNoted").innerHTML = (gridRow.RemarksNotedFlag == "True" ? "Yes (" + gridRow.DateRemarksNotedString + ")" : "No");
            $("#divBookingDetails").dialog("open");
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false},{},{},{},{multipleSearch:true});
}

function initStatsGrid(title, gridElement, pagerElement, dataUrl)
{
    $(gridElement).jqGrid({
        url:dataUrl,
        datatype:'json',
        colNames:['SeqNo','Courier','Total','Cancelled','Printed','Relayed','LastCall','Action'],
        colModel:[
            {name:'SeqNo',index:'SeqNo',width:80,hidden:true},
            {name:'Courier',index:'Courier', width:120,sortable:true},
            {name:'Total',index:'Total',width:60,sortable:true},
            {name:'Cancelled',index:'Cancelled',width:60,sortable:true},
            {name:'Printed',index:'Printed', width:60,sortable:true},
            {name:'Relayed',index:'Relayed', width:60,sortable:true},
            {name:'LastCall',index:'LastCall',width:60,sortable:true},
            {name:'Action',index:'Action',width:135,sortable:false}
        ],
        multiselect: true,
        multiboxonly: true,
        height:500,
        rowNum:30,
        rowList:[30,60,90],
        pager:pagerElement,
        sortname:'Courier',
        viewrecords:true,
        sortorder:"desc",
        caption:title,
        loadComplete: function(data) {
            var count = $(this).getGridParam("records");
            $(this).setCaption(title + ' (' + count + ')');
            
            // reload dependent grids
            if ($(this).data('Dependency') != null)
            {
                var i;
                var dependency = $(this).data('Dependency');
                for (i = 0; i < dependency.length; i++)
                {
                    $(dependency[i]).trigger("reloadGrid");
                }
            }
            
            var ids = $(this).getDataIDs();
            for (var i = 0; i < ids.length; i++) {
                var rowId = ids[i];
                $(this).jqGrid('setRowData', rowId, {Action:"<a href='#' onclick='addTab(\"" +
                    $(this).getCell(rowId, 'Courier') + "\")'>Manage</a>&nbsp" +
                    "<a href='#' onclick='printPOP(\"" + $(this).getCell(rowId, 'Courier') +
                    "\", \"" + document.getElementById("txtDate").value + "\")'>Print</a>&nbsp" +
                    "<a href='#' onclick='printLastCall(\"" + $(this).getCell(rowId, 'Courier') +
                    "\", \"" + document.getElementById("txtDate").value + "\")'>Last Call</a>"});
            }
        }
    });
    $(gridElement).jqGrid('navGrid',pagerElement,{edit:false,add:false,del:false,search:false},{},{},{},{multipleSearch:true});
}

