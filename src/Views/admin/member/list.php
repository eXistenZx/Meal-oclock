<?php $this->layout('admin/layout'); ?>

<h1>Membres</h1>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nom</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($members as $item): ?>
            <tr>
                <th scope="row"><?=$item->getId()?></th>
                <td><?=$item->getIdentity()?></td>
                <td>
                    <?php if ($item->getIsAdmin() == 0): ?>
                        <a href="<?=$router->generate('admin_member_delete', [ 'id' => $item->getId() ])?>">
                            <i class="fas fa-trash"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
