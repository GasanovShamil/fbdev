<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('backend/createContest'); ?>
	<div class="form-group">
		<label for="name">Nom du concours:</label>
		<input type="text" class="form-control" id="name" name="name">
	</div>
	<div class="form-group">
		<label for="startDate">Date de debut:</label>
		<input type="date" class="form-control" id="startDate" name="startDate">
	</div>
	<div class="form-group">
		<label for="endDate">Date de fin:</label>
		<input type="date" class="form-control" id="endDate" name="endDate">
	</div>
	<div class="form-group">
		<label for="prize">Prize:</label>
		<input type="text" class="form-control" id="prize" name="prize">
	</div>
	<div class="checkbox">
    	<label><input type="checkbox" id="multipleParticipation" name="multipleParticipation" value="1"> Participation multiple</label>
  	</div>
	
	<button type="submit" class="btn btn-default">Create</button>
</form>