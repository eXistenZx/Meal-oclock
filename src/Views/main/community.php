<section class="container-fluid community">
    <div class="row">
        <!-- Image de la communauté -->
        <div class="col-12 col-md-3">
            <img src="<?=$baseUrl?>/public/images/communities/<?=$community->getImage()?>" class="img-fluid" alt="">
        </div>
        <!-- Titre + description -->
        <div class="col-12 col-md-6">
            <!--
                On affiche le nom de la communauté,
                comme cette propriété est en "private",
                on utilise le getter correspondant
            -->
            <h3>
                <!-- <a href="<?=$baseUrl?>/communities/<?=$community->getSlug()?>"><?=$community->getName()?></a> -->

                <a href="<?=$router->generate('communities', [ 'slug' => $community->getSlug() ])?>"><?=$community->getName()?></a>

            </h3>
            <p><?=$community->getDescription()?></p>
        </div>
        <!-- Encart blanc -->
        <div class="area col-12 col-md-3">
            <h3>qzdqzd</h3>
            <ul>
                <li>qzdqzd</li>
                <li>qzdqzd</li>
                <li>qzdqzd</li>
            </ul>
            <p>qzdqzdqzdqzd</p>
            <button type="button" class="btn btn-primary">Voir la recette</button>
        </div>
    </div>
</section>
