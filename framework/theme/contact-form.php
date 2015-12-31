<?php
function concierge_user_data_for_message(){

    global $autorent_option_data ; 


    $form_data = $_POST['form_data'];
     //parse_str($form_data,$user_info);

    if(isset($form_data) && is_array($form_data)){

        foreach ($form_data as $key => $value) {

            
            if($value['name'] === 'email_to'){
               $email_to = esc_attr($value['value']);
            }
           
            if($value['name'] === 'name'){
                $field_name = esc_attr($value['value']);
            }

            if($value['name'] === 'phone'){
                $field_phone = esc_attr($value['value']);
            }

            if($value['name'] === 'email'){
                $field_email = esc_attr($value['value']);
            }

            if($value['name'] === 'topics'){
                $field_subject = esc_attr($value['value']);
            }

            if($value['name'] === 'message'){
                $field_message = esc_attr($value['value']);
            }

        }
     }


 

    if( isset( $field_email ) ) {

        $success_msg = 'Message sent successfully!';

        $autorent_option_data['from_email'] = $field_email;
        $autorent_option_data['sender_name'] = $field_name;

        function died( $error ) {
            echo '<p class="alert-message warning phpvalidation" style="display: none;"><i class="ico fa fa-exclamation-circle"></i>' . $error . '</p>';
            die();
        }

        // validation expected data exists
        if( !isset( $field_name ) || !isset( $field_email ) || !isset( $field_message ) ) {

            died( '<strong>Fields with (*) are required!</strong>' );

        }       

        $error_message = '';

        $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
        if ( !preg_match( $email_exp, $field_email ) ) {
            $error_message .= '<br>The Email Address you entered does not appear to be valid.';
        }

        $string_exp = "/^[A-Za-z .'-]+$/";
        if ( !preg_match( $string_exp, $field_name ) ) {
            $error_message .= '<br>The First Name you entered does not appear to be valid.';
        }

        if ( strlen( $field_message ) < 2 ) {
            $error_message .= '<br>The Comments you entered do not appear to be valid.';
        }

        if ( strlen( $error_message ) > 0 ) {
            died( $error_message );
        }

        function clean_string( $string ) {
            $bad = array( 'content-type', 'bcc:', 'to:', 'cc:', 'href' );
            return str_replace( $bad, '', $string );
        }

        $email_message = 'Form details below.' . "\n\n";
        $email_message .= 'Name: ' . clean_string( $field_name ) . "\n";
        $email_message .= 'Email: ' . clean_string( $field_email ) . "\n";
        if ( isset( $field_phone ) ) {
            $email_message .= 'Phone: ' . clean_string( $field_phone ) . "\n";
        }
        $email_message .= "\n" . clean_string( $field_message ) . "\n";

        $headers = 'From: ' . $field_email . "\r\n".'Reply-To: ' . $field_email . "\r\n" ;
        // $headers = 'From: My Name <myname@example.com>' . "\r\n"; 

        wp_mail($email_to, $field_subject, $email_message, $headers);

        echo esc_attr($success_msg);

    }




}



add_action("wp_ajax_concierge_user_data_for_message", 'concierge_user_data_for_message' );
add_action("wp_ajax_nopriv_concierge_user_data_for_message", "concierge_user_data_for_message");




function autorent_from_name( $name ) {

    $blog_title = get_bloginfo();
    global $autorent_option_data;
    return $autorent_option_data['sender_name'].'-'.$blog_title;

} 

add_filter( 'wp_mail_from_name', 'autorent_from_name' );


function autorent_from_email( $email ) {

    global $autorent_option_data;
    return $autorent_option_data['from_email'];
} 

add_filter( 'wp_mail_from', 'autorent_from_email' );