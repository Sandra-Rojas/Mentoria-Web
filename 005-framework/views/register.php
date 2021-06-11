<h1>Register</h1>

<?php $form= \app\core\widgets\Form::begin('', 'POST') ?>
<div class="row">
  <div class="col">
    <?= $form->field($model, 'firstname')->textField() ?>
  </div>  
  <div class="col">
    <?= $form->field($model, 'lastname')->textField() ?>
  </div>
</div>
<?= $form->field($model, 'email')->emailField() ?>
<?= $form->field($model, 'password')->passwordField() ?>
<?= $form->field($model, 'confirmPassword')->passwordField() ?>
  
  <button type="submit" class="btn btn-primary">Save</button>
<?php \app\core\widgets\Form::end() ?> 

