<?php

/**
 *
 *
 *
 * @file
 * Default template for HTML Mail
 *
 * DO NOT EDIT THIS FILE. Copy it to your theme directory, and edit the copy.
 *
 * ========================================================= Begin instructions.
 *
 * When formatting an email message with a given $module and $key, [1]HTML
 * Mail will use the first template file it finds from the following list:
 *  1. htmlmail--$module--$key.tpl.php
 *  2. htmlmail--$module.tpl.php
 *  3. htmlmail.tpl.php
 *
 * For each filename, [2]HTML Mail looks first in the chosen Email theme
 * directory, then in its own module directory, before proceeding to the
 * next filename.
 *
 * For example, if example_module sends mail with:
 * drupal_mail("example_module", "outgoing_message" ...)
 *
 *
 * the possible template file names would be:
 *  1. htmlmail--example_module--outgoing_message.tpl.php
 *  2. htmlmail--example_module.tpl.php
 *  3. htmlmail.tpl.php
 *
 * Template files are cached, so remember to clear the cache by visiting
 * admin/config/development/performance after changing any .tpl.php files.
 *
 * The following variables available in this template:
 *
 * $body
 *        The message body text.
 *
 * $module
 *        The first argument to [3]drupal_mail(), which is, by convention,
 *        the machine-readable name of the sending module.
 *
 * $key
 *        The second argument to [4]drupal_mail(), which should give some
 *        indication of why this email is being sent.
 *
 * $message_id
 *        The email message id, which should be equal to
 *        "{$module}_{$key}".
 *
 * $headers
 *        An array of email (name => value) pairs.
 *
 * $from
 *        The configured sender address.
 *
 * $to
 *        The recipient email address.
 *
 * $subject
 *        The message subject line.
 *
 * $body
 *        The formatted message body.
 *
 * $language
 *        The language object for this message.
 *
 * $params
 *        Any module-specific parameters.
 *
 * $template_name
 *        The basename of the active template.
 *
 * $template_path
 *        The relative path to the template directory.
 *
 * $template_url
 *        The absolute URL to the template directory.
 *
 * $theme
 *        The name of the Email theme used to hold template files. If the
 *        [5]Echo module is enabled this theme will also be used to
 *        transform the message body into a fully-themed webpage.
 *
 * $theme_path
 *        The relative path to the selected Email theme directory.
 *
 * $theme_url
 *        The absolute URL to the selected Email theme directory.
 *
 * $debug
 *        TRUE to add some useful debugging info to the bottom of the
 *        message.
 *
 * Other modules may also add or modify theme variables by implementing a
 * MODULENAME_preprocess_htmlmail(&$variables) [6]hook function.
 *
 * References
 *
 * 1. http://drupal.org/project/htmlmail
 * 2. http://drupal.org/project/htmlmail
 * 3. http://api.drupal.org/api/drupal/includes--mail.inc/function/drupal_mail/7
 * 4. http://api.drupal.org/api/drupal/includes--mail.inc/function/drupal_mail/7
 * 5. http://drupal.org/project/echo
 * 6. http://api.drupal.org/api/drupal/modules--system--theme.api.php/function/hook_preprocess_HOOK/7
 *
 * =========================================================== End instructions.
 */
  global $base_url;

  $template_name = basename(__FILE__);
  $current_path = realpath(NULL);
  $current_len = strlen($current_path);
  $template_path = realpath(dirname(__FILE__));
  if (!strncmp($template_path, $current_path, $current_len)) {
    $template_path = substr($template_path, $current_len + 1);
  }
  $template_url = url($template_path, array('absolute' => TRUE));
  
  
  drupal_add_js('https://apis.google.com/js/platform.js');
?>

<div style="margin:0;padding:0;font-family:arial;color:#333;background-color:#fff;text-align:center">
<div><a href="<?php print $base_url;?>"><img src="<?php print $base_url?>/sites/all/themes/survey/logo.png"></a></div>
    <div style="min-width:220px;max-width:440px;margin:0 auto;padding-top:6px;text-align:left;font-family:arial,sans-serif;color:#A07D5B">
        <div style="width:100%;height:1px; background:#E0E0E0;"></div>
        <div><br></div>
        <div>嗨，<?php print $params['name'];?>:</div>
        <div><br></div>
        <div style="margin-bottom:10px"><?php print $params['voter']?>已在你的聚會"<a href="<?php print $params['survey_url']?>"><?php print $params['title']?></a>"投下一票</div>
        <div style="margin-bottom:10px">歡迎前往<a href="<?php print $base_url?>">EZMEET</a>查看詳細內容</div>
        <div><br></div>
        <div style="width:100%;height:1px; background:#E0E0E0;"></div>
        <div style="text-align:center; color:#969696;font-size:13px">
        <div style="margin-bottom:10px"><br></div>
            <div style="margin-bottom:10px">祝您使用愉快 !</div>
            <div style="margin-bottom:10px">EZMEET工作團隊 :-)</div>
            <div style="margin-bottom:10px">完整掌握EZmeet第一手資訊，請追蹤我們的<a href="https://www.facebook.com/pages/Ezmeet/639697109494184">臉書粉絲團</a></div>
        </div>
    </div>
</div>

<?php if ($debug):
  $module_template = "htmlmail--$module.tpl.php";
  $message_template = "htmlmail--$module--$key.tpl.php";
?>
<hr />
<div class="htmlmail-debug">
  <dl><dt><p>
    To customize this message:
  </p></dt><dd><ol><li><p><?php if (empty($theme)): ?>
    Visit <u>admin/config/system/htmlmail</u>
    and select a theme to hold your custom email template files.
  </p></li><li><p><?php elseif (empty($theme_path)): ?>
    Visit <u>admin/appearance</u>
    to enable your selected
    <u><?php echo drupal_ucfirst($theme); ?></u> theme.
  </p></li><li><?php endif;
if ("$template_path/$template_name" == "$theme_path/$message_template"): ?><p>
    Edit your<br />
    <code><?php echo "$template_path/$template_name"; ?></code>
    <br />file.
  </p></li><li><?php
else:
  if (!file_exists("$theme_path/htmlmail.tpl.php")): ?><p>
    Copy<br />
    <code><?php echo "$module_path/htmlmail.tpl.php"; ?></code>
    <br />to<br />
    <code><?php echo "$theme_path/htmlmail.tpl.php"; ?></code>
  </p></li><li><?php
  endif;
  if (!file_exists("$theme_path/$module_template")): ?><p>
    For module-specific customization, copy<br />
    <code><?php echo "$module_path/htmlmail.tpl.php"; ?></code>
    <br />to<br />
    <code><?php echo "$theme_path/$module_template"; ?></code>
  </p></li><li><?php
  endif;
  if (!file_exists("$theme_path/$message_template")): ?><p>
    For message-specific customization, copy<br />
    <code><?php echo "$module_path/htmlmail.tpl.php"; ?></code>
    <br />to<br />
    <code><?php echo "$theme_path/$message_template"; ?></code>
  </p></li><li><?php endif; ?><p>
    Edit the copied file.
  </p></li><li><?php
endif; ?><p>
    Send a test message to make sure your customizations worked.
  </p></li><li><p>
    If you think your customizations would be of use to others,
    please contribute your file as a feature request in the
    <a href="http://drupal.org/node/add/project-issue/htmlmail">issue queue</a>.
  </p></li></ol></dd><?php if (!empty($params)): ?><dt><p>
    The <?php echo $module; ?> module sets the <u><code>$params</code></u>
    variable.  For this message,
  </p></dt><dd><p><code><pre>
$params = <?php echo check_plain(print_r($params, 1)); ?>
  </pre></code></p></dd><?php endif; ?></dl>
</div>
<?php endif;
