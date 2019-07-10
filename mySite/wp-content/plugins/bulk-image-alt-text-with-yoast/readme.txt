=== Auto image alt text (Alt tag, Alt attribute) optimizer for Google images - SEO booster + WooCommerce ===
Contributors: the-rock, freemius
Tags: Alt Text, Alt Attribute, Alt tag, Google images, SEO
Requires at least: 4.1
Requires PHP: 5.2.4
Tested up to: 5.2
WC tested up to: 3.5.1
Stable tag: 1.2.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Auto optimize all image alt texts on website (and Woocommerce online store), per page & product, from Yoast SEO optimization settings (keywords).

== Description ==

**A quick overview**

https://vimeo.com/306421381

Bialty automatically adds ALT TEXTs to your images from page/article/product titles (with Woocommerce for online store) or Yoast’s Focus Keywords, separately or combined (depending on your needs). BIALTY also allows, via a Post META Box, manual customization on your pages, with the use of ALT TEXTs other than those used with Yoast or page titles.

BIALTY works in automatic mode. Once installed, it will be active on all pages of your site, retroactively and for future content. You no longer have to think about your Alt Texts.

**Also compatible with:** TinyMCE, Page Builder by SiteOrigin, Elementor Page Builder, Gutenberg and more…

**SUPPORTED IN 6 LANGUAGES**

BIALTY plugins are translated and available in: English, French – Français, Russian –Руссɤɢɣ, Portuguese – Português, Spanish – Español, German – Deutsch

**Why should you optimize your image Alt Texts? Because more than 20% of search queries are made on Google Images. Check [here](https://sparktoro.com/blog/new-jumpshot-2018-data-where-searches-happen-on-the-web-google-amazon-facebook-beyond/)**

**Alternate text** (Alt text) is a text description that can be added to an image's HTML tag on a Web page. It is used when the image in the Web page cannot be displayed, in which case the Alt text is shown instead. It is also displayed when a user mouses over the image.

Unfortunately, the **ALT attribute** is a critical step that is often overlooked. 

Have you ever been in the situation where you have hundreds or thousands of images on your website without any alt tags? You know by definition that it will hurt your Google ranking in some way, especially when YOAST SEO keeps reminding you that « All the images on this page do not contain ALT attributes with the focus keyword ». This can be a lost opportunity for better rankings on search engines.

Of course, you could add these alts tags manually (and spend dozens of hours doing it) or use other WordPress plugins auto-adding the product/page/post title or image name/title as ALT texts (with « _ » which are not SEO-friendly, by the way), but they still won’t be the best ALT attributes to be added to your images and Yoast will keep displaying this orange/red spot reminding you that you HAVE NOT DONE the job as you should. And for good reason, because Alt tags strengthen the message of your articles with search engine spiders (which cannot determine the content of images and must rely on Alt text to determine their contents) and improves the accessibility of your website.

**BIALTY is a time-saver** because it uses this « Focus Keyword » determined (by you) when optimizing your page/post/product with YOAST SEO (and optionally the page title) as ALT texts for all images contained on this page/post/product. Once your keyword is added in the « Focus keyword » field, after saving your settings, it will add it automatically to the image’s HTML tags  of your page : <img src=“image.jpg” alt=“Focus Keyword” >. Simple & efficient …

For your information, Google’s article about images has a heading “Create great alt text”. This is no coincidence because Google places a relatively high value on alt text to determine not only what is on the image but also the topic of the surrounding text. 
(https://support.google.com/webmasters/answer/114016?hl=en )

**How does it work?**

Install BIALTY on your website, select your preferred option either « Only YOAST Focus Keyword » or « YOAST Focus Keyword + Page/post/product title », after saving, BIALTY will add ALT Texts to all images, on each page, according to your optimization. 

Then, simply forget about it …

**Best practices?**

The text (keyword) should be kept short to maximize its impact. Shorter alt texts (thus keywords) are also more likely to be indexed by Google and the other major online search engines in a more efficient manner (please read our FAQ for more info)


== Installation ==

= Installing manually =

1. Unzip all files to the `/wp-content/plugins/bulk-image-alt-text-with-yoast` directory
2. Log into WordPress admin and activate the 'BIALTY - Bulk Image Alt Text (Alt tag, Alt Attribute) with Yoast SEO + WooCommerce' plugin through the 'Plugins' menu
3. Go to "Settings > Bulk Image Alt Text" in the left-hand menu to start work on it.

== Frequently Asked Questions ==

= What is alt text? =
Alt text (alternative text), also known as "alt attributes", “alt descriptions,” and technically incorrectly as "alt tags,” are used within an HTML code to describe the appearance and function of an image on a page.

= How to use Alt text: =
• Adding alternative text to photos is first and foremost a principle of web accessibility. Visually impaired users using screen readers will be read an alt attribute to better understand an on-page image.
• Alt tags will be displayed in place of an image if an image file cannot be loaded.
• Alt tags provide better image context/descriptions to search engine crawlers, helping them to index an image properly.

= Appropriate length? =
Google seemed to count the first 16 words in the ALT tag and interestingly in the snippet Google uses, it does seem to completely cut off the rest of the ALT and from the 17th word. Having 16 words to work with might prove very useful if you are using ALT tags to describe more complex images. There is potentially plenty of available space to describe images properly for accessibility purposes AND SEO impact.

= How Image Alt Tags and Meta Data Help SEO =
Optimizing your images for SEO helps crawlers better index your web pages, which in turn can give you a rankings boost because it can make the page more relevant to users. Let’s say a searcher needs plumber repairs for a clogged bathroom drain. Google has to choose between two web pages from different companies, both of which have equal ranking factors. As the crawler reads through the first page, it doesn’t identify any image alt-tags, therefore, it assumes the images (if there are any) do not add page-specific value. On the second page, however, the crawler locates five images, each one with a full description of what the image is showing. All five images’ alt tags supplement the rest of the text on the page. Since Google is all about spitting out the results you’ll most likely jive with, it’s going to go with the article that it thinks is more relevant.


== Screenshots ==

1. Bulk Image Alt Text Settings Page
2. Bulk Image Alt Text Settings Page

== Changelog ==

= 1.0.0 =
* Initial release.

= 1.0.1 =
* Fixed an error and translation issues.

= 1.0.2 =
* Added SEO recommendations and tools
* Fixed text errors

= 1.1.0 =
* Added custom alt text option for individual posts, pages and woocommerce products
* Disable BIALTY for individual posts, pages and woocommerce products
* Add website title at the end of yoast focus keyword, post title or both.

= 1.2.0 =
* Added Support for Popular Page Builders (WPBakery Page Builder, Elementor, Site Origin, Divi...)
* Added Support for Popular sliders (Revolution Slider, Layer Slider and other free sliders)
* Improved code, fixed errors

= 1.2.1 =
* Fixed notices time upto 4 months after dismiss
* Boost your ranking on Search engines with optimized robots.txt

= 1.2.2 =
* Fixed a major issue with cache plugins.
* Code improvement

= 1.2.4 =
* Update Freemius SDK to latest release v2.3.0
* Imroved code and fixed security
* BIGTA recommedation notification
* Updated all translations

= 1.2.5 =
* Fixed bug when post title start with a number, leave images broken