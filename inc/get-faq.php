<?php
   $all_faq = [];

   if(have_rows('faq_item')):
      while(have_rows('faq_item')) : the_row();
   
         $q = get_sub_field('question');
         $a = get_sub_field('answer');

         $faq_obj = [
            'question' => $q,
            'answer' => $a,
         ];
   
         $all_faq[] = $faq_obj;

      endwhile;
   endif;

   wp_reset_postdata();

?>