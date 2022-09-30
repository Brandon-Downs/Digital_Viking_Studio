<?php
/*
Template Name: Contact
*/
?>
<?php

$nameError = '';
$emailError = '';
$commentError = '';

if (isset($_POST['submitted'])) {
    if (trim($_POST['contactName']) === '') {
        $nameError = 'Please enter your name.';
        $hasError = true;
    } else {
        $name = trim($_POST['contactName']);
    }

    if (trim($_POST['email']) === '') {
        $emailError = 'Please enter your email address.';
        $hasError = true;
    } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
        $emailError = 'You entered an invalid email address.';
        $hasError = true;
    } else {
        $email = trim($_POST['email']);
    }

    if (trim($_POST['comments']) === '') {
        $commentError = 'Please enter a message.';
        $hasError = true;
    } else {
        if (function_exists('stripslashes')) {
            $comments = stripslashes(trim($_POST['comments']));
        } else {
            $comments = trim($_POST['comments']);
        }
    }

    if (!isset($hasError)) {
        $emailTo = get_option('admin_email');
        $subject = '[Contact Form] From ' . $name;
        $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
        $headers = 'From: ' . $name . ' <' . $email . '>' . "\r\n" . 'Reply-To: ' . $email;

        mail($emailTo, $subject, $body, $headers);
        $emailSent = true;
    }

} ?>
<?php get_header(); ?>
<div class="title container">
    <div class="row">
        <div class="twelvecol">
            <h1 class='text'><?php the_title(); ?></h1>

            <div class="oline">
                <canvas id="mycanvas"></canvas>
            </div>
        </div>
    </div>
</div>

<div id="main" class="content container bottom clearfix">
    <div class="cont row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <?php if (isset($emailSent) && $emailSent == true) { ?>
            <div class="thanks sevencol">
                <h3><?php _e('Thanks, your email was sent successfully.', 'framework') ?></h3>
            </div>

            <?php } else { ?>
            <div class="form sevencol">

                <?php if (isset($hasError) || isset($captchaError)) { ?>
                            <h5 class="error"><?php _e('Sorry, an error occured.', 'framework') ?><h5>
                        <?php } ?>

                <form action="<?php the_permalink(); ?>" id="contactForm" method="post">
                    <ul class="contactform">
                        <li><input type="text" name="contactName" id="contactName"
                                   value="<?php if (isset($_POST['contactName'])) echo $_POST['contactName'];?>"
                                   class="required requiredField"/>
                            <label for="contactName"><?php _e('Name', 'framework') ?></label>

                        </li>
                        <?php if ($nameError != '') { ?>
                        <span class="error"><?php echo $nameError; ?></span>
                        <?php } ?>
                        <li>
                            <input type="text" name="email" id="email"
                                   value="<?php if (isset($_POST['email'])) echo $_POST['email'];?>"
                                   class="required requiredField email"/>
                            <label for="email"><?php _e('Email', 'framework') ?></label>

                        </li>
                        <?php if ($emailError != '') { ?>
                        <span class="error"><?php echo $emailError; ?></span>
                        <?php } ?>
                        <li class="textarea">
                            <textarea name="comments" id="commentsText" rows="10" cols="10"
                                      class=" required requiredField"><?php if (isset($_POST['comments'])) {
                                if (function_exists('stripslashes')) {
                                    echo stripslashes($_POST['comments']);
                                } else {
                                    echo $_POST['comments'];
                                }
                            } ?></textarea>

                        </li>
                        <?php if ($commentError != '') { ?>
                        <span class="error"><?php echo $commentError; ?></span>
                        <?php } ?>
                        <li class="buttons">
                            <input type="hidden" name="submitted" id="submitted" value="true"/>
                            <button type="submit"
                                    class="submit superlink"><?php _e('Send Email', 'framework') ?></button>
                        </li>
                    </ul>
                </form>

            </div><!-- END FORM-->
            <?php } ?>

        <div class="entry-content fivecol last">
            <?php the_content(); ?>
        </div><!-- END CONTENT-->



        <?php endwhile; else:
        // no content
    endif; ?>


    </div>
</div>

<?php get_footer(); ?>