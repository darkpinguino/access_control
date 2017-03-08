<!DOCTYPE html>
<html>
<head>
  <?= $this->Html->charset() ?>
  
  <!-- Bootstrap 3.3.5 -->
  <?= $this->Html->css('bootstrap/bootstrap.min', ['block' => true, 'fullBase' => true]) ?>
  <!-- Font Awesome -->
  <?= $this->Html->css('font-awesome/font-awesome.min', ['block' => true, 'fullBase' => true]) ?>  
  <!-- bootstrap datepicker -->
  <?= $this->Html->css('plugins/datepicker/datepicker3', ['block' => true, 'fullBase' => true])?>
  <!-- Theme style -->
  <?= $this->Html->css('adminLTE/AdminLTE.min', ['block' => true, 'fullBase' => true]) ?>
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <?= $this->Html->css('adminLTE/skins/_all-skins.min', ['block' => true,'fullBase' => true]) ?>
  <!-- Colored Modal Headings -->
  <?= $this->Html->css('custom', ['block' => true, 'fullBase' => true]) ?>


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
<body>
	<div class="content-wrapper">
		<section class="content">
	      <div class="row">
	      <div class="col-md-12">
	      	<?= $this->fetch('content') ?>
	      </div>
      	</div>
      </section>	
	</div>
</body>
</html>