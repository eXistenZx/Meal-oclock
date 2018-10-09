<?php $this->layout('layout'); ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 m-auto">
            <h1>Inscription</h1>

            <?php if (count($errors) > 0): ?>
                <?php foreach($errors as $error): ?>
                    <div class="alert alert-danger"><?=$error?></div>
                <?php endforeach; ?>
            <?php endif; ?>

            <form id="subscription" action="<?=$router->generate('signup')?>" method="post">
                <div class="form-group">
                    <label for="firstname">Ton prénom</label>
                    <input
                    id="firstname"
                    type="text"
                    name="firstname"
                    class="form-control"
                    placeholder="Jon"
                    value="<?=($_POST['firstname'] ?? '') ?>"
                    >
                    <small class="form-text text-muted">On te tutoie, faudra t'y faire...</small>
                </div>
                <div class="form-group">
                    <label for="lastname">Ton nom</label>
                    <input
                    id="lastname"
                    type="text"
                    name="lastname"
                    class="form-control"
                    placeholder="Snow"
                    value="<?=($_POST['lastname'] ?? '') ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="email">Ton email</label>
                    <input
                    id="email"
                    type="email"
                    name="email"
                    class="form-control"
                    placeholder="jon@snow.com"
                    value="<?=($_POST['email'] ?? '') ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="password">Ton mot de passe</label>
                    <input
                    id="password"
                    type="password"
                    name="password"
                    class="form-control"
                    placeholder="surtout pas azerty !"
                    >
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirme ton mot de passe</label>
                    <input
                    id="confirm_password"
                    type="password"
                    name="confirm_password"
                    class="form-control"
                    placeholder="le même qu'au dessus"
                    >
                </div>
                <div class="form-group">
                    <label for="address">Ton adresse</label>
                    <input
                    id="address"
                    type="text"
                    name="address"
                    class="form-control"
                    placeholder="1 rue des degrés, 75001 Paris"
                    value="<?=($_POST['address'] ?? '') ?>"
                    >
                </div>
                <div class="form-group">
                    <label for="description">Un petite description ?</label>
                    <textarea
                    id="description"
                    name="description"
                    class="form-control"
                    placeholder="Grand, brun, vegan, ne sais rien..."
                    >
                        <?=($_POST['description'] ?? '') ?>
                    </textarea>
                </div>
                <input type="submit" class="btn btn-primary" value="Créer le compte">
            </form>
        </div>
    </div>
</div>
