<?php $this->layout('layout'); ?>

<h1><?=$event->getTitle()?></h1>
<p><?=$event->getDescription()?></p>

<div id="eventMap" data-address="<?=$event->getAddress()?>"></div>
