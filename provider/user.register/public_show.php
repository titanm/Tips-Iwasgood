<?php require_once('provider/univ.prov/show_error.php'); ?>
<img src="/images/logo.png">
<form name="register" method="post">
<div><?php showError('name'); ?><input type="text" name="name" placeholder="username" value="<?= $_SESSION['previousValues']['name']; ?>" /></div>
<div><?php showError('email'); ?><input type="text" name="email" placeholder="e-mail address" value="<?= $_SESSION['previousValues']['email']; ?>" /></div>
<div><?php showError('password'); ?><input type="password" name="password" placeholder="password" value="<?= $_SESSION['previousValues']['password']; ?>" /></div>
<div><?php showError('password_repeat'); ?><input type="password" name="password_repeat" placeholder="repeat password" value="<?= $_SESSION['previousValues']['password_repeat']; ?>" /></div>
<div id="div-agree-tac"><?php showError('agree-tac'); ?><label><input type="checkbox" value="1" name="agree-tac"<?php if ($_SESSION['previousValues']['agree-tac']=='1') echo ' checked'; ?> /> I agree with the <a href="/terms-and-conditions">terms and conditions</a></label></div>
<div id="div-submit"><input type="submit" value="Register"></div>
<div id="div-already-registered"><a href="/login">I already registered</a></div>
</form>