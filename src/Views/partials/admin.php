<header>
    <div class="navbar m-0 p-0 fixed-top">
        <!-- Première ligne de menu -->
        <div class="d-flex justify-content-between w-100">
            <div class="box can-hover p-3">
                Administration
            </div>
            <div class="box p-3">
                <a href="<?=$router->generate('home')?>">
                    <img src="<?=$baseUrl?>/public/images/title.svg" alt="mealoclock">
                </a>
            </div>
        </div>

        <!-- Menu de l'admin -->
        <div class="subnav d-flex justify-content-between w-100">
            <div class="box p-3">
                <a href="<?=$router->generate('admin_communities')?>">Communautés</a>
            </div>
            <div class="box p-3">
                <a href="<?=$router->generate('admin_events')?>">Évènements</a>
            </div>
            <div class="box p-3">
                <a href="<?=$router->generate('admin_members')?>">Membres</a>
            </div>
        </div>
    </div>
</header>
