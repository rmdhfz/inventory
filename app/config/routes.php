<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route = [
	'404_override' => "",
	// ------------------------------------------------------------------------
	'default_controller'	=>	'Frontend',
	'daftar'				=>	'Frontend/daftar',
	'verify'				=>	'Frontend/login',
	'dashboard'				=>	'Backend',
	'logout'				=>	'Backend/logout',

	'employee'				=>	'Backend/employee',
	'employee/data'			=>	'Backend/employeeData',
	'employee/list'			=>	'Backend/listEmployee',
	'employee/save'			=>	'Backend/saveEmployee',
	'employee/id'			=>	'Backend/findEmployee',
	'employee/edit'			=>	'Backend/editEmployee',
	'employee/delete'		=>	'Backend/deleteEmployee',

	'role'				=>	'Backend/role',
	'role/data'			=>	'Backend/roleData',
	'role/list'			=>	'Backend/listRole',
	'role/save'			=>	'Backend/saveRole',
	'role/id'			=>	'Backend/findRole',
	'role/edit'			=>	'Backend/editRole',
	'role/delete'		=>	'Backend/deleteRole',

	'asset'				=>	'Backend/asset',
	'asset/number'		=>	'Backend/assetNumber',
	'asset/data'		=>	'Backend/assetData',
	'asset/list'		=>	'Backend/listAsset',
	'asset/save'		=>	'Backend/saveAsset',
	'asset/id'			=>	'Backend/findAsset',
	'asset/edit'		=>	'Backend/editAsset',
	'asset/delete'		=>	'Backend/deleteAsset',

	'assignment'			=>	'Backend/assignment',
	'assignment/data'		=>	'Backend/assignmentData',
	'assignment/list'		=>	'Backend/listAssignment',
	'assignment/save'		=>	'Backend/saveAssignment',
	'assignment/id'			=>	'Backend/findAssignment',
	'assignment/edit'		=>	'Backend/editAssignment',
	'assignment/delete'		=>	'Backend/deleteAssignment',
];
