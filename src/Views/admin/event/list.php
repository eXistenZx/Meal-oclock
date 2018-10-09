<?php $this->layout('admin/layout'); ?>

<h1>Evènements</h1>

<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Titre</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($events as $event): ?>
            <tr>
                <th scope="row"><?=$event->getId()?></th>
                <td><?=$event->getTitle()?></td>
                <td>
                    <a href="<?=$router->generate('admin_events_delete', [ 'id' => $event->getId() ])?>">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
