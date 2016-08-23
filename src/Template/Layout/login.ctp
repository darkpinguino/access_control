<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>
      Control de acceso:
      <?= $this->fetch('title') ?>
  </title>

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <?= $this->Html->meta('icon') ?>
  <!-- Bootstrap 3.3.5 -->
  <?= $this->Html->css('bootstrap/bootstrap.min', ['block' => true]) ?>
  <!-- Font Awesome -->
  <?= $this->Html->css('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css', ['block' => true]) ?>
  <!-- Ionicons -->
  <?= $this->Html->css('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', ['block' => true])?>
  <!-- bootstrap datepicker -->
  <?= $this->Html->css('plugins/datepicker/datepicker3', ['block' => true])?>
  <!-- Theme style -->
  <?= $this->Html->css('adminLTE/AdminLTE.min', ['block' => true]) ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <?= $this->Html->css('adminLTE/skins/_all-skins.min', ['block' => true]) ?>

  <!-- jQuery 2.1.4 -->
  <?= $this->Html->script('plugins/jQuery/jQuery-2.1.4.min', ['block' => true]) ?>
  <!-- jQuery UI 1.11.4 -->
  <?= $this->Html->script('plugins/jQueryUI/jquery-ui.min', ['block' => true]) ?>
  <!-- Booststrap 3.3.5 -->
  <?= $this->Html->script('bootstrap/bootstrap.min', ['block' => true]) ?>
  <!-- bootstrap datepicker -->
  <?= $this->Html->script('plugins/datepicker/bootstrap-datepicker', ['block' => true])?>
  <?= $this->Html->script('plugins/locales/bootstrap-datepicker.es', ['block' => true])?>
  <!-- AdminLTE App -->
  <?= $this->Html->script('app.min', ['block' => true]) ?>  

  <?= $this->fetch('meta') ?>
  <?= $this->fetch('css') ?>
  <?= $this->fetch('cssView') ?>
  <?= $this->fetch('script') ?>
  <?= $this->fetch('scriptView') ?>


</head>
<body class="hold-transition login-page">
	<section class="content">
    <div class="row">
    <div class="col-md-12">
    	<?= $this->fetch('content') ?>
    </div>
  	</div>
  </section>	
</body>
</html>