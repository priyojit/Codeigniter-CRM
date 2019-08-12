<option value="">Select a State</option>
<?php foreach($state as $row): ?>
  <option value="<?= $row->Name ?>"><?= $row->Name ?></option>
<?php endforeach; ?>
