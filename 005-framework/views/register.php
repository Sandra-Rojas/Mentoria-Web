<h1>Register</h1>


<!-- <?= \app\core\widgets\Form::begin('', 'POST') ?>
<?= \app\core\widgets\Form::end() ?> -->

<?php $form = \app\core\widgets\Form::begin('', 'POST') ?>
  <?= $form->field($model, 'firstname') ?>
  <?= $form->field($model, 'lastname') ?>
  <?= $form->field($model, 'email') ?>
  <?= $form->field($model, 'password') ?>
  <?= $form->field($model, 'confirmPassword') ?>
  
  <button type="submit" class="btn btn-primary">Save</button>
<?php \app\core\widgets\Form::end() ?> 

