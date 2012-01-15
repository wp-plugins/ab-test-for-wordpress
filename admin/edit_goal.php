<?php
$id = (int)$_GET['id'];
$var = $wpdb->get_row($wpdb->prepare('SELECT * FROM wp_abtest_goals WHERE id=%d', $id));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Save the goal
  $name = stripslashes($_POST['name']);
  
  $wpdb->query($wpdb->prepare('UPDATE wp_abtest_goals SET name=%s WHERE id=%d', $name, $id));
  
  redirect_to('?page=abtest&action=show_experiment&id=' . $var->experiment_id);
} else {
  $name = $var->name;
}
?>

<div class="wrap">
  <h2>Edit goal</h2>
  <form method="post">
    <p>
      <label for="name">Goal name:</label><br />
      <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name) ?>" style="width: 300px;" />
    </p>
    <p>
      <input class="button-primary" type="submit" name="Save" value="Update goal" id="submitbutton" />
      or <a href="?page=abtest&amp;action=show_experiment&amp;id=<?php echo $var->experiment_id ?>">Cancel</a>
    </p>
  </form>
</div>

<script type="text/javascript">
  jQuery('#name').focus();
</script>