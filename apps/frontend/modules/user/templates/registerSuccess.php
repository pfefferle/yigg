<?php slot("page-title")?>Registrierung<?php end_slot()?>

<?php echo link_to(
   img_tag(
     "404.gif",
    array(
      "alt" => "marvin!",
    )),
   "@user_register",
   array(
     "title" => "Jetzt registrieren und kostenlos von vielen Funktionen und Einstellungen profitieren.",
     "class" => "signup-image"
    )
  );
?>
<?php if( isset($result) && true === $result): ?>
  <p class="alert alert-success">In Kürze erhältst Du von uns eine email mit einem Bestätigungslink. Mit Klick auf diesen
  Link aktivierst Du Dein Konto und Du kannst in unserer Community loslegen.</p>
<?php elseif(isset($result) && false === $result): ?>
  <p class="alert alert-danger error">Wir konnten Dir keinen Bestätigungslink schicken. Bitte überprüfe und korrigiere Deine email-Adresse <?php echo $user->email; ?>
   Dein Konto kann nur nach Anmeldung mit einer bestätigten email-Adresse freigeschaltet werden</p>
<?php else: ?>
  <form id="RegisterForm" class="ninjaForm" action="<?php echo url_for("@user_register"); ?>" method="post">
    <fieldset>
      <h2>Neuen Account anlegen:</h2>
      <?php echo $form->render();?>
   </fieldset>
    <div class="actions">
      <input type="submit" name="commit" value="Abschicken" class="button" />
    </div>
  </form>
<?php endif; ?>


<script>
    jQuery("#AcceptTerms").closest('div').addClass('accept-terms');
    
    jQuery("#RegisterForm > fieldset > .field:nth-child(5)").addClass("captcha-container");
</script>

<?php slot('sidebar') ?>
  <?php include_component("comment","latestComments");?>
  <?php include_component("story","latestStoriesWidget"); ?>
<?php end_slot();?>