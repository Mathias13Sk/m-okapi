<head>
    <style type="text/css"></style>
</head>
<h1>Créer votre compte M-OKAPI</h1>
<?php echo form_error('utilisateur/nouvel_utilisateur'); ?>

<form method="post" action="<?php echo site_url('utilisateur/nouvel_utilisateur') ?>">

    <strong>Nom complet:</strong>
    <input name="nomcomplet" value="<?php echo set_value('nomcomplet'); ?>"/>
        <?php echo '<em style="color:red">'.form_error('nomcomplet').'</em>'; ?> <br/>


    <strong>Email:</strong>
    <input name="email" value="<?php echo set_value('email'); ?>"/>
        <?php echo '<em style="color:red">'.form_error('email').'</em>'; ?>
     <br/>

    <strong>Login:</strong>
    <input name="login" value="<?php echo set_value('login'); ?>"/>
        <?php echo '<em style="color:red">'.form_error('login').'</em>'; ?>
     <br/>

    <strong>Mot de passe:</strong>
    <input type="password" name="mdp" value="<?php echo set_value('mdp'); ?>"/>
        <?php echo '<em style="color:red">'.form_error('mdp').'</em>'; ?>
     <br/>

    <strong>Confirmer</strong>
    <input type="password" name="mdpconf" value="<?php echo set_value('mdpconf'); ?>"/>
        <?php echo '<em style="color:red">'.form_error('mdpconf').'</em>'; ?> <br/>

    <input type="submit" value="Créer" />
    <a href="<?php echo site_url('utilisateur/form_authentification') ?>">J'ai déjà un compte</a>
</form>