        $firstname = sanitize_text_field($_POST['firstname']);
        $lastname = sanitize_text_field($_POST['lastname']);
        $email = sanitize_email($_POST['email']);
        $admin_email = 'michael.thuleweit@tool-e-byte.eu'; // Replace with the admin's email address

        // Construct email message for the user
        $user_message = 'Sehr geehrte(r) ' . $firstname . ',<br><br>';
        $user_message .= 'Ihre Anmeldung wurde erfolgreich übermittelt.<br><br>';
        $user_headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: TT global learning gGmbH <info@t-und-t-global-learning.de>'
        );

        // Send the email to the user
        $user_sent = wp_mail($email, 'Ihre Anmeldung bei T T Global Learning GmbH war erfolgreich und wir werden uns in Kürze mit Ihnen in Verbindung setzen.', $user_message, $user_headers);

        // Construct email message for the admin
        $admin_message = 'Die T T Global Learning GmbH hat ein neues Anmeldeformular erhalten. ' . $firstname . ' ' . $lastname . '.<br><br>';
        $admin_message .= 'Email: ' . $email . '<br>';
        $admin_message .= 'Weitere Details finden Sie im Redmine.';
        $admin_headers = array(
            'Content-Type: text/html; charset=UTF-8',
            'From: TT global learning gGmbH <info@t-und-t-global-learning.de>'
        );

        // Send the email to the admin
        $admin_sent = wp_mail($admin_email, 'Das neue Anmeldeformular ist eingegangen ', $admin_message, $admin_headers);

        if ($user_sent && $admin_sent) {
            echo '<div class="success-message">Eine E-Mail wurde an ' . $email . ' gesendet und der Admin wurde benachrichtigt.</div>';
        } else {
            echo '<div class="error-message">E-Mail konnte nicht gesendet werden.</div>';
        }


