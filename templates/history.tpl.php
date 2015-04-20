<?php
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/user-profile.js');
?>

<div class="container history">
  <div class="row">
    <div class="col-xs-6 col-md-6">
      <h1 class="text-center">
         <img src="sites/all/themes/survey/img/meet_list_title.png" alt="聚會記錄">
      </h1>    
      <div class="row">
        <div class="col-xs-2 col-md-2">
          <img src="sites/all/themes/survey/img/join.png" class="img-responsive vcenter" alt="參與的聚會">
                    </div>
        <div class="col-xs-4 col-md-10">
          <table class="table text-center join">
            <thead>
              <tr>
                <th>聚會名稱</th>
                <th>發起人</th>
                <th>地點</th>
                <th>投票結果</th>
              </tr>
            </thead>
            <tbody>
              <?php
                 global $user;
                 global $base_url;
                 $sql = 'SELECT nid FROM {node} n WHERE n.type = :type AND n.status = :status AND n.uid = :uid ORDER BY n.created DESC LIMIT 5';
                 $result = db_query($sql, array(
                                          ':type' => 'edited_survey',
                                          ':status' => 0,
                                          ':uid' => $user->uid,
                                          )
                                   );
                                   
                 foreach ($result as $i => $row) {
                    $private_nid = $row->nid;
                    $private_node = node_load($private_nid);dpm($private_node);
                                  
                    $nid = $private_node->field_nid[LANGUAGE_NONE][0]['value'];
                    $conditions = array();
                    $conditions['source'] = 'node/' . $nid;
                    $path = path_load($conditions);
                    $node = node_load($nid);
                    $field_name = $node->field_name[LANGUAGE_NONE][0]['value'];
                    $field_location = $node->field_location[LANGUAGE_NONE][0]['value'];
                    print '<tr><td><a href="' . $path['alias'] .'">' . $node->title . '</td><td>' . $field_name . '</td><td>' . $field_location . '</td><td></td></tr>';
                 }              
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-6">
      <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- 336x280_1 -->
      <ins class="adsbygoogle"
          style="display: inline-block; width: 336px; height: 280px"
          data-ad-client="ca-pub-4355428491296720"
          data-ad-slot="8880817537"></ins>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6 col-md-6">
      <div class="row">
        <div class="col-xs-2 col-md-2">
          <img src="sites/all/themes/survey/img/launch.png" class="img-responsive vcenter" alt="發起的聚會">
                    </div>
        <div class="col-xs-4 col-md-10">
          <table class="table text-center launch">
            <thead>
              <tr>
                <th>聚會名稱</th>
                <th>發起人</th>
                <th>地點</th>
                <th>投票結果</th>
              </tr>
            </thead>
            <tbody>
              <?php
                 global $user;
                 global $base_url;
                 $sql = 'SELECT nid FROM {node} n WHERE n.type = :type AND n.status = :status AND n.uid = :uid ORDER BY n.created DESC LIMIT 5';
                 $result = db_query($sql, array(
                                          ':type' => 'surveydate',
                                          ':status' => 1,
                                          ':uid' => $user->uid,
                                          )
                                   );
                           
                 foreach ($result as $i => $row) {
                    $conditions = array();
                    $conditions['source'] = 'node/' . $row->nid;
                    $path = path_load($conditions);
                    $node = node_load($row->nid);
                    $field_name = $node->field_name[LANGUAGE_NONE][0]['value'];
                    $field_location = $node->field_location[LANGUAGE_NONE][0]['value'];
                    print '<tr><td><a href="' . $path['alias'] .'">' . $node->title . '</td><td>' . $field_name . '</td><td>' . $field_location . '</td><td></td></tr>';
                 }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="col-xs-6 col-md-6">
      <script async="" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
      <!-- 336x280_1 -->
      <ins class="adsbygoogle"
          style="display: inline-block; width: 336px; height: 280px"
          data-ad-client="ca-pub-4355428491296720"
          data-ad-slot="8880817537"></ins>
      <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
      </script>
    </div>
  </div>
</div>