<?php $this->layout('layout'); ?>
<h1>Liste des membres</h1>
<ul>
    <?php foreach($users as $user): ?>
    <li><?=$user->getIdentity()?></li>
<?php endforeach; ?>
</ul>
