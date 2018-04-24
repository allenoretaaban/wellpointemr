<?php
    $url = $_SERVER["HTTP_HOST"].Yii::app()->getHomeUrl();
    define('SITEROOT', "http://".$url);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" media="screen, projection" />
    <!--link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.treeview.css" media="screen, projection" /-->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" media="screen, projection" />
        
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.cookie.js"></script>
        <!--script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.treeview.pack.js"></script-->
        <!--script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/demo.js"></script-->    
        <script>
            function toggleSideMenu(s){
                if (s == 'hide'){
                    $('#left_content').hide('fast'); $('#sidetab').show();           
                }
                if (s == 'show'){
                    $('#left_content').show('fast'); $('#sidetab').hide();
                }
                
            }
        
        </script>
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
    
    <style>         
        /*---- CROSS BROWSER DROPDOWN MENU ----*/
        ul#nav {margin: 0 0 0 0;}
        ul.drop a { display:block; color: #fff; font-family: Verdana; font-size: 13px; text-decoration: none;}
        ul.drop, ul.drop li, ul.drop ul { 
            list-style: none; margin: 0; padding: 0; border: 1px solid #333; 
            background: #555; color: #fff;
        }
        ul.drop { position: relative; z-index: 597; float: left; }
        ul.drop li { float: left; line-height: 1.3em; vertical-align: middle; zoom: 1; padding: 5px 10px; }
        ul.drop li.hover, ul.drop li:hover { position: relative; z-index: 599; cursor: default; background: #1e7c9a; }
        ul.drop ul { visibility: hidden; position: absolute; top: 100%; left: 0; z-index: 598; width: 195px; background: #555; border: 1px solid #333; }
        ul.drop ul li { float: none; }
        ul.drop ul ul { top: -2px; left: 100%; }
        ul.drop li:hover > ul { visibility: visible }
        #sidetab{
            height:25px;width:100px;
            background:#555;
            position:fixed;
            top:150px; right:0px;
            border-right: 1px solid #ccc;    
            border-top: 1px solid #ccc;    
            border-bottom: 1px solid #ccc;  
            padding:10px 5px 5px 10px;  color:#fff;
        }
    </style>
	
	<?php
		/*if(!empty($_SESSION['userid'])){
	?>
		<link type="text/css" href=" /cometchat/cometchatcss.php" rel="stylesheet" charset="utf-8">
		<script type="text/javascript" src=" /cometchat/cometchatjs.php" charset="utf-8"></script>
	<?php
		}*/
	?>
    
</head>
         
    <body>
        <div id='sidetab' style="display:none">
            <a href="javascript:void(0)" onclick="toggleSideMenu('show')" style="color:#fff">Side Menu</a> 
        </div>
    
        <div id="header_div">   
            <div id="header">
                <div id="header_content">
                    <div style="position: absolute;margin:-5px 0 0 0;">
                        <a href="#">
                            <table>
                                <tr>
                                    <td>
                                        <?php if (!Yii::app()->user->isGuest) { ?>
                                            <font color="#ffffff" size="2">
                                                <?php echo 'Welcome '.Yii::app()->user->name;  ?>
                                            </font>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo Yii::app()->getModule('user')->logoutUrl; ?>" style="display:<?php echo ((Yii::app()->user->isGuest)?'none':'block'); ?>">
                                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logout_icon.png">
                                        </a>
                                    </td>
                                    <td>
                                        <font color="#ffffff" size="2">
                                        <?php if (Yii::app()->user->isGuest) { ?>
                                            <a style="color:#ffffff" href="<?php echo Yii::app()->controller->createUrl('/user/login',array()); ?>">
                                                <img width="15" src="<?php echo Yii::app()->theme->baseUrl; ?>/images/cpico.png">LOG-IN
                                            </a>
                                        <?php } else { ?>
                                            <a style="color:#ffffff" href="<?php echo Yii::app()->controller->createUrl('/user/logout',array()); ?>">
                                                LOGOUT
                                            </a>
                                        <?php } ?>
                                        </font>
                                    </td>
                                </tr>
                            </table>
                        </a> 
                    </div>
                    <div style="float:right;">
                        System Date: <font color="#00FF00"><?php echo date("l, F j, Y",time()) ?></font>
                    </div>
                </div>               
            </div>           
        </div>
        
        
        <div style="width:100%;display:table;background:black">
        <!-- new menu -->
            <div id="headermenu" style="color: #FFFFFF;    display: table-cell;   vertical-align: middle;" >
                <ul id="nav" class="drop">
                      <li>     
                            <a href="<?php echo Yii::app()->controller->createUrl('site/index',array()); ?>">
                                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu1.png" style="position: relative;margin:0 0 -5px 0;"> HOME
                            </a>
                        </li>
                        <li class="closed"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu2.png" style="position: relative;margin:0 0 -5px 5px;"> PATIENT
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/patient/create',array()); ?>">Add Patient</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/patient/admin',array()); ?>">Patient List</a></li>
                                <li>PDS
                                    <ul>
                                        <!--li><a href="<?php echo Yii::app()->controller->createUrl('/pds/create',array()); ?>">Add PDS</a></li-->
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/pds/createWithDoctor',array()); ?>">Add PDS</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/pds/admin',array()); ?>">PDS List</a></li>
                                    </ul>
                                </li>
                                <li>APE
                                    <ul>
                                        <!--li><a href="<?php echo Yii::app()->controller->createUrl('/ape/create',array()); ?>">Add PDS</a></li-->
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/ape/createWithDoctor',array()); ?>">Add APE</a></li> 
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/ape/admin',array()); ?>">APE List</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/ape/reports',array()); ?>">APE Reports</a></li> 
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/ape/ApeAgingReport',array()); ?>">APE Aging Report</a></li>     
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/clients/create',array()); ?>">Add Client</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/clients/admin',array()); ?>">Clients List</a></li>
                                    </ul>
                                </li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/pds/census',array()); ?>">Patient Census</a></li>
                            </ul>
                      </li>  
                      <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu3.png" style="position: relative;margin:0 0 -5px 5px;"> 
                            DIAGNOSTIC
                            <ul>
                            
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/AddDiagResult',array()); ?>">Add New Result</a></li>
                                <li>Search
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/ProgrammedResults',array()); ?>">Programmed Results</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/DiagTempsResults/admin',array()); ?>">Templated Results</a></li>
                                    </ul>
                                </li>
                                <li>Templates
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/diagTemps/create',array()); ?>">Add</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/diagTemps/admin',array()); ?>">List</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu4.png" style="position: relative;margin:0 0 -5px 5px;"> CASHIER
                            <ul>
                                <li>Invoicing
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/invoice/create',array()); ?>">Add Invoice</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/invoice/admin',array()); ?>">Invoice List</a></li>
                                    </ul>
                                </li>
                                <li>Cash Voucher
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/cashvoucher/create',array()); ?>">Add Cash Voucher</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/cashvoucher/admin',array()); ?>">Cash Voucher List</a></li>
                                    </ul>
                                </li>
                                <li>Deposit
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/deposit/create',array()); ?>">Add Deposit</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/deposit/admin',array()); ?>">Deposit List</a></li>
                                    </ul>
                                </li>
                                <li>Daily Sheet Form
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/dailysheetform/create',array()); ?>">Add Daily Sheet Form</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/dailysheetform/admin',array()); ?>">Daily Sheet Form List</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu5.png" style="position: relative;margin:0 0 -5px 5px;"> DOCTORS
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/doctor/create',array()); ?>">Add Doctor</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/doctor/admin',array()); ?>">Doctor List</a></li>
                            </ul>
                        </li>      
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu6.png" style="position: relative;margin:0 0 -5px 5px;"> HMO
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmo/create',array()); ?>">Add HMO</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmo/admin',array()); ?>">HMO List</a></li>
                                <li>    
                                    Transactions                                                            
                                    <ul>
                                        <!-- Old
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoBillingItem/create',array()); ?>">HMO Bill Item Entry</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoBillingItem/admin',array()); ?>">HMO Bill Items</a></li>
                                        -->
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoForm/create',array()); ?>">HMO Transaction Entry</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoForm/admin',array()); ?>">HMO Transactions</a></li>
                                    </ul>
                                </li>
                                <li>    
                                    Weekly Billing                            
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/HmoWeekBill/generate',array()); ?>">Generate Weekly Billing</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoBilling/admin',array()); ?>">Weekly Billings</a>
                                        </li>
                                                                               
                                    </ul>
                                </li>
								<li>
									Custom Billing Reports
									<ul>
                                            <!--li><a href="<?php echo Yii::app()->controller->createUrl('/Hmi/',array()); ?>">HMI Billings</a></li-->
                                            <li><a href="<?php echo Yii::app()->controller->createUrl('/ValuCare/',array()); ?>">ValuCare Billings</a></li>
                                            <li><a href="<?php echo Yii::app()->controller->createUrl('/MaxiCare/',array()); ?>">MaxiCare Billings</a></li>
                                    </ul> 
								</li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoProductService/admin',array()); ?>">HMO Price List</a></li>
                                
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu6.png" style="position: relative;margin:0 0 -5px 5px;"> HMO Collection
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarChecks/admin',array()); ?>">Received Checks</a>
                                    <ul>
                                        <!--li><a href="<?php echo Yii::app()->controller->createUrl('/ape/create',array()); ?>">Add PDS</a></li-->
                                        <li><a href="http://wellpointemr/hmoarChecks/create">Add New Received Check</a></li> 
									</ul>
								</li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarBanks/admin',array()); ?>">Banks</a></li>
                                <li>
                                Reports - Check
                                <ul>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/Bcreport/task/hmochecks_params',array()); ?>">WellPoint Checks Report</a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/Bcreport/task/hmoalldocs_params',array()); ?>">WellPoint Checks: All Doctors</a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/Bcreport/task/hmoindchecks_params',array()); ?>">Individual Checks Summary</a></li>
                                    
                                </ul>
                                </li>
                                <li>
                                Reports - Billing
                                <ul>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/arsum',array()); ?>">Receivables Summary</a></li>
                                    <!--li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/colmonthsum',array()); ?>">Collection Monthly Summary</a></li-->
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport',array()); ?>">HMO Billing & Collection </a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport/task/wpparams',array()); ?>">WP Billing & Collection </a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport/task/docparams',array()); ?>">Doctor Billing & Collection </a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport/task/searchparam',array()); ?>">Search Patient Trnx</a></li>
                                    
                                </ul>
                                </li>
                            </ul>
                        </li>    
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu7.png" style="position: relative;margin:0 0 -5px 5px;"> References
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/chronicillness/admin',array()); ?>">Chronic Illness</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/medicalstatus/admin',array()); ?>">Medical Status</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/familyhistory/admin',array()); ?>">Family History</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/pregnancyproblem/admin',array()); ?>">Pregnancy Problem</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/productservice/admin',array()); ?>">Product/Service</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/discount/admin',array()); ?>">Discount</a></li>
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu8.png" style="position: relative;margin:0 0 -5px 5px;"> ADMIN
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/user/admin',array()); ?>">User</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/rights',array()); ?>">Rights</a>
                                  </li>
                               <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/permissions',array()); ?>">-Permission</a>                                           
                                        </li>
										<li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/tasks',array()); ?>">---Task</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/operations',array()); ?>">---Operation</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/roles',array()); ?>">-Role</a>
                                        </li>
										<li><a href="<?php echo Yii::app()->controller->createUrl('/rights/assignment/view',array()); ?>">---Assignment</a></li>
                                        
                                 
                               
                            </ul>
                        </li>
                      
                     
                </ul>
            </div>
        <!-- end new menu -->
        </div>    
            
        
        
        <div id="main_div">
            
            <div id="mid_div">
                <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/wellpoint_logo.png">
                <div id="title">
                    ELECTRONIC MEDICAL RECORDS SYSTEM
                </div>
                <div id="green_ul"></div>
                <?php if(isset($this->breadcrumbs)):?>
                        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                                'links'=>$this->breadcrumbs,
                        )); ?><!-- breadcrumbs -->
                <?php endif?>

                <?php echo $content; ?>
            </div>
            <!--div id="right_div">
                <div id="right_content"><br />
                    Quick Links<br /><br />
                    <a href="<?php echo Yii::app()->controller->createUrl('patient/create',array()); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/right_button1.png" style="margin: 3px 0;"></a><br />
                    <a href="<?php echo Yii::app()->controller->createUrl('patient/admin',array()); ?>"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/right_button2.png" style="margin: 3px 0;"></a><br />
                    <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/right_button3.png" style="margin: 3px 0;"></a><br />
                    <a href="#"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/right_button4.png" style="margin: 3px 0;"></a><br />
                </div>            
            </div-->
        </div>
        <div id="footer_div">
            <div id="footer_content">
                WellPoint EMR System. <font color="#999999">Copyright 2012</font>            
            </div>
        </div>       
    </body>
</html>
