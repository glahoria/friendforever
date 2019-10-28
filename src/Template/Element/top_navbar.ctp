<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-3 medium-4 columns">
            <li class="name">
                <h1><a href=""><?= $this->fetch('title') ?></a></h1>
            </li>
        </ul>
        <div class="top-bar-section">
            <ul class="right">
                <li>
                    <?php if($first_name) { ?>
                        <?= $this->Html->link('Logout',['controller'=>'users','action'=>'logout']) ?>
                    <?php } ?>
                   
                </li>
                <li><a target="_blank" href="https://api.cakephp.org/3.0/">API</a></li>
            </ul>
        </div>
</nav>