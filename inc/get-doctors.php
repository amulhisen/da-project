<?php
   $all_docs = [];
   $all_locations = [];

   $doctors = new WP_Query(array(
      'post_type' => 'doctor',
      'posts_per_page' => -1,
   ));

   while ($doctors->have_posts()) : $doctors->the_post(); 

      $dr_name = get_field('doctor_name');
      $address = get_field('address');
      $location = get_field('location');
      $button_text = '';
      $button_url = '';

      /* separate out locations */
      if(!in_array($location, $all_locations)) {
         $all_locations[] = $location;
      }

      /* create button */
      while(have_rows('contact_button')): the_row(); 
         $type = get_sub_field('link_type');
         $button_text_field = get_sub_field('button_text');
         $phone_field = get_sub_field('phone_link');
         $email_field = get_sub_field('email_link');

         if(empty($button_text_field)) {
            $button_text = 'Contact this doctor';
         }
         else {
            $button_text = $button_text_field;
         }

         if($type == 'phone') {
            $button_url = 'tel:' . $phone_field;
         }
         else {
            $button_url = 'mailto:' . $email_field;
         }
      endwhile;

      $doctor_obj = [
         'name' => $dr_name,
         'address' => $address,
         'location' => $location['value'],
         'button_url' => $button_url,
         'button_text' => $button_text
      ];

      $all_docs[] = $doctor_obj;
   endwhile;
   
   /*
   $dr_name = array_column($all_docs, 'name');
   array_multisort($dr_name, SORT_DESC, $all_docs);
   */
   sort($all_locations);

   wp_reset_postdata();

?>