<h2><?php echo $title; ?></h2>
<?php echo validation_errors(); ?>

<?php echo form_open('backend/createcontest'); ?>
	<div class="form-group">
		<label for="name">Nom du concours:</label>
		<input type="text" class="form-control" id="name">
	</div>
	<div class="form-group">
		<label for="startDate">Date de debut:</label>
		<input type="date" class="form-control" id="startDate">
	</div>
	<div class="form-group">
		<label for="endDate">Date de fin:</label>
		<input type="date" class="form-control" id="endDate">
	</div>
	<div class="form-group">
		<label for="prize">Prize:</label>
		<input type="text" class="form-control" id="prize">
	</div>
	
	<button type="submit" class="btn btn-default">Create</button>
</form>