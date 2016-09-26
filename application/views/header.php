<nav class="top-bar" data-sticky-container>
    <div class="top-bar-title">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text"><a href="<?php echo base_url()?>" class="site-title">Paper Review System</a></li>
        </ul>
    </div>

    <ul class="dropdown menu top-bar-right" data-click-open="false" data-dropdown-menu="m84h8c-dropdown-menu" role="menubar">
        <?php if ( ! $this->session->userdata('username')) { ?>
            <li role="menuitem">
                <a class="button" href="<?php echo base_url('index.php/user/login/show_login')?>">Login</a>
            </li>
            <li class="divider"></li>
        <?php } else { $username = $this->session->userdata('username'); ?>
            <li>
                <a href="#">
                    <?php echo $username?>
                </a>
            </li>
            <li><a class="button" href="<?php echo base_url()?>index.php/user/login/do_logout">Logout</a></li>
        <?php }?>
    </ul>
</nav>
