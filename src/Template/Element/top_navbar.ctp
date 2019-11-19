<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
				<?php if(empty($authUser)) { ?>
					<i class="fas fa-truck-monster"></i></i><li class="<?= $this->request->getParam('action') == "login" ? "active" : ""; ?>"><?= $this->Html->link('Login',['controller'=>'users','action'=>'login']) ?></li>
					<li class="<?= $this->request->getParam('action') == "add" ? "active" : ""; ?>"> <?= $this->Html->link('Register',['controller'=>'users','action'=>'add']) ?></li>
                <?php } else { ?>
					<li> <?= $this->Html->link('Logout',['controller'=>'users','action'=>'logout']) ?></li>
                <?php } ?>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
</nav>
