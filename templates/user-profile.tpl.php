<?php
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/user-profile.js');
?>
<div class="row">
            <div class="col-xs-6">
<div class="panel panel-primary">
<div class="panel-heading">
		 <h3>發過的聚會</h3>
</div>
                <div class="list-group">
<?php
global $user;
global $base_url;
$sql = 'SELECT nid FROM {node} n WHERE n.type = :type AND n.status = :status AND n.uid = :uid ORDER BY n.created DESC';
$result = db_query($sql,
	array(
		':type' => 'surveydate',
		':status' => 1,
		':uid' => $user->uid,
	)
);
foreach ($result as $i => $row) {
	//$node = node_load($row->nid);
	//dvm($node);
	$conditions = array();
	$conditions['source'] = 'node/' . $row->nid;
	$path = path_load($conditions);
	$node = node_load($row->nid);
	//
	print '<a href="'.$base_url.'/'.$path['alias'].'" class="list-group-item">';
	print '<h4 class="list-group-item-heading">'.$node->title.'</h4>';
	print '<p class="list-group-item-text"><span class="label label-primary">建立時間:'.format_date($node->created, 'short').'</span> <span class="label label-danger">修改時間:'.format_date($node->changed, 'short').'</span></p>';
	print '</a>';
	//
}
?>
                </div>
	    </div>
</div>
            <div class="col-xs-6">
<div class="panel panel-primary">
<div class="panel-heading">
		 <h3>填過的聚會</h3>
</div>
                <div class="list-group">
<?php
global $user;
global $base_url;
$sql = 'SELECT nid FROM {node} n WHERE n.type = :type AND n.status = :status AND n.uid = :uid ORDER BY n.created DESC';
$result = db_query($sql,
	array(
		':type' => 'edited_survey',
		':status' => 0,
		':uid' => $user->uid,
	)
);
foreach ($result as $i => $row) {
	//dvm($row);
	$private_nid = $row->nid;
	$private_node = node_load($private_nid);
	//dvm($private_node->field_nid[LANGUAGE_NONE][0]['value']);
	$nid = $private_node->field_nid[LANGUAGE_NONE][0]['value'];
	$conditions = array();
	$conditions['source'] = 'node/' . $nid;
	$path = path_load($conditions);
	$node = node_load($nid);
	//
	print '<a href="'.$base_url.'/'.$path['alias'].'" class="list-group-item">';
	print '<h4 class="list-group-item-heading">'.$node->title.'</h4>';
	print '<p class="list-group-item-text"><span class="label label-danger">修改時間:'.format_date($node->created, 'short').'</span></p>';
	print '</a>';
	//
}
?>
                </div>
            </div>
	</div>
</div>

