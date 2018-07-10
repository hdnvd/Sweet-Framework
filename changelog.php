<?php
/*Date:2015/02/18
 * New Version:1.000
 * Changes Made:This File Made.SweetFramework Helper Updated To Version 1.101.
 * It Makes ChangeLog File For Each Module
 */


/*
 * Date:2015/02/20
 * New Version:1.001
 * Changes Made:
 * 1-PageActionNotFoundException Added.
 * 2-FormLoader.php Throws PageActionNotFoundException Instead Of \Exception.
 * 3-$FormInfo Is Constructed Again Where We Have $this->Form In Template.php:Its Removed
 * 4-ThemePageNotFound Exception get's Themepage and ThemepageFileURL
 * 5-Seted Themepage and ThemepageFileURL to ThemePageNotFound Exception in Template.php
 */


/*
 * Date:2015/02/25
 * New Version:1.002
 * Changes Made:
 * 1-Sweet2DArray Updated To Don't Throw Error if input is A 0-Length Array or is not Array
 */
 
/*
 * Date:2015/03/02
 * New Version:1.003
 * Changes Made:
 * 1-SetKeywords Added To FormCode
 */
 

/*
 * Date:2015/03/06
 * New Version:1.004
 * Changes Made:
 * 1-Added Get Attribute Definition For Paragraph HTML Element And Lable HTML Element
 */

/*
 * Date:2015/03/11
 * New Version:1.005
 * Changes Made:
 * 1-Changed AppRooter To Make Setting Module,Page,Language,FileFormat And AdditionalPath Optional
 * 2-Removed Some Extra Codes In App Rooter(Not Changed Interface and Class Behavior)
 * 3-CheckBox Rewrited.
 * 3-1-Add New Lines Removed From AddOption.
 * 3-2-Code Makes Div For Each Option.
 * 4-Changed CheckBoxOption.
 * 4-1-Adds lable tag for CheckBoxOption instead of adding a simple text after it 
 */
 
/*
 * Date:2015/03/12
 * New Version:1.006
 * Changes Made:
 * 1-Added Get Attribute Definition For DataTable
 * 2-fixed error when setting LastElementID to ListTable
 * 3-SimpleXLSX.php added to external classes
 */

/*
 * Date:2015/04/17
 * New Version:1.007
 * Changes Made:
 * 1-Added WidgetFieldNotXMLException File And Used It In WidgetCode.php
 * 2-widget.php updated and show's title and widget in container div
 */


/*
 * Date:2015/06/27
 * New Version:1.008
 * Changes Made:
 * 1-Added PHPFile In html Namespace
 */
 

/*
 * Date:2015/06/28
 * New Version:1.009
 * Changes Made:
 * 1-Overrided GetValue Of PasswordBox
 */
 
/*
 * Date:2016/05/13
 * New Version:1.010
 * Changes Made:
 * 1-LoadFiles Is Now In Framework instead of public directory
 *   
 */ 

/*
 * Date:2016/05/19
 * New Version:1.012
 * Changes Made:
 * 1-Added File.SweetZipArchive
 * 2-Added Ifsnop\Mysqldump to classes 
 */

/*
 * Date:2016/05/20
 * New Version:1.013
 * Changes Made:
 * 1-Added Excluded Path,Excluded DirName And Excluded FileName to File.SweetZipArchive
 */

/*
 * Date:2016/05/22
 * New Version:1.014
 * Changes Made:
 * 1-FileUploadBox now returns SelectedFileNames and SelectedTempFilePaths and can be Multiselectable
 */
 

/*
 * Date:2016/06/27
 * New Version:1.015
 * Changes Made:
 * 1-Fixed A Bug in ListTable Code
 */


/*
 * Date:2016/06/30
 * New Version:1.016
 * Changes Made:
 * 1-Added TelegramClient
 */


/*
 * Date:2017/01/08
 * New Version:1.017
 * Changes Made:
 * 1-Removed Old Codes About Service Loading Pattern From Controller And FormCode
 * 2-Added Constructor for FormCode And Controller That Receives ModuleName As Parameter
 * 3-All ModuleClasses(FormCode,FormDesign,Controller,...) now extends a superclass Named ModuleClass
 */

/*
 * Date:2017/02/14
 * New Version:1.018
 * Changes Made:
 * 1-Added message(with setter and getter to FormDesign)
 * 2-Added getSelectedValue to RadioBox
 * 3-Fixed Multiselectable FileUploadBox gc3x   z32
 * 4-Added AddAdditionalAttr to HtmlInput
 */
 
/*
 * Date:2017/05/14
 * New Version:1.019
 * Changes Made:
 * 1-Changed Some Stuff On DB to Support Prefix skip in some clauses
 * 2-Lable now can return htmlspecialchars(content) instead of pure content to avoid xss attacks
 */

/*
 * Date:2017/05/27
 * New Version:1.020
 * Changes Made:
 * 1-Added FileType,FileSize And FileExists Support and Exceptions to Uploader
 * 2-Added MessageType Field To Form Design
 * 3-FileManager Renamed To SweetFile
 */

/*
 * Date:2017/06/19
 * New Version:1.021
 * Changes Made:
 * 1-Major Updates in EntityClass
 * 2-Repaired getSelectedValues method of CheckBox
 * 3-added MotherCombobox to Combobox
 * 4-Added getPageCount and getPageRowsLimit to Controller Class
 * 5-Added getHttpGETparameter to FormCode
 * 6-Added Smaller And Bigger to LogicalOperator
 * 7-Made QueryLogic
 * 8-Added GetFileds to selectQuery
 * 9-Made FieldCondition
 * 10-Added AddFieldCondition to baseLogicalQuery
 * 11-Added DataNotFoundException
 * 12-stuff of changes that i've forgotten to write here
 */


/*
 * Date:2017/07/02
 * New Version:1.022
 * Changes Made:
 * 1-Added html\GRecaptcha
 * 2-Added Net.WebCLient
 * 2-Added GREcaptcha Settings to Config.php
 */


/*
 * Date:2017/08/24
 * New Version:1.023
 * Changes Made:
 * 1-Added Ajax Support to ComboBox
 * 2-Project Uploaded To GitHub
 */
