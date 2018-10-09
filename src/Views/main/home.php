<?php $this->layout('layout'); ?>

<h1>Nos communautés</h1>

<?php if ( $user ): ?>
<h2>Bienvenue <?=$user->firstname?></h2>
<?php else :?>
<h2>Bienvenue sur MealOclock</h2>
<?php endif; ?>

<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>


<!-- On affiche les communautés -->
<?php foreach ($communities as $community): ?>

    <!--
        Pour chaque communauté, on appel le template "community"
        Dans ce template, on doit disposer des informations de
        la commaunauté, donc on les transmet dans le "insert"
     -->
    <?php $this->insert('main/community', [ 'community' => $community ])?>

<?php endforeach; ?>
