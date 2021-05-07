<?php 
   get_header();
   include('inc/get-doctors.php');
   include('inc/get-faq.php');
?>

<section aria-labelledby="introductionHeading" class="introSection bg-teal">
   <div class="content content-padding flex flex-2 tablet-1 row-reverse">
      <div>
         <div class="vertical-center">
            <h1 id="introductionHeading">With dermatic atopis, itching isn’t even the worst part.</h1>
            <p id="studyDesc">See if you or your child may qualify for the DAvocate 1 Study, a clinical research study for moderate to severe dermatic atopis.</p>
            <a 
               class="primaryLink" 
               title="See If You May Qualify"
               aria-label="See If You May Qualify"
               aria-describedby="studyDesc" 
               href="#see-if-you-may-qualify">See If You May Qualify</a>
         </div>
      </div>
      <div class="flex flex-end" role="presentation">
         <picture class="image">
            <source media="(min-width:768px)" srcset="<?= get_template_directory_uri() ?>/assets/images/hero.webp" type="image/webp">
            <source media="(min-width:768px)" srcset="<?= get_template_directory_uri() ?>/assets/images/hero.png">
            <source media="(max-width:480px)" srcset="<?= get_template_directory_uri() ?>/assets/images/hero-mobile.webp" type="image/webp">
            <source media="(max-width:480px)" srcset="<?= get_template_directory_uri() ?>/assets/images/hero-mobile.png">
            <img src="<?= get_template_directory_uri() ?>/assets/images/hero.png" alt="Illustration of a person with several arms trying to itch themselves.">
         </picture>
      </div>

   </div>
</section>

<section aria-labelledby="purposeHeading" class="purposeSection bg-white">
   <div class="content content-padding padding-top-bottom text-align-center">
      <h2 id="purposeHeading" class="scribbleDeco">Purpose of the DAvocate 1 Study.</h2>
      <p>The purpose of the DAvocate 1 Study is to evaluate the safety and effectiveness of an injectable investigational medication for moderate to severe dermatitic atopis.</p>
   </div>
</section>

<section aria-labelledby="eligibilityHeading expectHeading" class="purposeSection bg-tan">
   <div class="content content-padding padding-top-bottom flex flex-2 tablet-1">
      <div>
         <h3 id="eligibilityHeading">Who is eligible?</h2>
         <p>Eligible participants for this study must:</p>
         <ul class="default-list">
            <li>Be male or female, 12 years of age or older</li>
            <li>Have chronic dermatitic atopis for at least one year</li>
            <li>Have a history of inadequate response to topical treatments for dermatitic atopis</li>
         </ul>
         <p>Additional eligibility criteria will be assessed by the study doctor or staff during the screening process prior to being enrolled in the study and receiving any investigational medication. Not all individuals will qualify to participate.</p>
         <?php include('inc/da-circle-logo.php') ?>
      </div>
      <div>
         <h3 id="expectHeading">What to expect.</h3>
         <p>Participation in the DAvocate 1 Study lasts approximately 56 weeks and consists of three parts:</p>
         <ul class="default-list">
            <li>During a <strong>screening period</strong> of up to 30 days, the study doctor will perform tests and procedures to determine if you or your child is eligible to participate.</li>
            <li>If eligible, you or your child will enter the 52-week <strong>treatment period</strong> and begin receiving the investigational medication or a placebo (which contains no active medication), both of which are delivered as an injection.</li>
            <li>If eligible, you or your child may continue receiving the investigational medication in a separate long-term extension study. Or you or your child may stop participating by receiving a <strong>safety follow-up</strong> phone call 12 weeks after the last dose of investigational medication.</li>
         </ul>
      </div>
   </div>
</section>

<section aria-labelledby="faqHeading" class="faqSection bg-white">
   <div class="content content-padding padding-top-bottom">
      <h2 id="faqHeading" class="scribbleDeco text-align-center">Frequently asked questions.</h2>
      <?php if(!empty($all_faq)) : ?>
         <ul class="faqList list-no-style">
            <?php foreach($all_faq as $index => $faq) : ?>
               <li>
                  <h3>
                     <button 
                        class="faqBtn faIcon toggle"
                        aria-expanded="false"
                        aria-controls="accordion_<?= $index ?>"  
                        type="button"><?= $faq['question'] ?></button>
                  </h3>
                  <div id="accordion_<?= $index ?>" class="togglePanel">
                     <p><?= $faq['answer'] ?></p>
                  </div>
               </li>
            <?php endforeach ?>
         </ul>
      <?php endif ?>
   </div>
</section>

<section class="bg-tan">
   <div class="content content-padding padding-top-bottom">
      <?php foreach($all_locations as $location) : ?>
         <div class="locationSubSection">
            <h3><?= $location['label'] ?></h3>
            <ul class="doctorList list-no-style">
               <?php 
                  foreach($all_docs as $doctor) : 
                     if($doctor['location'] == $location['value']) :
               ?>
                  <li>
                     <h4>Dr. <?= $doctor['name'] ?></h4>
                     <address><?= $doctor['address'] ?></address>
                     <a 
                        title="Contact Dr. <?= $doctor['name'] ?>"
                        aria-label="Contact Dr. <?= $doctor['name'] ?>"
                        class="inlineLink" 
                        href="<?= $doctor['button_url'] ?>">
                        <?= $doctor['button_text'] ?></a>
                  </li>
               <?php 
                     endif;
                  endforeach;
               ?>
            </ul>
         </div>
      <?php endforeach ?>
   </div>
</section>

<section id="see-if-you-may-qualify" class="bg-white">
   <div class="content content-padding padding-top-bottom">
      <h2 class="scribbleDeco text-align-center">See If You May Quality</h2>
      <div class="formWrapper">
         <form class="inquiryForm" id="inquiryForm" data-endpoint="https://formbucket.com/f/buk_zJL7eGC7Ezv4jB0i9GzQtJe4">
            <div class="formInputWrapper">
               <label id="firstNameLabel">Name*</label>
               <input aria-labelledby="firstNameLabel" name="Name" required type="text" />
            </div>
            <div class="formInputWrapper">
               <label id="emailLabel">Email*</label>
               <input aria-labelledby="emailLabel emailHelper" name="Email" required type="email" />
               <p id="emailHelper" class="inputHelperText">example@email.com</p>
            </div>
            
            <div class="formInputWrapper">
               <label id="messageLabel">Message*</label>
               <textarea name="Message" aria-labelledby="messageLabel" required></textarea>
            </div>
            <p class="disclaimer">Disclaimer: Please note we will use this information to contact you only, it won't be shared with anyone else.
            <div class="text-align-center">
               <button class="primaryLink" type="submit">Submit</button>
            </div>
         </form>
         <p id="formThanks" class="thanks">Thank you, Crowley Webb will be in touch soon.</p>
      </div>
   </div>
</section>

<?php 
   get_footer();
?>