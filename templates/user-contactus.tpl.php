<?php
drupal_add_js(drupal_get_path('theme', 'survey') . '/js/user-contactus.js');
 drupal_add_css(drupal_get_path('theme', 'survey') . '/css/font-awesome.min.css', array('group' => CSS_THEME, 'type' => 'file'));
?>

<?php // Change the labels of the "name" and "mail" textfields.
$form['name']['#title'] = t('Name');
$form['email']['#title'] = t('E-mail');
$form['description']['#title'] = t('Your feedback');
?>
<?php // Render the "name" and "mail" elements individually and add markup. ?>
<!--
<div class="name-and-email">
  <p><?php print t("We'd love hear from you. Expect to hear back from us in 1-2 business days.") ?></p>
  <?php print render($form['name']); ?>

  <?php print render($form['email']); ?>

</div>

--!>

    <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
                <form class="form-horizontal" method="post">
                    <fieldset>
                   
                        <legend class="text-center header">Contact us</legend>

                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                  <?php print render($form['name']); ?>                 
 <!--                               <input id="fname" name="name" type="text" placeholder="First Name" class="form-control"> 
  --!>               
                            </div>
                        </div>
 <!--                       
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-user bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="lname" name="name" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>
--!>					
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-envelope-o bigicon"></i></span>
                            <div class="col-md-8">
         
                            	  <?php print render($form['email']); ?>
 <!--                               <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
  --!>                             
                            </div>
                        </div>
<!--
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-phone-square bigicon"></i></span>
                            <div class="col-md-8">
                                <input id="phone" name="phone" type="text" placeholder="Phone" class="form-control">
                            </div>
                        </div>
--!>
                        <div class="form-group">
                            <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                            <div class="col-md-8">
                            	<?php print render($form['description']); ?>
<!--                                <textarea class="form-control" id="message" name="message" placeholder="Enter your massage for us here. We will get back to you within 2 business days." rows="7"></textarea>
--!>                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                            	    <?php print render($form['submit']); ?>
<!--                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
 --!>                           </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>


<?php // Be sure to render the remaining form items. ?> <?php print drupal_render_children($form); ?>
