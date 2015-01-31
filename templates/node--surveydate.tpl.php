<?php
/**
 * @file
 * Default theme implementation to display a node.
 *
 * Available variables:
 * - $title: the (sanitized) title of the node.
 * - $content: An array of node items. Use render($content) to print them all,
 *   or print a subset such as render($content['field_example']). Use
 *   hide($content['field_example']) to temporarily suppress the printing of a
 *   given element.
 * - $user_picture: The node author's picture from user-picture.tpl.php.
 * - $date: Formatted creation date. Preprocess functions can reformat it by
 *   calling format_date() with the desired parameters on the $created variable.
 * - $name: Themed username of node author output from theme_username().
 * - $node_url: Direct URL of the current node.
 * - $display_submitted: Whether submission information should be displayed.
 * - $submitted: Submission information created from $name and $date during
 *   template_preprocess_node().
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - node: The current template type; for example, "theming hook".
 *   - node-[type]: The current node type. For example, if the node is a
 *     "Blog entry" it would result in "node-blog". Note that the machine
 *     name will often be in a short form of the human readable label.
 *   - node-teaser: Nodes in teaser form.
 *   - node-preview: Nodes in preview mode.
 *   The following are controlled through the node publishing options.
 *   - node-promoted: Nodes promoted to the front page.
 *   - node-sticky: Nodes ordered above other non-sticky nodes in teaser
 *     listings.
 *   - node-unpublished: Unpublished nodes visible only to administrators.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Other variables:
 * - $node: Full node object. Contains data that may not be safe.
 * - $type: Node type; for example, story, page, blog, etc.
 * - $comment_count: Number of comments attached to the node.
 * - $uid: User ID of the node author.
 * - $created: Time the node was published formatted in Unix timestamp.
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $zebra: Outputs either "even" or "odd". Useful for zebra striping in
 *   teaser listings.
 * - $id: Position of the node. Increments each time it's output.
 *
 * Node status variables:
 * - $view_mode: View mode; for example, "full", "teaser".
 * - $teaser: Flag for the teaser state (shortcut for $view_mode == 'teaser').
 * - $page: Flag for the full page state.
 * - $promote: Flag for front page promotion state.
 * - $sticky: Flags for sticky post setting.
 * - $status: Flag for published status.
 * - $comment: State of comment settings for the node.
 * - $readmore: Flags true if the teaser content of the node cannot hold the
 *   main body content.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 *
 * Field variables: for each field instance attached to the node a corresponding
 * variable is defined; for example, $node->body becomes $body. When needing to
 * access a field's raw values, developers/themers are strongly encouraged to
 * use these variables. Otherwise they will have to explicitly specify the
 * desired field language; for example, $node->body['en'], thus overriding any
 * language negotiation rule that was previously applied.
 *
 * @see template_preprocess()
 * @see template_preprocess_node()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>

<?php
drupal_add_js('https://maps.google.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/zweatherfeed/jquery.zweatherfeed.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/node-surveydate-view.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/blockUI/jqueryblockUI.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/bootstrap-table.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/bootstrap-table-zh-TW.min.js');
//  drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-table.min.css', array('group' => CSS_THEME, 'type' => 'file'));
?>

<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

  <div class="content"<?php print $content_attributes; ?>>
    <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);
    hide($content['links']);
    //print render($content);
    ?>
  </div>
<div class="panel panel-primary">
	<div class="panel-heading">
            <div class="survey-view-title">
	    	<h1><?php print $title; ?></h1>
            </div>
	</div>
	<div class="panel-body">
	    <p class="text-info"><span class="glyphicon glyphicon-user"></span><?php print $node->field_name[LANGUAGE_NONE][0]['value']; ?></p>
	    <?php if($node->field_location[LANGUAGE_NONE][0]['value']): ?>
	    <p class="text-info"><span class="glyphicon glyphicon-map-marker"></span><?php print $node->field_location[LANGUAGE_NONE][0]['value']; ?></p>
	    <?php endif; ?>
	    <?php if($node->field_description[LANGUAGE_NONE][0]['value']): ?>
	    <p class="text-info"><span class="glyphicon glyphicon-file"></span><?php print $node->field_description[LANGUAGE_NONE][0]['value']; ?></p>
	    <?php endif; ?>
  	    <div id="location" class="hide"><?php print $node->field_location[LANGUAGE_NONE][0]['value']; ?></div>
	    <div class="col-xs-12 survey-view-map" id="surveydate-map"></div>
	</div>
</div>
<div class="panel panel-primary">
<div class="panel-heading">
	<div class="survey-view-date">
	<div class="btn-group pull-right">
  		<button class="btn btn-danger btn-lg" id="update-survey" type="submit" data-thmr="thmr_178">確定</button>
	</div>
	<h2><span class="glyphicon glyphicon-calendar"></span> 選擇參加時間</h2>
	</div>
</div>
      <table class="table table-bordered survey-date">
        <thead>
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        </tfoot>
      </table>
</div>
  <table id="table">
    <thead>
      <tr>
      <!-- <th data-field="uid">人數</th> -->
        <th class="col-sm-3" data-field="name">與會者名字</th>
        <?php
        $key = explode(",", $node->field_date[LANGUAGE_NONE][0]['value']);
        $count = sizeof($key) - 1;
        for ($x = 0; $x <= $count; $x++) {
          print "<th data-field=" . "'$x'" . ">" . $key[$x] . "</th>";
        }
        ?>
      </tr>
    </thead>
  </table>

  <?php
  $nodeWoeid = $node->field_woeid[LANGUAGE_NONE][0]['value'];
  if ($nodeWoeid != 0) {
    print "<div id=\"wheather-description\">";
    print "<h3>聚會地區的天氣預報</h3>";
    print "<div id=\"weather-content\" value=\"" . $nodeWoeid . "\"></div>";
    print "</div>";
  }
  ?>
  <div id="date" class="hide"><?php print $node->field_date[LANGUAGE_NONE][0]['value']; ?></div>
  <div id="survey" class="hide"><?php print $node->field_survey[LANGUAGE_NONE][0]['value']; ?></div>
  <div id="result" class="hide"><?php print $node->field_result[LANGUAGE_NONE][0]['value']; ?></div>
  <div id="uid" class="hide"><?php print $user->uid; ?></div>

  <?php print render($content['links']); ?>

  <?php print render($content['comments']); ?>

</div>
