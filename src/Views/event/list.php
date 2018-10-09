<?php $this->layout('layout'); ?>

<h1>Liste des évènements</h1>

<!-- Affiche la liste des évènements -->
<?php foreach($events as $event): ?>

<section class="container-fluid community">
    <div class="row">
        <div class="col-8">
            <h2>
                <a href="<?=$router->generate('event', [ 'id' => $event->getId() ])?>">
                    <?=$event->getTitle()?>
                </a>
            </h2>
            <p><?=$event->getDescription()?></p>
        </div>
        <div class="col-4">
            <span><?=$event->getEventDate('d/m/Y')?></span>
        </div>
    </div>
</section>

<?php endforeach; ?>

<div id="eventListMap"></div>

<script type="text/javascript">

    var eventsAddress = [];
    
    <?php foreach($events as $event): ?>
        eventsAddress.push("<?=$event->getAddress()?>");
    <?php endforeach;?>
</script>
