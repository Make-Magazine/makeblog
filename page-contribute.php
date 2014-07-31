<?php
/**
 * Template Name: Contribute Page
 */

  add_action('wp_enqueue_scripts', 'makeblog_jQuery_form_valid'); 


  function makeblog_jQuery_form_valid() {

    wp_enqueue_script( 'make-home', get_template_directory_uri() . '/js/home.js', array( 'jquery' ) );
    wp_localize_script( 'make-home', 'MakeAjax', array( 
      'makeajaxurl' => home_url( '/wp-admin/admin-ajax.php' )
    ) );

    }
              
?>

<?php get_header(); ?>
<div class="single">
  <div class="container">
    <div class="row">
      <div class="span8">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="masthead">
          <h1><?php the_title(); ?></h1>
        </div>  
        <article <?php post_class(); ?> > 
            <?php the_content('Read the Full Story'); ?>
        </article> 
        <div class="clear"></div>
        <div id="contribute-tabs">
          <ul class="nav nav-tabs">
            <li class="active"><a data-target="#page2" data-toggle="tab">Make: Page 2</a></li>
            <li class=""><a data-target="#linksub" data-toggle="tab">Share a Link</a></li>
            <li class=""><a data-target="#article" data-toggle="tab">Submit an Article or Project</a></li>
          </ul>
        </div>
        <div class="contribute-content">
          <div class="navi-page-content">
            <div class="tab-pane sub-nav active" id="page2">
              <form id="page2form" class="form-horizontal validate" name="page2form" method="post"  enctype="multipart/form-data">
                <div class="control-group">
                  <label class="control-label" for="page2_title">Title</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="page2_title">
                    <p class="help-block">Please suggest a title for your submission.</p>
                  </div>
                </div>
            
                <div class="control-group">
                  <label class="control-label" for="page2_content">Content</label>
                  <div class="controls">
                    <textarea class="input-xlarge" id="page2_content" rows="3"></textarea>
                    <p class="help-block">Suggested content/contributor quote.</p>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="page2_link">Link</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="page2_link">
                    <p class="help-block">Link / URL (Please include "http://")</p>
                  </div>
                </div>

                <?php if( !is_user_logged_in() ) { ?>

                <div class="control-group">
                  <label class="control-label" for="page2_author">Author</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="page2_author">
                    <p class="help-block">Please provide your name as you like to see it spelled.</p>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="page2_email">Author Email</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="page2_email">
                    <p class="help-block">We will not publish this information, but we would like to be able to contact you with follow-up questions.</p>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="page2_website">Author Website</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="page2_website">
                    <p class="help-block">We are happy to link to your personal online presence.</p>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="page2_bio">Author Bio</label>
                  <div class="controls">
                    <textarea class="input-xlarge" id="page2_bio" rows="3"></textarea>
                    <p class="help-block">Please tell us a bit about yourself, for background
              and context. And just because we care.</p>
                  </div>
                </div>

                <?php } ?>

                <div class="form-actions">
                  <button type="submit" id="page2_submit" name="page2_submit" class="btn btn-primary">Submit</button>
                  <button class="btn">Cancel</button>
                </div>

                <input name="action" value="makeblog_page2form" type="hidden" />
                <?php wp_nonce_field('page2form_submit','page2form_subform'); ?> 
              </form>
            </div>
            <div class="tab-pane sub-nav" id="linksub">
              <form id="linksubform" class="form-horizontal validate" name="linksubform" method="post" enctype="multipart/form-data">
                <input name="action" value="makeblog_linksubform" type="hidden" />
                <?php wp_nonce_field('linksubform_submit','linksubform_subform'); ?> 
                <div class="control-group required">
                  <label class="control-label" for="linksub_title">Link Title*</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="linksub_title">
                    <p class="help-block">Please suggest a title for your submission.</p>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="linksub_content">Link Content</label>
                  <div class="controls">
                    <textarea class="input-xlarge" id="linksub_content" rows="3"></textarea>
                    <p class="help-block">Suggested content/contributor quote.</p>
                  </div>
                </div>
                
                <div class="control-group">
                  <label class="control-label" for="linksub_link">Link / URL</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="linksub_link">
                    <p class="help-block">(Please include "http://")</p>
                  </div>
                </div>

                <?php if( !is_user_logged_in() ) { ?>

                  <div class="control-group">
                    <label class="control-label" for="linksub_name">Name</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" id="linksub_name">
                      <p class="help-block">Please provide your name as you like to see it spelled.</p>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="linksub_email">Email</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" id="linksub_email">
                      <p class="help-block">We will not publish this information, but we would like to be able to contact you with follow-up questions.</p>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="linksub_website">Website</label>
                    <div class="controls">
                      <input type="text" class="input-xlarge" id="linksub_website">
                      <p class="help-block">We are happy to link to your personal online presence.</p>
                    </div>
                  </div>

                  <div class="control-group">
                    <label class="control-label" for="linksub_bio">Bio</label>
                    <div class="controls">
                      <textarea class="input-xlarge" id="linksub_bio" rows="3"></textarea>
                      <p class="help-block">Please tell us a bit about yourself, for background
                      and context. And just because we care.</p>
                    </div>
                  </div>

                <?php } ?>

                <div class="form-actions">

                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button class="btn">Cancel</button>

                </div>

              </form>

            </div>

            <div class="tab-pane sub-nav" id="article">
              <form id="articleform" class="form-horizontal validate" name="articleform" method="post" enctype="multipart/form-data">
                <div class="control-group required">
                  <label class="control-label" for="article_title">Article Title*</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_title">
                    <p class="help-block">One-sentence description of your idea (you'll be able to give us more details below)*</p>
                  </div>
                </div>

                <?php if( !is_user_logged_in() ) { ?>

                <div class="control-group required">
                  <label class="control-label" for="article_name">Full Name*</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_name">
                    <p class="help-block">Please provide your name as you like to see it spelled.</p>
                  </div>
                </div>

                <div class="control-group required">
                  <label class="control-label" for="article_email">Email*</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_email">
                    <p class="help-block">We will not publish this information, but we would like to be able to contact you with follow-up questions.</p>
                  </div>
                </div>

                <?php } ?>

                <div class="control-group">
                  <label class="control-label" for="article_mail">Mailing Address</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_mail">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_city">City</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_city">
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_state">State</label>
                  <div class="controls">
                    <select name="article_state">
                      <option></option>
                      <option>AB</option>
                      <option>AE</option>
                      <option>AK</option>
                      <option>AL</option>
                      <option>AP</option>
                      <option>AR</option>
                      <option>AZ</option>
                      <option>BC</option>
                      <option>CA</option>
                      <option>CO</option>
                      <option>CT</option>
                      <option>DC</option>
                      <option>DE</option>
                      <option>FL</option>
                      <option>GA</option>
                      <option>GU</option>
                      <option>HI</option>
                      <option>IA</option>
                      <option>ID</option>
                      <option>IL</option>
                      <option>IN</option>
                      <option>KS</option>
                      <option>KY</option>
                      <option>LA</option>
                      <option>MA</option>
                      <option>MB</option>
                      <option>MD</option>
                      <option>ME</option>
                      <option>MI</option>
                      <option>MN</option>
                      <option>MO</option>
                      <option>MS</option>
                      <option>MT</option>
                      <option>NB</option>
                      <option>NC</option>
                      <option>ND</option>
                      <option>NE</option>
                      <option>NF</option>
                      <option>NH</option>
                      <option>NJ</option>
                      <option>NM</option>
                      <option>NS</option>
                      <option>NT</option>
                      <option>NV</option>
                      <option>NY</option>
                      <option>OH</option>
                      <option>OK</option>
                      <option>ON</option>
                      <option>OR</option>
                      <option>PA</option>
                      <option>PE</option>
                      <option>PR</option>
                      <option>QU</option>
                      <option>RI</option>
                      <option>SC</option>
                      <option>SD</option>
                      <option>SK</option>
                      <option>TN</option>
                      <option>TX</option>
                      <option>UT</option>
                      <option>VA</option>
                      <option>VI</option>
                      <option>VT</option>
                      <option>WA</option>
                      <option>WI</option>
                      <option>WV</option>
                      <option>WY</option>
                      <option>YU</option>
                    </select>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_zip">Zip</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_zip">
                  </div>
                </div>    

                <div class="control-group">
                  <label class="control-label" for="article_country">Country</label>
                  <div class="controls">
                    <select name="article_country">
                      <option></option>
                      <option>United States</option>
                      <option>Afghanistan</option>
                      <option>Albania</option>
                      <option>Algeria</option>
                      <option>American Samoa</option>
                      <option>Andorra</option>
                      <option>Angola</option>
                      <option>Anguilla</option>
                      <option>Antartica</option>
                      <option>Antigua And Barbuda</option>
                      <option>Argentina</option>
                      <option>Armenia</option>
                      <option>Aruba</option>
                      <option>Australia</option>
                      <option>Austria</option>
                      <option>Azerbaijan</option>
                      <option>Bahamas</option>
                      <option>Bahrain</option>
                      <option>Bangladesh</option>
                      <option>Barbados</option>
                      <option>Belarus</option>
                      <option>Belgium</option>
                      <option>Belize</option>
                      <option>Benin</option>
                      <option>Bermuda</option>
                      <option>Bhutan</option>
                      <option>Bolivia</option>
                      <option>Bosnia and Herzegovina</option>
                      <option>Botswana</option>
                      <option>Bouvet Island</option>
                      <option>Brazil</option>
                      <option>British Indian Ocean Territory</option>
                      <option>Brunei Darussalam</option>
                      <option>Bulgaria</option>
                      <option>Burkina Faso</option>
                      <option>Burundi</option>
                      <option>Cambodia</option>
                      <option>Cameroon</option>
                      <option>Canada</option>
                      <option>Cape Verde</option>
                      <option>Cayman Islands</option>
                      <option>Central African Republic</option>
                      <option>Chad</option>
                      <option>Chile</option>
                      <option>China</option>
                      <option>Christmas Islnd</option>
                      <option>Cocos (Keeling) Islands</option>
                      <option>Colombia</option>
                      <option>Comoros</option>
                      <option>Congo</option>
                      <option>Congo, The Democratic Republic Of The</option>
                      <option>Cook Islands</option>
                      <option>Costa Rica</option>
                      <option>Côte d'Ivoire</option>
                      <option>Croatia</option>
                      <option>Cuba</option>
                      <option>Cyprus</option>
                      <option>Czech Republic</option>
                      <option>Denmark</option>
                      <option>Djibouti</option>
                      <option>Dominica</option>
                      <option>Dominican Republic</option>
                      <option>Ecuador</option>
                      <option>Egypt</option>
                      <option>El Salvador</option>
                      <option>Equatorial Guinea</option>
                      <option>Eritrea</option>
                      <option>Estonia</option>
                      <option>Ethiopia</option>
                      <option>Falkland Island</option>
                      <option>Faroe Islands</option>
                      <option>Fiji</option>
                      <option>Finland</option>
                      <option>France</option>
                      <option>French Guiana</option>
                      <option>French Polynesia</option>
                      <option>French Southern Territories</option>
                      <option>Gabon</option>
                      <option>Gambia</option>
                      <option>Georgia</option>
                      <option>Germany</option>
                      <option>Ghana</option>
                      <option>Gibraltar</option>
                      <option>Greece</option>
                      <option>Greenland</option>
                      <option>Grenada</option>
                      <option>Guadeloupe</option>
                      <option>Guam</option>
                      <option>Guatemala</option>
                      <option>Guernsey</option>
                      <option>Guinea</option>
                      <option>Guinea-Bissau</option>
                      <option>Guyana</option>
                      <option>Haiti</option>
                      <option>Heard And McDonald Islands</option>
                      <option>Holy See (Vatican City State)</option>
                      <option>Honduras</option>
                      <option>Hong Kong</option>
                      <option>Hungary</option>
                      <option>Iceland</option>
                      <option>India</option>
                      <option>Indonesia</option>
                      <option>Iran, Islamic Republic of</option>
                      <option>Iraq</option>
                      <option>Ireland</option>
                      <option>Isle of Man</option>
                      <option>Israel</option>
                      <option>Italy</option>
                      <option>Jamaica</option>
                      <option>Japan</option>
                      <option>Jersey</option>
                      <option>Jordan</option>
                      <option>Kazakhstan</option>
                      <option>Kenya</option>
                      <option>Kiribati</option>
                      <option>Korea, Democratic People's Republic Of</option>
                      <option>Korea, Republic of</option>
                      <option>Kuwait</option>
                      <option>Kyrgyzstan</option>
                      <option>Lao People's Democratic Republic</option>
                      <option>Latvia</option>
                      <option>Lebanon</option>
                      <option>Lesotho</option>
                      <option>Liberia</option>
                      <option>Libyan Arab Jamahiriya</option>
                      <option>Liechtenstein</option>
                      <option>Lithuania</option>
                      <option>Luxembourg</option>
                      <option>Macao</option>
                      <option>Macedonia, the former Yugoslav Republic of</option>
                      <option>Madagascar</option>
                      <option>Malawi</option>
                      <option>Malaysia</option>
                      <option>Maldives</option>
                      <option>Mali</option>
                      <option>Malta</option>
                      <option>Marshall Islands</option>
                      <option>Martinique</option>
                      <option>Mauritania</option>
                      <option>Mauritius</option>
                      <option>Mayotte</option>
                      <option>Mexico</option>
                      <option>Micronesia, Federated States of</option>
                      <option>Moldova, Republic Of</option>
                      <option>Monaco</option>
                      <option>Mongolia</option>
                      <option>Monserrat</option>
                      <option>Montenegro</option>
                      <option>Morocco</option>
                      <option>Mozambique</option>
                      <option>Myanmar</option>
                      <option>Namibia</option>
                      <option>Nauru</option>
                      <option>Nepal</option>
                      <option>Netherlands</option>
                      <option>Netherlands Antilles</option>
                      <option>New Calcedonia</option>
                      <option>New Zealand</option>
                      <option>Nicaragua</option>
                      <option>Niger</option>
                      <option>Nigeria</option>
                      <option>Niue</option>
                      <option>Norfolk Island</option>
                      <option>Northern Mariana Islands</option>
                      <option>Norway</option>
                      <option>Oman</option>
                      <option>Online</option>
                      <option>Pakistan</option>
                      <option>Palau</option>
                      <option>Palestinian Territory, Occupied</option>
                      <option>Panama</option>
                      <option>Papua New Guinea</option>
                      <option>Paraguay</option>
                      <option>Peru</option>
                      <option>Philippines</option>
                      <option>Pitcairn</option>
                      <option>Poland</option>
                      <option>Portugal</option>
                      <option>Puerto Rico</option>
                      <option>Qatar</option>
                      <option>Reunion</option>
                      <option>Romania</option>
                      <option>Russian Federation</option>
                      <option>Rwanda</option>
                      <option>Saint Barthélemy</option>
                      <option>Saint Helena</option>
                      <option>Saint Kitts and Nevis</option>
                      <option>Saint Lucia</option>
                      <option>Saint Martin</option>
                      <option>Saint Pierre and Miquelon</option>
                      <option>Saint Vincent and the Grenadines</option>
                      <option>Samoa</option>
                      <option>San Marino</option>
                      <option>Sao Tome and Principe</option>
                      <option>Saudi Arabia</option>
                      <option>Senegal</option>
                      <option>Serbia</option>
                      <option>Seychelles</option>
                      <option>Sierra Leone</option>
                      <option>Singapore</option>
                      <option>Slovakia</option>
                      <option>Slovenia</option>
                      <option>Solomon Islands</option>
                      <option>Somalia</option>
                      <option>South Africa</option>
                      <option>South Georgia and the South Sandwich Islands</option>
                      <option>Spain</option>
                      <option>Sri Lanka</option>
                      <option>Sudan</option>
                      <option>Suriname</option>
                      <option>Svalbard and Jan Mayen</option>
                      <option>Swaziland</option>
                      <option>Sweden</option>
                      <option>Switzerland</option>
                      <option>Syrian Arab Republic</option>
                      <option>Taiwan</option>
                      <option>Tajikistan</option>
                      <option>Tanzania, United Republic of</option>
                      <option>Thailand</option>
                      <option>Timor-Leste</option>
                      <option>Togo</option>
                      <option>Tokelau</option>
                      <option>Tongo</option>
                      <option>Trinidad and Tobago</option>
                      <option>Tunisia</option>
                      <option>Turkey</option>
                      <option>Turkmenistan</option>
                      <option>Turks and Caicos Islands</option>
                      <option>Tuvalu</option>
                      <option>Uganda</option>
                      <option>Ukraine</option>
                      <option>United Arab Emirates</option>
                      <option>United Kingdom</option>
                      <option>United States</option>
                      <option>United States Minor Outlying Islands</option>
                      <option>Uruguay</option>
                      <option>Uzbekistan</option>
                      <option>Vanuatu</option>
                      <option>Venezuela</option>
                      <option>Viet Nam</option>
                      <option>Virgin Islands, British</option>
                      <option>Virgin Islands, U.S.</option>
                      <option>Wallis and Futuna</option>
                      <option>Western Sahara</option>
                      <option>Yemen</option>
                      <option>Zambia</option>
                      <option>Zimbabwe</option>
                      <option>Åland Islands</option>
                    </select>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_phone">Phone Number</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_phone">
                  </div>
                </div>  

                <?php if( !is_user_logged_in() ) { ?>

                <div class="control-group">
                  <label class="control-label" for="article_bio">Bio</label>
                  <div class="controls">
                    <textarea class="input-xlarge" id="article_bio" rows="3"></textarea>
                    <p class="help-block">Please tell us a bit about yourself, for background
                    and context. And just because we care.</p>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_website">Website</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_website">
                    <p class="help-block">We are happy to link to your personal online presence.</p>
                  </div>
                </div>

                <?php } ?>

                <div class="control-group">
                  <label class="control-label">Type of Pitch: What are you proposing?</label>
                  <div class="controls">
                    <label class="radio">
                    <input type="radio" name="article_pitch" id="article_pitch1" value="This is my project and I'd like to write about it for MAKE / CRAFT">
                    This is my project and I'd like to write about it for MAKE / CRAFT
                    </label>
                    <label class="radio">
                    <input type="radio" name="article_pitch" id="article_pitch2" value="This is a cool project; it's not mine, but I'd like to write about it for MAKE / CRAFT">
                     This is a cool project; it's not mine, but I'd like to write about it for MAKE / CRAFT
                    </label>
                  </div>
                </div>

                <h3>For Project Pitches</h3>

                  <div class="control-group">
                  <label class="control-label">Have you already built this project?</label>
                  <div class="controls">
                    <label class="radio inline">
                    <input type="radio" name="article_built" id="article_built_yes" value="yes">
                    yes
                    </label>
                    <label class="radio inline">
                    <input type="radio" name="article_built" id="article_built_no" value="no">
                     no
                    </label>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label">Have you taken good quality photos of each step of the project?</label>
                  <div class="controls">
                    <label class="radio inline">
                    <input type="radio" name="article_photo" id="article_photo_yes" value="yes">
                    yes
                    </label>
                    <label class="radio inline">
                    <input type="radio" name="article_photo" id="article_photo_no" value="no">
                       no
                    </label>
                  </div>
                </div>

                  <div class="control-group">
                  <label class="control-label" for="article_photo_url">Photos URL</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_photo_url">
                    <p class="help-block">If you have photos of the project, what is the URL where we can see them?</p>
                  </div>
                </div> 

                <div class="control-group">
                  <label class="control-label">Do you have a video of a working prototype?</label>
                  <div class="controls">
                    <label class="radio inline">
                    <input type="radio" name="article_working" id="article_working_yes" value="yes">
                    yes
                    </label>
                    <label class="radio inline">
                    <input type="radio" name="article_working" id="article_working_no" value="no">
                     no
                    </label>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_video_url">Video URL</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_video_url">
                    <p class="help-block">If you have a video of the project, please provide a link where can we watch it?</p>
                  </div>
                </div>

                <h3>For all Types of Ideas</h3>

                <div class="control-group">
                  <label class="control-label" for="article_writeup_url">Write-up URL</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_writeup_url"></input>
                    <p class="help-block">If you have already written this article or project, please provide a URL where we can read about it? If you shared your build in Make: Projects, please enter that url here.</p>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_description">Please describe the article or project in a paragraph or two.</label>
                  <div class="controls">
                    <textarea class="input-xlarge" id="article_description" rows="3"></textarea>
                  </div>
                </div>

                <div class="control-group">
                  <label class="control-label" for="article_wordcount">If you know the approximate word count of the piece, enter it here.</label>
                  <div class="controls">
                    <input type="text" class="input-xlarge" id="article_wordcount">
                  </div>
                </div>

                <div class="form-actions">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button class="btn">Cancel</button>
                </div>

                <input name="action" value="makeblog_articleform" type="hidden" />

                <?php wp_nonce_field('articleform_submit','articleform_subform'); ?> 
              </form>
            </div>
          </div>
        </div>

        <div id="modal-uploader" class="modal hide fade">
          <div class="modal-header">
            <a id='xclose' href="#" class="close">×</a>
            <h3>Image Uploader</h3>
          </div>
          <div class="modal-body">
            <?php 
              $shortcode = '[fu-upload-form class="your-class" title="Upload your media"][input type="file" name="photo" id="ug_photo" class="required" description="Featured Photo"][input type="file" name="photo1" id="ug_photo1" description="Additional Photo"][textarea name="caption" class="textarea" id="ug_caption" description="Description (optional)"][/fu-upload-form]';
              echo do_shortcode($shortcode); 
            ?>
          </div>
        </div>
        <?php endwhile; ?>


          <?php if ( function_exists('make_shopify_featured_products_slider') ) {
               echo make_shopify_featured_products_slider( 'row-fluid' );
            } ?>
        <?php else: ?>
          <p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
        <?php endif; ?>

      </div>

  <?php get_sidebar(); ?>
<?php get_footer(); ?>
