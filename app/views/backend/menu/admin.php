<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<ul class="pcoded-item pcoded-left-item no-print" id="menu">
    <li>
        <a href="<?php echo site_url('dashboard') ?>" class="waves-effect waves-dark">
            <span class="pcoded-micon">
                <i class="feather icon-home" aria-hidden="true"></i>
            </span>
            <span class="pcoded-mtext"> Dashboard </span>
        </a>
    </li>
    <li class="pcoded-hasmenu">
        <a href="javascript:void(0)" class="waves-effect waves-dark">
            <span class="pcoded-micon"><i class="fas fa-folder" aria-hidden="true"></i></span>
            <span class="pcoded-mtext">Data Master</span>
        </a>
        <ul class="pcoded-submenu">
            <li>
                <a href="<?php echo site_url('role') ?>" class="waves-effect waves-dark" data-toggle="tooltip" data-placement="right" title="view data roles">
                    <span class="pcoded-mtext">Data Role</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('asset') ?>" class="waves-effect waves-dark" data-toggle="tooltip" data-placement="right" title="view data asssets">
                    <span class="pcoded-mtext">Data Asset</span>
                </a>
            </li>
            <li>
                <a href="<?php echo site_url('employee') ?>" class="waves-effect waves-dark" data-toggle="tooltip" data-placement="right" title="view data employees">
                    <span class="pcoded-mtext">Data Employee</span>
                </a>
            </li>
        </ul>
    </li>
    <li>
        <a href="<?php echo site_url('assignment') ?>" class="waves-effect waves-dark">
            <span class="pcoded-micon">
                <i class="feather icon-file-text" aria-hidden="true"></i>
            </span>
            <span class="pcoded-mtext"> Data Assignment </span>
        </a>
    </li>
    <div class="pcoded-navigation-label">OTHER NAVIGATION</div>
    <li>
        <a href="javascript:void(0)" id="logout" class="waves-effect waves-dark" data-toggle="tooltip" data-placement="right" title="Logout">
            <span class="pcoded-micon">
                <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
            </span>
            <span class="pcoded-mtext">Logout</span>
        </a>
    </li>
</ul>
