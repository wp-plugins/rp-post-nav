<div class="wrap" id="rp-wrap">
  <div class="rp-header">
    <div class="rp-header-left"><div class="rp-header-logo"><a href="http://rplofino.freehosting007.com/" target="_blank" alt="RP Post Nav"><img src="<?php echo plugins_url('css/images/rp-logo.png', __FILE__); ?>" alt="RP Post Nav" width="43" height="74" /></a></div>
    <div class="rp-header-caption"><a href="http://rplofino.freehosting007.com/" target="_blank" alt="RP Post Nav">RP Post Nav</a></div></div>
    <div class="rp-header-right">
      <em>by: Rommel Plofino</em><br>
    </div>
  </div>

  <h2>RP Post Nav - Settings</h2>
  <h2 id="rp-post-nav-settings-tabs" class="nav-tabber-wrapper">
    <a id="settings" class="nav-tabber nav-tabber-active" href="?page=rp-post-nav">Settings</a>
    <a id="help" class="nav-tabber" href="?page=rp-post-nav-help">Help</a>
  </h2>

  <form action="<?php echo $action_url ?>" method="post">
    <input type="hidden" name="submitted" value="1" />
    <?php wp_nonce_field('rp-post-nav-fields'); ?>
  
    <div id="rp-content">
      
      <div class="rp-box">
        <div class="rp-box-wrap">
          <div class="rp-box-title">Display</div>
          <div class="rp-box-text">
            <div class="column">
              <div class="column-label column-item">Activate</div>
              <div class="column-field column-item"><input type="checkbox" name="is_active" value="1" <?php echo $settings['is_active']=="1"? 'checked="checked"': '' ; ?>  /> check to activate automatic display</div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Position</div>
              <div class="column-field column-item">
                <ul>
                  <li><select name="position" id="position">
                    <option value="top" <?php echo $settings['position']=="top"? 'selected="selected"': '' ; ?>>Top</option>
                    <option value="bottom" <?php echo $settings['position']=="bottom"? 'selected="selected"': '' ; ?>>Bottom</option>
                    <option value="both" <?php echo $settings['position']=="both"? 'selected="selected"': '' ; ?>>Top &amp; Bottom</option>
                  </select></li>
                  <li><strong>Top</strong> <em>before content</em></li>
                  <li><strong>Bottom</strong> <em>after content</em></li>
                  <li><strong>Top &amp; Bottom</strong> <em>both before and after content</em></li>
                </ul>
              </div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Thumbnail</div>
              <div class="column-field column-item"><input type="checkbox" name="is_thumbnail" value="1" <?php echo $settings['is_thumbnail']=="1"? 'checked="checked"': '' ; ?>  /> check to activate post thumbnail</div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Excerpt</div>
              <div class="column-field column-item"><input type="checkbox" name="is_excerpt" value="1" <?php echo $settings['is_excerpt']=="1"? 'checked="checked"': '' ; ?>  /> check to activate post excerpt</div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Related</div>
              <div class="column-field column-item"><input type="checkbox" name="related" value="1" <?php echo $settings['related']=="1"? 'checked="checked"': '' ; ?>  /> check to activate related post by taxonomy</div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="rp-box">
        <div class="rp-box-wrap">
          <div class="rp-box-title">Custom Display</div>
          <div class="rp-box-text">
            <div class="column">
              <div class="column-label column-item">Thumbnail Size</div>
              <div class="column-field column-item">
                <ul>
                  <li><input type="number" min="1" max="150" name="thumb_size" placeholder="75"  value="<?php echo $settings['thumb_size']!=""? stripslashes($settings['thumb_size']): stripslashes($settings['thumb_size']); ?>"  /> <span style="color: #999;"><em>default 75</em></span></li>
                  <li>size of thumbnail in pixel</li>
                </ul>
              </div>
            </div>
          
            <div class="column">
              <div class="column-label column-item">Excerpt Length</div>
              <div class="column-field column-item">
                <ul>
                  <li><input type="number" min="1" name="excerpt_length" placeholder="15"  value="<?php echo $settings['excerpt_length']!=""? stripslashes($settings['excerpt_length']): stripslashes($settings['excerpt_length']); ?>"  /> <span style="color: #999;"><em>default 15</em></span></li>
                  <li>number of excerpt in word</li>
                </ul>
              </div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Reverse</div>
              <div class="column-field column-item"><input type="checkbox" name="is_reversed" value="1" <?php echo $settings['is_reversed']=="1"? 'checked="checked"': '' ; ?>  /> check to reverse next/previous position</div>
            </div>
          
            <div class="column">
              <div class="column-label column-item">Enable Custom Label</div>
              <div class="column-field column-item"><input type="checkbox" name="is_label" value="1" <?php echo $settings['is_label']=="1"? 'checked="checked"': '' ; ?>  /> check to customize next/previous label</div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Previous Label Text</div>
              <div class="column-field column-item"><input type="text" name="custom_prev_label" placeholder="Previous Label"  value="<?php echo $settings['custom_prev_label']!=""? stripslashes($settings['custom_prev_label']): stripslashes($settings['custom_prev_label']); ?>"  /></div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Next Label Text</div>
              <div class="column-field column-item"><input type="text" name="custom_next_label" placeholder="Next Label"  value="<?php echo $settings['custom_next_label']!=""? stripslashes($settings['custom_next_label']): stripslashes($settings['custom_next_label']); ?>"  /></div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Enable Custom Background</div>
              <div class="column-field column-item"><input type="checkbox" name="is_custom_bg" value="1" <?php echo $settings['is_custom_bg']=="1"? 'checked="checked"': '' ; ?>  /> check to customize next/previous background</div>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Previous Background</div>
              <div class="column-field column-item">
                <ul>
                  <li><input type="url" name="custom_prev_label_nav_bg" placeholder="http://"  value="<?php echo $settings['custom_prev_label_nav_bg']!=""? stripslashes($settings['custom_prev_label_nav_bg']): ''; ?>"  /></li>
                  <li><span style="color: #999;">i.e. http://www.YourDomain.com/previous.png</span></div></li>
                </ul>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Next Background</div>
              <div class="column-field column-item">
                <ul>
                  <li><input type="url" name="custom_next_label_nav_bg" placeholder="http://"  value="<?php echo $settings['custom_next_label_nav_bg']!=""? stripslashes($settings['custom_next_label_nav_bg']): ''; ?>"  /></li>
                  <li><span style="color: #999;">i.e. http://www.YourDomain.com/next.png</span></div></li>
                </ul>
            </div>
            
            <div class="column">
              <div class="column-label column-item">Custom CSS</div>
              <div class="column-field column-item"><textarea id="style_css" name="style_css" placeholder="/* write your custom css here */" style="width: 400px;height: 140px;"><?php echo $settings['style']!=""? stripslashes($settings['style']): ''; ?></textarea></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div id="rp-sidebar">
      <div class="rp-box">
        <div class="rp-box-wrap">
          <div class="rp-box-title">Save</div>
          <div class="rp-box-text">
            <input type="submit" name="Submit" value="Publish" />
          </div>
        </div>
      </div>
    
      <div class="rp-box">
        <div class="rp-box-wrap">
          <div class="rp-box-title">Select Post Types</div>
          <div class="rp-box-text"><p>Registered post types that will be used.</p>
            <ul><?php 
            $post_args = array(
               'show_ui' => true,
               'public' => true
            );
            $post_output = 'names'; // names or objects, note names is the default
            $post_operator = 'and'; // 'and' or 'or'
            $post_types = get_post_types( $post_args, $post_output, $post_operator );
            if(!empty($post_types)){
				foreach ( $post_types as $post_type ) { 
				$post_type_object = get_post_type_object($post_type);
				$post_singular = $post_type_object->labels->singular_name;
				$post_plural = $post_type_object->labels->name;								$custom_post_type_array = !empty($settings['custom_post_type']) ? $settings['custom_post_type'] : 'post' ;				if(is_array($custom_post_type_array)) {					$custom_post_type_checker = in_array($post_type, $custom_post_type_array, true) ? 'checked' : '';
				}				else {					$custom_post_type_checker = $post_type == $custom_post_type_array ? 'checked' : '';
				}								echo '<li><input type="checkbox" name="custom_post_type[]" value="'.$post_type.'" '.$custom_post_type_checker.' /> <span class="post-type-label">'.$post_plural.'</span></li>';				}
            }
            else {
              echo '<li>No Registered Post Type</li>';
            }
            ?>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="rp-box">
        <div class="rp-box-wrap">
          <div class="rp-box-title">Select Taxonomies</div>
          <div class="rp-box-text"><p>Registered taxonomies that will be used.</p>
            <ul><?php 
            $tax_args = array(
               'show_ui' => true,
               'public' => true
            );
            $tax_output = 'names'; // names or objects, note names is the default
            $tax_operator = 'and'; // 'and' or 'or'
            $taxonomies = get_taxonomies( $tax_args, $tax_output, $tax_operator );
            if ( !empty($taxonomies) ) {
                foreach ( $taxonomies  as $taxonomy ) { 
					$taxonomy_object = get_taxonomy($taxonomy);
					$tax_singular = $taxonomy_object->labels->singular_name;
					$tax_plural = $taxonomy_object->labels->name;				  					$taxonomy_array = !empty($settings['custom_taxonomy']) ? $settings['custom_taxonomy'] : 'post' ;					if(is_array($taxonomy_array)) {						$taxonomy_checker = in_array($taxonomy, $taxonomy_array, true) ? 'checked' : '';					}					else {						$taxonomy_checker = '';					}
					echo '<li><input type="checkbox" name="custom_taxonomy[]" value="'.$taxonomy.'" '.$taxonomy_checker.' /> <span class="taxonomy-label">'.$tax_plural.'</span></li>';
				}
            }
            else {
              echo '<li>No Registered Taxonomy</li>';
            }
            ?>
            </ul>
          </div>
        </div>
      </div>
      
      <div class="rp-box">
        <div class="rp-box-wrap">
          <div class="rp-box-title">Shortcode</div>
          <div class="rp-box-text">
            <p>Use <a href="https://codex.wordpress.org/Function_Reference/do_shortcode" title="do_shortcode" target="_blank">do_shortcode()</a> function if the shortcode is not working.</p>
            <div class="column">
              <div class="column-label column-item"><em>default</em></div>
              <div class="column-field column-item">[RPPostNav]</div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </form>

</div>