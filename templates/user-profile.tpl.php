<?php
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/user-profile.js');
?>
<div>
<h2>發過的聚會</h2>
<table>
	<tbody>
		<tr class="tableSpace"></tr>
		<tr class="header">
			<td class="col-md-4"><p>Title</p></td>
			<td class="col-md-4"><p>Create time</p></td>
			<td class="col-md-4"><p>Change time</p></td>
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
	//dvm($node);
	print '<tr class="open">';
	print '<td class="tdTitle col-md-4">';
	print '<a href="'.$base_url.'/'.$path['alias'].'">'.$node->title.'</a>';
	print '</td>';
	print '<td class="tdCreateT col-md-4">';
	print '<p>'.format_date($node->created, 'short').'</p>';
	print '</td>';
	print '<td class="tdChangeT col-md-4">';
	print '<p>'.format_date($node->changed, 'short').'</p>';
	print '</td>';
	print '</tr>';
}
?>
		</tr>
	</tbody>
</table>
</div>
<div>
<h2>填過的聚會</h2>
<table>
	<tbody>
		<tr class="tableSpace"></tr>
		<tr class="header">
			<td class="col-md-4"><p>Title</p></td>
			<td class="col-md-4"><p>Create time</p></td>
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
	print '<tr class="open">';
	print '<td class="tdTitle col-md-4">';
	print '<a href="'.$base_url.'/'.$path['alias'].'">'.$node->title.'</a>';
	print '</td>';
	print '<td class="tdCreateT col-md-4">';
	print '<p>'.format_date($private_node->created, 'short').'</p>';
	print '</td>';
	print '</tr>';
}
?>
		</tr>
	</tbody>
</table>
</div>
