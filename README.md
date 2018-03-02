# wordpress_cutom_thumb_url
Automatically rezise a thumbnail and insert as post attachment

Use:

inside the functions.php file, enter the line below:

require_once('auto_image_size.php');

This code works as wordpress function get_the_post_thumbnail_url(int|WP_Post $post = null, string|array $size = 'post-thumbnail')

but with one difference, it will create the thumbnail in runtime if not exists

in your code call:

auto_image_size(int|WP_Post $post = null, string|array $size = 'post-thumbnail',int $width, int $height,$crop = true);

# example
The code below create a thumbnail with 300 pixel width and 300 pixel height
echo auto_image_size(null,'my-post-size-name',300,300);