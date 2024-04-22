# Helper Functions

The plugin contains multiple helpers functions to easily create an instance of the class or fetch the data without the lengthy code snippets.


## Global Functions
These functions are accessible globally without a namespace

| Function | code | WP Hook | Description |
| --- | --- | --- | --- |
| hyvid_post_filters | `hyvid_post_filters()` | `hyvid/post/filters` | Return the list of post filters |
| hyvid_post_order_options | `hyvid_post_order_options()` | `hyvid/post/orders` | Return post orders list |
| hyvid_post_range_options | `hyvid_post_range_options()` | `hyvid/post/date-range` | Return the list of post date range |
| hyvid_load_template | `hyvid_load_template( $template, $args = [], $return_output = false )` | N/A | Load Plugin template file |
| hyvid_locate_template | `hyvid_locate_template( $template )` | N/A | Locate plugin template file checks in CHILD THEME / THEME / Plugin directories

## Core Functions
These are the plugin core functions
| Function | code | Description |
| --- | --- | --- |
| load_template | `HyVid\load_template( $template, $vars = [], $return_output = false)` | Load a template file |
| locate_template | `HyVid\locate_template( $template )` | Locate template file in theme or plugin |
| get_option | `hyvid_get_option( $data, $option_name = null, $default = null )` | Find the key value in an array - if the value is not available then return the default value |
| enqueue_files | `HyVid\enqueue_files()` | Enqueue Plugin Style and Scripts files on pages if Elementor is not working |

## Video Filters
| Function | code | WP Hook | Description |
| --- | --- | --- | --- |
| video_meta_fields | `HyVid\video_meta_fields()` | `hyvid/video/meta_fields` | Fetch the video meta fields list |
| video_meta_fields_keys_array | `HyVid\video_meta_fields_keys_array()` | NA | Return the array keys of `video_meta_field` function |
| video_post_actions | `HyVid\video_post_actions()` | `hyvid/video/post_actions` | Fetch the video post actions list |
| video_post_actions_keys_array | `HyVid\video_post_actions_keys_array()` | NA | Return the array keys of `video_post_actions` function |

## Video Helper Functions
| Function | code | Description |
| --- | --- | --- |
| get_video | `HyVid\get_video( $video_id )` | Return the wrapped WP Post instance |
| get_video_object | `HyVid\get_video_object()` | Return the wrapped WP Post instance of current post in while loop - if the post type is `hyvid-post` this function calls the above `get_video` function |
| get_videos | `HyVid\get_videos( $wp_query_args )` | Return the wrapped WP Post objects for the list of videos, the post type must be `hyvid-post` and this function calls the above get_video |

## HTML Functions
Read the [template](template.md) section for available HTML functions