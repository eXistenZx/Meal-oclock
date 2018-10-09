<?php $this->layout('admin/layout'); ?>

<h1>Communautés</h1>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($communities as $community): ?>
            <tr>
                <th scope="row"><?=$community->getId()?></th>
                <td><?=$community->getName()?></td>
                <td>
                    <a href="<?=$router->generate('admin_communities_delete', [ 'id' => $community->getId() ])?>">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
