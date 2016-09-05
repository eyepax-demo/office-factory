<?php

    class EpxSocialProfiles_Widget extends WP_Widget {
        private $social_profiles;

        function __construct() {
            parent::__construct(
                'epx_social_sharing_widget', // ID
                __('Eyepax Social Profiles Widget', 'epx-social-profiles'), //Name
                array('description' => __('Widget to display social profiles.', 'epx-social-profiles')) //Args
            );

            // Available social profiles
            $this->social_profiles = [
                'epx_ss_facebook_url' => [
                    'name' => __('Facebook', 'epx-social-profiles'),
                    'icon' => 'fa fa-facebook',
                    'sample_link' => 'https://www.facebook.com/Eyepax/'
                ],
                'epx_ss_twitter_url'  => [
                    'name' => __('Twitter', 'epx-social-profiles'),
                    'icon' => 'fa fa-twitter',
                    'sample_link' => 'https://twitter.com/eyepax'
                ],
                'epx_ss_linkedin_url' => [
                    'name' => __('LinkedIn', 'epx-social-profiles'),
                    'icon' => 'fa fa-linkedin',
                    'sample_link' => 'https://www.linkedin.com/company/eyepax'
                ]
            ];
        }

        public function widget($args, $instance) {
            $title = apply_filters('widget_title', $instance['title']);

            echo $args['before_widget'];

            if (!empty($title)) {
                echo '<h3 class="widget-title">' . $title . '</h3>';
            }

            echo '<div class="epx-social-profiles-container">';

            foreach ($this->social_profiles as $key => $profile) {
                $profile_link = apply_filters('widget_title', $instance[$key]);

                if (!empty($profile_link) && is_url($profile_link)) {
                    echo '<a class="epx-ss-profile-icon" href="' . $profile_link . '" target="_blank" title="' . $profile['name'] . '">' .
                        '<i class="' . $profile['icon'] . ' custom-profile-icon" aria-hidden="true"><span class="fix-editor">&nbsp;</span></i>' .
                        '</a>';
                }
            }

            echo '</div>';
            echo $args['after_widget'];
        }

        public function form($instance) {
            if (isset($instance['title'])) {
                $title = $instance['title'];
            } else {
                $title = __('', 'epx-social-profiles');
            }
            ?>
            <p>
                <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'epx-social-profiles'); ?></label>
                <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
            </p>
            <?php
            foreach ($this->social_profiles as $key => $profile) {
                if (isset($instance[$key])) {
                    $profile_link = $instance[$key];
                } else {
                    $profile_link = __('', 'epx-social-profiles');
                }
                ?>
                <p>
                    <label for="<?php echo $this->get_field_id($key); ?>"><?php echo $profile['name'] . ' ' . __('Link:', 'epx-social-profiles'); ?></label>
                    <span class="description"><?php echo __('Example: ') . $profile['sample_link']; ?></span>
                    <input class="widefat" id="<?php echo $this->get_field_id($key); ?>" name="<?php echo $this->get_field_name($key); ?>" type="text" value="<?php echo esc_attr($profile_link); ?>">
                </p>
                <?php
            }
        }

        public function update($newInstance, $oldInstance) {
            $instance = array();
            $instance['title'] = (!empty($newInstance['title'])) ? strip_tags($newInstance['title']) : '';

            foreach ($this->social_profiles as $key => $profile) {
                $instance[$key] = (!empty($newInstance[$key])) ? strip_tags($newInstance[$key]) : '';
            }

            return $instance;
        }
    }

    /**
     * Register Widget.
     */
    function register_eyepax_social_sharing_widget() {
        register_widget('EpxSocialProfiles_Widget');
    }

    add_action('widgets_init', 'register_eyepax_social_sharing_widget');