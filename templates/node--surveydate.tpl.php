﻿<?php
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
drupal_add_js('https://maps.googleapis.com/maps/api/js?key=AIzaSyDeEOpZjMXl2yzxcYS-UbHaSO6PdnBblVE&sensor=false&libraries=places', 'external');
drupal_add_js('https://addthisevent.com/libs/1.6.0/ate.min.js','external');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/zweatherfeed/jquery.zweatherfeed.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/node-surveydate-view.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/blockUI/jqueryblockUI.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/bootstrap-table.min.js');
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/bootstrap-table-zh-TW.min.js');
//  drupal_add_css(drupal_get_path('theme', 'survey') . '/css/bootstrap-table.min.css', array('group' => CSS_THEME, 'type' => 'file'));

$field_description = "無";
if ($node->field_description[LANGUAGE_NONE][0]['value']) {
   $field_description = $node->field_description[LANGUAGE_NONE][0]['value'];
}

$field_location = "無";
$field_location_map = "";
if ($node->field_location[LANGUAGE_NONE][0]['value']) {
   $field_location = $node->field_location[LANGUAGE_NONE][0]['value'];
   $field_location_map = '&nbsp;<a href="#" id="showmap" data-toggle="modal" data-target="#Modal-Map">地圖</a>';
}

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
  <div class="container text-left" id="checkmeet">
      <div class="row checkmeet-afterstop">
          <div >
              <h2>主辦人已選定聚會時間:<?php print $node->field_stopdate[LANGUAGE_NONE][0]['value']; ?></h2>
          </div>
          <div title="Add to Calendar" class="addthisevent">
              <span class="start"><?php print $node->field_stopdate[LANGUAGE_NONE][0]['value']; ?></span>
              <span class="timezone">Asia/Taipei</span>
              <span class="title"><?php print $title; ?></span>
              <span class="description"><?php print $field_description; ?></span>
              <span class="location"><?php print $field_location; ?></span>
              <span class="organizer"><?php print $node->field_name[LANGUAGE_NONE][0]['value']; ?></span>
              <span class="date_format">YYYY/MM/DD</span>
              <span class="alarm_reminder">30</span>
              <span class="recurring">FREQ=DAILY;COUNT=10</span>
          </div>
      </div>
      <div class="row checkmeet-meet">
          <div class="col-xs-12 col-md-6">
              <div class="row">
                  <div class="col-xs-2 text-center">
                      <h2><span class="glyphicon glyphicon-bookmark"></span></h2>
                  </div>
                  <div class="col-xs-10">
                      <h2><?php print $title; ?></h2>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-2 text-center">
                      <h4><span class="glyphicon glyphicon-user"></span></h4>
                  </div>
                  <div class="col-xs-10">
                      <h4><?php print $node->field_name[LANGUAGE_NONE][0]['value']; ?></h4>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-2 text-center">
                      <h4><span class="glyphicon glyphicon-map-marker"></span></h4>
                  </div>
                  <div class="col-xs-10">
                      <h4>
                         <?php print $field_location . $field_location_map; ?>
                      </h4>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-2 text-center">
                      <h4><span class="glyphicon glyphicon-file"></span></h4>
                  </div>
                  <div class="col-xs-10">
                      <h4>
                         <?php print $field_description; ?>
                      </h4>
                  </div>
              </div>
              <div class="row">
                  <div class="col-xs-2 text-center">
                      <h4><span class="glyphicon glyphicon-stats"></span></h4>
                  </div>
                  <div class="col-xs-10">
                      <!-- use votedatekey 99 to mean all voter -->
                      <h4><span>已投票&nbsp;</span><a href="#" class="voted showvoter" data-toggle="modal" data-target="#Modal-Voter" data-votedatekey=99></a><span>&nbsp;人</span></h4>
                  </div>
              </div>
          </div>
      </div>      
      <div class="row checkmeet-list">
          <div class="col-xs-12 col-md-6">
              <div class="row">
                  <div class="col-xs-2 text-center">
                      <h2><span class="glyphicon glyphicon-th-list"></span></h2>
                  </div>
                  <div class="col-xs-10">
                      <h2>投票清單</h2>
                  </div>
              </div>
              <div class="col-xs-12">
                  <table class="table">
                      <thead>
                          <tr>
                              <th class="col-xs-1" style="min-width: 30px;"></th><!-- add min-width for small screen checkbox disapear bug -->
                              <th class="col-xs-3">日期</th>
                              <th class="col-xs-3">時間</th>
                              <th class="col-xs-2">人數</th>
                              <th class="col-xs-3"></th>
                          </tr>
                      </thead>
                      <tbody>

                      </tbody>
                  </table>
                  <div id="alert-message" class="alert alert-danger" role="alert">...</div>
              </div>
          </div>
      </div>
      <div class="row checkmeet-stop" <?php if($node->uid != $user->uid) print 'style="display:none"'; ?>>
          <div class="col-md-2 col-xs-3 text-center">
              <select class="form-control" id="edit-stopdate">
                  <option selected disabled value="">選擇聚會時間</option>
              </select>
          </div>
          <button class="btn btn-danger" id="stop-survey" type="submit">XXX</button>
      </div>
  </div>  


  <!-- MAP Modal -->
  <div class="modal fade" id="Modal-Map" tabindex="-1" role="dialog" aria-labelledby="MapModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="MapModalLabel"><?php print $field_location; ?></h4>
           </div>
           <div class="modal-body">
              <div id="surveydate-map"></div>
           </div>
        </div>
     </div>
  </div>


  <!-- Voter Modal -->
  <div class="modal fade" id="Modal-Voter" tabindex="-1" role="dialog" aria-labelledby="VoterModalLabel" aria-hidden="true">
     <div class="modal-dialog">
        <div class="modal-content">
           <div class="modal-header text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="VoterModalLabel">Voter</h4>
           </div>
           <div class="modal-body text-center">

           </div>
        </div>
     </div>
  </div>



<?php
$nodeWoeid = $node->field_woeid[LANGUAGE_NONE][0]['value'];
//if ($nodeWoeid != 0) {
//  print "<div id=\"wheather-description\">";
//  print "<h3>聚會地區的天氣預報</h3>";
//  print "<div id=\"weather-content\" value=\"" . $nodeWoeid . "\"></div>";
//  print "</div>";
//}

//drupal_set_message('Thanks for your time!');
//drupal_get_messages('status');

if ( ! user_is_logged_in() ) {
    print render($content['links']);
}

print render($content['comments']);

?>

  <div class="hidden">  
    <div id="location"><?php print $node->field_location[LANGUAGE_NONE][0]['value']; ?></div>
    <div id="date"><?php print $node->field_date[LANGUAGE_NONE][0]['value']; ?></div>
    <div id="survey"><?php print $node->field_survey[LANGUAGE_NONE][0]['value']; ?></div>
    <div id="result"><?php print $node->field_result[LANGUAGE_NONE][0]['value']; ?></div>
    <div id="latlng"><?php print $node->field_latlng[LANGUAGE_NONE][0]['value']; ?></div>
    <div id="user-uid"><?php print $user->uid; ?></div>
    <div id="user-name"><?php print $user->name; ?></div>
    <div id="stop-date"><?php print $node->field_stopdate[LANGUAGE_NONE][0]['value']; ?></div>
  </div>

</div>
