<?php
# ------------------------------------------
# ADD SCRIPTS - 
# ------------------------------------------
add_action( 'wp_enqueue_scripts', 'theming_scripts' );
function theming_scripts() {

    // CSS
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri() );
}

# ------------------------------------------
# ADD more than one google font
# ------------------------------------------

add_action( 'wp_enqueue_scripts', 'get_google_fonts' );
function get_google_fonts() {
    wp_enqueue_style( 'get-font-1', 'https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap', false );
    wp_enqueue_style( 'get-font-2', 'https://fonts.googleapis.com/css2?family=Special+Elite&display=swap', false );
}



# ------------------------------------------
# # remove smilies/emoticon 
# ------------------------------------------
add_filter('option_use_smilies','cb_remove_smileys',99,1);
function cb_remove_smileys($bool) {
  return false;
}





# ------------------------------------------
# REGISTER SITE MENUS - not yet used footer nav
# ------------------------------------------
if (function_exists( 'add_theme_support' )) {
	register_nav_menus(
	    array(
	        'sitenav' => __( 'Site nav' ),
	        'footnav' => __( 'Footer nav' )
	    )
	);
}




# ------------------------------------------
# REGISTER SIDEBARS
# ------------------------------------------
create_sidebar( 'Sidebar', 'sidebar', 'Main site sidebar', 'site-widget' );
function create_sidebar( $name, $id, $description, $class ) {
    register_sidebar(array(
        'name' => __( $name ),
        'id' => $id,
        'description' => __( $description ),
        'before_widget' => '<div id="%1$s" class="'. $class .' %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widget--title">',
        'after_title' => '</h3>'
    ));
}






# ------------------------------------------
# add custom posts to list of posts for template hierachy views
# ------------------------------------------

add_action( 'pre_get_posts', 'add_my_post_types_to_query' );
  
function add_my_post_types_to_query( $query ) {
    if ( is_home() && $query->is_main_query() )
        $query->set( 'post_type', array( 'post', 'maker-profile' , 'product' , 'event') );
    return $query;
}


# ------------------------------------------
# add meta descriptions
# ------------------------------------------

add_action('wp_head', 'add_meta_description');
function add_meta_description() {

        //about us
        if (is_page('about-us')){
            echo '<title>About Us | Woolwich Makers Market</title>';
        echo '<meta name="description" content="The history of Woolwich Makers Market, how it started, how to get in touch and any other useful details">';
        }

        //home
        elseif (is_front_page()){
            echo '<title>Home | Woolwich Makers Market</title>';
            echo '<meta name="description" content="Woolwich Makers Market connects you to handmade products, made by someone in South East London. Find us at our next market, or have a browse on our website">';
            }

        //archive post
        elseif (is_post_type_archive()){
            echo '<meta name="description" content="Browse our website to find information about makers in your area, or have a look through their products. You can also find them at our next market event">';
        }

        //single-post
        elseif (get_post_type(get_the_ID()) == 'maker-profile'){
           
            echo '<meta name="description" content="'; echo the_field('meta-description'); echo ' ">';
        }

        //single-post
		elseif (get_post_type(get_the_ID()) == 'product'){
        echo '<meta name="description" content="'; echo the_field('meta-description'); echo ' ">';
        }
        //show if nothing 
        else {
            echo '<meta name="description" content="Woolwich Makers Market connects you to handmade products, made by someone in South East London. Find us at our next market, or have a browse on our website">';
        }
        
}
