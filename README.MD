# Testimonial Submission Form for Total WordPress Theme

Adds a front-end form so visitors can submit their own testimonials on a site running the [Total WordPress theme](https://totalwptheme.com/). Submissions are saved as unpublished entries in Total's Testimonials post type for you to review before they go live.

## Download

**[Download testimonial-submission-form-for-total.zip](https://github.com/wpexplorer/testimonial-submission-form-for-total/releases/latest/download/testimonial-submission-form-for-total.zip)**

> [!IMPORTANT]
> Use the link above, not the green **Code → Download ZIP** button. GitHub names that archive after the repository *and* the branch, so you'd end up with a plugin folder called `testimonial-submission-form-for-total-master`. WordPress tracks active plugins by folder name, so installing the correctly named version later would leave you with two copies in your plugins list.

## Requirements

- WordPress
- The Total theme, with the Testimonials post type enabled

## Installation

1. Go to **Plugins → Add New → Upload Plugin**.
2. Choose the zip, click **Install Now**, then **Activate**.

Or unzip and upload the `testimonial-submission-form-for-total` folder to `wp-content/plugins/`.

### Updating

This plugin does not check for or install updates automatically. WordPress won't tell you when a new version is out, so you'll need to update it yourself: download the latest zip, then either upload it again through **Plugins → Add New → Upload Plugin** (WordPress will ask if you want to replace the existing version) or overwrite the folder over FTP.

To hear about new versions, click **Watch → Custom → Releases** at the top of this repository.

## Usage

Add the shortcode anywhere on your site:

```
[testimonial_form]
```

If you're using WPBakery, there's a **Testimonial Form** module you can drop in instead.

## Shortcode parameters

### Fields

Set any of these to something other than `on` to remove that field from the form.

| Parameter | Field |
| --- | --- |
| `field_title` | Title |
| `field_name` | Name |
| `field_company` | Company |
| `field_url` | URL |
| `field_rating` | Rating |
| `field_content` | Content |

```
[testimonial_form field_title="off"]
```

### Labels

Override the default label text for any field.

`label_title`, `label_name`, `label_company`, `label_url`, `label_rating`, `label_content`

```
[testimonial_form label_title="Testimonial Title"]
```

### Other

| Parameter | Description |
| --- | --- |
| `rating_max` | Highest number available in the rating field. Default `5`. |
| `content_rows` | Rows for the content textarea. |
| `content_cols` | Columns for the content textarea. |
| `submit` | Custom text for the submit button. |
| `success_message` | Custom confirmation message. Set to empty to disable. |

## Filters

Add these to your child theme's `functions.php`.

**`ttf_css`** — boolean, default `true`. Return false to stop the plugin's CSS from loading so you can style the form yourself.

```php
add_filter( 'ttf_css', '__return_false' );
```

**`ttf_post_content_required`** — boolean, default `true`. Return false to make the testimonial content optional.

**`ttf_new_status`** — the post status given to new submissions. Default is `pending`.

```php
add_filter( 'ttf_new_status', function() {
	return 'draft';
} );
```

## Support

Questions about this plugin go through the [Total support system](https://my.totalwptheme.com/).

## License

GPLv2 or later.
