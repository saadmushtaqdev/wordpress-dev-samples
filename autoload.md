# Autoload PHP classes

The `spl_autoload_register` method in `hyvid/index.php` allows to dynamically load the PHP classes

## Prerequisite / Standards

1. The namespace of the file should be `namespace HyVid`
2. The directory name must be included without PHP extension e.g. `new Includes/video`. The `includes` is a directory name whereas `video` is a PHP file `video.php`
3. All file or directory names must follow the WordPress standards in naming and seperated by using the hyphn (-) sign e.g. `my-php-library.php` and the name of the class must have _ instead of the - sign. e.g. `class My_PHP_Library`

## Libraries
There are two types of libraries

1. Core Libraries
2. Extension Libraries

### Core Libraries
The core libraries are the one included in the core version of the plugin in `includes` directory

### Extension Libraries
The extension libraries are included in the extension bundle and available at `extensions/EXTENSION_NAME/LIBRARY`

## How to initialize a core library
The core libraries are being initialized in `hyvid/index.php` under load_core_libs method e.g. `new Integrations\Acf\ACF_Handler`. You should be responsible to execute code by using WordPress hooks in your libraries.

## List of Abstracts classes
| Class Name | Extends | File Path | Description |
| --- | --- | --- | --- |
| Callbacks | No | abstracts/callbacks.php | A class to dynamically register the child class methods useful when you want to extend functionality through extensions |
| Dynamic_Data | No | abstracts/dynamic-data.php | Load the dynamic data by using the callback methods / functions |
| Post_Meta_Data | No | abstracts/post-abstract.php | Loads the post post data |
| Post_Abstract | Callbacks | abstracts/post-meta-data.php | Methods to fetch the current post data |

## List of Core Libraries / Classes
| Class Name | Extends | File Path | Description |
| --- | --- | --- | --- |
| Query | No | includes/query.php | A WordPress `WP_Query` wrapper for `hyvid-post` post type |

## List of Video Libraries
| Class Name | Extends | File Path | Description |
| --- | --- | --- | --- |
| Video | No | includes/video/video.php | Responsible to handle / load all video related functionality |
| Video_POST | No | includes/video/video-post.php | Registers WordPress custom post type `hyvid-post` |
| Video_Taxonomies | No | includes/video/video-taxonomies.php | Registers custom taxonomies `categories` and `tags` for `hyvid-post` post type |
| Video_Object | Abstract Post_Abstract | includes/video/video-object.php | Alternate to WordPress post object with custom methods to get the video post data |
| Video_Post_Actions | Abstract Post_Meta_Data | includes/video/video-post-actions.php | The frontend actions to be performed against a video |
| Video_Meta_data | Abstract Post_Meta_Data | includes/video/video-meta-data.php | Fetch the video meta data, this class is being used by `video_object` class |
