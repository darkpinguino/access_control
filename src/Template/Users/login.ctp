<div class="login-box">
	<div class="login-logo">
		<p><b>Control de acceso</b></p>
	</div>
	<!-- /.login-logo -->
	<div class="login-box-body">
		<?= $this->Flash->render() ?>
		<?= $this->Flash->render('auth') ?>
		<p class="login-box-msg">Ingrese su nombre de usuario y contraseña</p>

		<?= $this->Form->create() ?>
			<?= $this->Form->input('username', ['label' => 'Nombre de Usuario']) ?>
			<?= $this->Form->input('password', ['label' => 'Contraseña']) ?>

			<div class="row">
				<!-- /.col -->
				<div class="col-xs-4">
					<!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
					<?= $this->Form->button(__('Iniciar sesión')); ?>
					<?= $this->Form->end() ?>
				</div>
				<!-- /.col -->
			</div>
		</form>
	</div>
</div>