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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/jquery.treeview.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" media="screen, projection" />
        
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.cookie.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.treeview.pack.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/demo.js"></script>
        
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>


    <body>
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
                                            <a href="<?php echo Yii::app()->controller->createUrl('/user/login',array()); ?>">
                                                LOG-IN
                                            </a>
                                        <?php } else { ?>
                                            <a href="<?php echo Yii::app()->controller->createUrl('/user/logout',array()); ?>">
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
        <div id="main_div">
            <div id="left_div">
                <div id="left_content">
                    MENU TREE
                    <?php $this->widget('CTreeView',
                        array(
                            'cssFile'=>Yii::app()->theme->baseUrl . '/css/jquery.treeview.css',
                            'animated'=>'normal',
                            'collapsed'=>true,
                            'htmlOptions'=>array('class'=>'filetree')));
                    ?>
                    <ul id="browser" class="filetree">
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu1.png" style="position: relative;margin:0 0 -5px 0;"><a href="<?php echo Yii::app()->controller->createUrl('site/index',array()); ?>">HOME</a>
                        </li>
                        <li class="closed"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu2.png" style="position: relative;margin:0 0 -5px 5px;"> PATIENT
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/patient/create',array()); ?>">Add Patient</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/patient/admin',array()); ?>">Patient List</a></li>
                                <li>PDS
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/pds/create',array()); ?>">Add PDS</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/pds/admin',array()); ?>">PDS List</a></li>
                                    </ul>
                                </li>
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
                                    <ul>Transactions
                                        <!-- Old
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoBillingItem/create',array()); ?>">HMO Bill Item Entry</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoBillingItem/admin',array()); ?>">HMO Bill Items</a></li>
                                        -->
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoForm/create',array()); ?>">HMO Transaction Entry</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoForm/admin',array()); ?>">HMO Transactions</a></li>
                                    </ul>
                                </li>
                                <li>                                
                                    <ul>Weekly Billing
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/HmoWeekBill/generate',array()); ?>">Generate Weekly Billing</a></li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/hmobilling/admin',array()); ?>">Weekly Billings</a>
                                        </li>
                                        <ul>Custom Billing Reports
                                            <li><a href="<?php echo Yii::app()->controller->createUrl('/Hmi/',array()); ?>">HMI Billings</a></li>
                                            <li><a href="<?php echo Yii::app()->controller->createUrl('/ValuCare/',array()); ?>">ValuCare Billings</a></li>
                                            <li><a href="<?php echo Yii::app()->controller->createUrl('/MaxiCare/',array()); ?>">MaxiCare Billings</a></li>
                                        </ul>                                        
                                    </ul>
                                </li>
                                
                            </ul>
                        </li>
                        <li>
                            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/menu6.png" style="position: relative;margin:0 0 -5px 5px;"> HMO Collection
                            <ul>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarchecks/admin',array()); ?>">Received Checks</a></li>
                                <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarbanks/admin',array()); ?>">Banks</a></li>
                                <ul>Reports
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/arsum',array()); ?>">Receivables Summary</a></li>
                                    <!--li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/colmonthsum',array()); ?>">Collection Monthly Summary</a></li-->
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport',array()); ?>">HMO Billing & Collection </a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport/task/wpparams',array()); ?>">WP Billing & Collection </a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport/task/docparams',array()); ?>">Doctor Billing & Collection </a></li>
                                    <li><a href="<?php echo Yii::app()->controller->createUrl('/hmoarreports/reports/bcreport/task/searchparam',array()); ?>">Search Patient Trnx</a></li>
                                    
                                </ul>
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
                                    <ul>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/permissions',array()); ?>">Permission</a>
                                            <ul>
                                                <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/tasks',array()); ?>">Task</a></li>
                                                <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/operations',array()); ?>">Operation</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/authItem/roles',array()); ?>">Role</a>
                                            <ul>
                                                <li><a href="<?php echo Yii::app()->controller->createUrl('/rights/assignment/view',array()); ?>">Assignment</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>                    
                </div>                
            </div>
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
