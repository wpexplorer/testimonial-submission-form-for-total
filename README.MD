=== Testimonial Submission Form for Total ===
Contributors: wpexplorer
Tags: testimonials, testimonial form, front-end submission, reviews
Requires at least: 6.0
Tested up to: 6.8
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Adds a front-end form so visitors can submit testimonials, saved as unpublished entries for you to review.

== Description ==

The Total WordPress theme includes a Testimonials post type, but testimonials can only be added from the admin. This plugin adds a front-end form so your visitors can submit their own.

Submissions are saved as unpublished entries in the Testimonials post type, so nothing appears on your site until you approve it.

Drop the form anywhere with a shortcode:

`[testimonial_form]`

If you use WPBakery Page Builder, a Testimonial Form module is available instead.

= Features =

* Front-end testimonial submission form
* Fields for title, name, company, URL, rating and content
* Turn individual fields on or off per form
* Custom labels for every field
* Custom submit button text and success message
* Configurable maximum rating
* Filters for developers to adjust the CSS, required fields, and submission status

= Requirements =

This plugin extends the Testimonials post type provided by the Total WordPress theme and requires Total to be installed.

== Installation ==

1. Upload the plugin folder to `/wp-content/plugins/`, or install it through Plugins > Add New.
2. Activate the plugin through the Plugins menu.
3. Add the `[testimonial_form]` shortcode to any page, post or widget.

== Frequently Asked Questions ==

= Where do submitted testimonials go? =

They are saved as unpublished entries in the Testimonials post type. Review and publish them from the admin.

= Can I remove a field from the form? =

Yes. Set the matching parameter to anything other than "on", for example `[testimonial_form field_title="off"]`.

= Can I change the field labels? =

Yes, using the label parameters, for example `[testimonial_form label_title="Testimonial Title"]`.

= Can I style the form myself? =

Yes. Return false on the `ttf_css` filter to stop the plugin's stylesheet from loading.

= Does this work without the Total theme? =

No. It extends the Testimonials post type that Total provides.

== Changelog ==

= 1.0.0 =
* Initial release.
