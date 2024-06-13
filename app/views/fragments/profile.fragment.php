<div class="content">
  <div class="container-fluid">
		<div class="row">
			<div class="col-lg-3">
				<div class="card">

					<div class="header">
							<h4 class="title"><?= __("Profile Setting") ?></h4>
					</div>
					
					<div class="content">
						<form action="<?= APPURL."/profile" ?>" id="formsaveprofile"  autocomplete="off" method="POST">
							<input type="hidden" name="action" value="save">
							<div class="form-group">
								<label><?= __("First Name") ?></label>
								<input type="text" class="form-control" name="firstname"  id="firstname" placeholder="<?= __("First Name") ?>" value="<?= $AuthUser->get("firstname") ?>" required>
							</div>

							<div class="form-group">
								<label><?= __("Last Name") ?></label>
								<input type="text" class="form-control" name="lastname"  id="lastname" placeholder="<?= __("Last Name") ?>" value="<?= $AuthUser->get("lastname") ?>" required>
							</div>

							<div class="form-group">
								<label><?= __("Email") ?></label>
								<input type="email" class="form-control" name="email"  id="email" placeholder="<?= __("Email") ?>" value="<?= $AuthUser->get("email") ?>" disabled>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-info btn-fill btn-wd"><i class="ti-check"></i> <?= __("Save Profile") ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="col-lg-3">
				<div class="card">

					<div class="header">
							<h4 class="title"><?= __("Change password") ?></h4>
					</div>
					
					<div class="content">
						<form action="<?= APPURL."/profile" ?>" id="formchangepass"  method="POST">
							<input type="hidden" name="action" value="change">

							<div class="form-group">
								<label><?= __("Current Password") ?></label>
								<input type="password"  class="form-control" name="current-password"  id="current-password" placeholder="<?= __("Current Password") ?>" required>
							</div>

							<div class="form-group">
								<label><?= __("New Password") ?></label>
								<input type="password"  class="form-control" name="password"  id="password" placeholder="<?= __("New Password") ?>" required>
							</div>

							<div class="form-group">
								<label><?= __("Confirm Password") ?></label>
								<input type="password"  class="form-control" name="password-confirm"  id="password-confirm" placeholder="<?= __("Confirm Password ") ?>" required>
								<p class="text-help"><?= __("Note: if you populate this field, password will be changed.") ?></p>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-info btn-fill btn-wd"><i class="ti-check"></i> <?= __("Change Password") ?></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>