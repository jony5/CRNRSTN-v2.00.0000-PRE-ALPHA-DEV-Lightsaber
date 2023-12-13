<?php
/**
* @package CRNRSTN

// J5
// Code is Poetry */
# # C # R # N # R # S # T # N # : : # # # #
#
#        CRNRSTN :: An open source PHP class library supporting enterprise application development that is framed within
#                   the context of mature/rigid RTM protocols.
#        VERSION :: 2.00.0000 PRE-ALPHA-DEV (Lightsaber)
#      TIMESTAMP :: Tuesday, November 28, 2023 @ 16:20:00.065620.
#  DATE (v1.0.0) :: July 4, 2018 - Happy Independence Day from my dog and I to you...wherever and whenever you are.
#         AUTHOR :: Jonathan 'J5' Harris, CEO, CTO, Lead Full Stack Developer, jharris@eVifweb.com, J00000101@gmail.com.
#            URI :: http://crnrstn.evifweb.com/
#       OVERVIEW :: CRNRSTN :: An Open Source PHP Class Library that stands on top of a robust web services oriented
#                   architecture to both facilitate, augment, and enhance (with stability) the operations of a code base
#                   for a web application across multiple hosting environments.
#
#                   Copyright (c) 2012-2024 :: eVifweb development :: All Rights Reserved.
#    DESCRIPTION :: CRNRSTN :: is an open source PHP class library that will facilitate and spread (via SOAP services)
#                   operations of a web application across multiple servers or environments (e.g. localhost, stage,
#                   preprod, and production). With this tool, data and functionality possessing characteristics that
#                   inherently create distinctions between one environment and another can all be managed through one
#                   framework for an entire application. IP address restrictions, error logging profiles, and database
#                   authentication credentials are a few areas within an application's architecture where
#                   CRNRSTN :: was designed to excel.
#
#                   Once CRNRSTN :: has been configured to support all of a web application's running servers, one can
#                   seamlessly RTM the codebase of the web site without having to modify the configuration to account
#                   for any unique and environmentally specific parameters. Receive the benefit of a robust and polished
#                   framework that will bubble up logs from exception notifications to any output channel (email, hidden
#                   HTML comment, native default,...etc.) of one's own choosing.
#
#                   Stand on top of the CRNRSTN :: SOAP Services Layer to, for example, organize and strengthen the
#                   communications architecture of any web application. By supporting many-to-one proxy messaging
#                   relationships between slaves and a master "communications server", CRNRSTN :: can streamline and
#                   simplify the management of web application communications; one can configure everything from SMTP
#                   credentials to the character count for line wrapping in the text versions of multi-part HTML email.
#
#                   This is the "King's Highway" for sending email communications.
#        LICENSE :: MIT
#                   Permission is hereby granted, free of charge, to any person obtaining
#                   a copy of this software and associated documentation files (the
#                   "Software"), to deal in the Software without restriction, including
#                   without limitation the rights to use, copy, modify, merge, publish,
#                   distribute, sublicense, and/or sell copies of the Software, and to
#                   permit persons to whom the Software is furnished to do so, subject to
#                   the following conditions:
#
#                   The above copyright notice and this permission notice shall be
#                   included in all copies or substantial portions of the Software.
#
#                   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
#                   EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
#                   MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
#                   IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY
#                   CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
#                   TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
#                   SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
#
# # C # R # N # R # S # T # N # : : # # # #
#
//
/*
NOTE:
HTML_HEAD_META - This content goes to pages that call $oCRNRSTN->system_output_head_html() in the HTML <HEAD>.
HTML_HEAD_CRNRSTN_META - This content supports CRNRSTN :: Lightsaber deep links for documentation.

*/

$meta_ARRAY = array();
$tmp_data_type_family = 'CRNRSTN::RESOURCE::GENERAL_SETTINGS::META';

//
// META :: FAVICON.
//$meta_str = '<link rel="shortcut icon" type="image/x-icon" href="https://lightsaber.crnrstn.jony5.com/?crnrstn_0010111011=crnrstn/favicon.ico&crnrstn_=420.00" />';
//$meta_str = $this->return_creative('CRNRSTN_FAVICON', CRNRSTN_FAVICON);
//error_log(__LINE__ . ' settings $meta_str[' . $meta_str . '].');
//$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);

//
// META :: CONTENT TYPE.
$meta_str = '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);

//
// META :: DISTRIBUTION.
$meta_str = '<meta name="distribution" content="global"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);

//
// META :: ROBOTS.
$meta_str = '<meta name="robots" content="index,follow"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);

//
// META :: VIEWPORT.
$meta_str = '<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);

//
// META :: GLOBAL SOCIAL PROFILE.
$meta_ARRAY[] = '<meta property="og:type" content="website"/>';
$meta_ARRAY[] = '<meta property="og:title" content=""/>';
$meta_ARRAY[] = '<meta property="og:description" content=""/>';
$meta_ARRAY[] = '<meta property="og:url" content=""/>';
$meta_ARRAY[] = '<meta property="og:site_name" content=""/>';
//$meta_ARRAY[] = '<meta property="article:publisher" content="https://www.facebook.com/react"/>';
$meta_ARRAY[] = '<meta property="og:image" content=""/>';
$meta_ARRAY[] = '<meta property="og:image:secure_url" content=""/>';
$meta_ARRAY[] = '<meta name="twitter:card" content="summary"/>';
$meta_ARRAY[] = '<meta name="twitter:description" content=""/>';
$meta_ARRAY[] = '<meta name="twitter:title" content=""/>';
$meta_ARRAY[] = '<meta name="twitter:image" content=""/>';
//$meta_ARRAY[] = '<meta name="twitter:creator" content="@j00000101"/>';

//$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_ARRAY, $tmp_data_type_family);
// UNCOMMENT AND COMPLETE THE ABOVE TO ACTIVATE THIS SOCIAL META.

//
// META :: GLOBAL WEBSITE DESCRIPTION.
$meta_str = '<meta name="description" content="' . $this->proper_version() . ' :: ADD GLOBAL META DESCRIPTION HERE."/>';
//$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);
// UNCOMMENT AND COMPLETE THE ABOVE TO ACTIVATE THIS META.

//
// META :: GLOBAL WEBSITE KEYWORDS.
$meta_str = '<meta name="keywords" content="' . $this->proper_version() . ' :: ADD GLOBAL KEY WORDS."/>';
//$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_META', $meta_str, $tmp_data_type_family);
// UNCOMMENT AND COMPLETE THE ABOVE TO ACTIVATE THIS SOCIAL META.

//
// # # C # R # N # R # S # T # N # : : # # # #
// CRNRSTN :: Lightsaber META CONFIGURATION
//
// META :: FAVICON.
$meta_str = $this->return_creative('CRNRSTN_FAVICON', CRNRSTN_FAVICON);
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_str, $tmp_data_type_family);

//
// CRNRSTN :: META :: DISTRIBUTION.
$meta_str = '<meta name="distribution" content="global"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_str, $tmp_data_type_family);

//
// CRNRSTN :: META :: ROBOTS.
$meta_str = '<meta name="robots" content="index,follow"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_str, $tmp_data_type_family);

//
// CRNRSTN :: META :: VIEWPORT.
$meta_str = '<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_str, $tmp_data_type_family);

//
// META :: CRNRSTN :: SYSTEM SOCIAL PROFILE.
//$meta_CRNRSTN_ARRAY[] = '<link rel="canonical" href={DEEP-LINK-INTEGRATION}" />';
$meta_CRNRSTN_ARRAY[] = '<meta property="og:type" content="website"/>';
$meta_CRNRSTN_ARRAY[] = '<meta property="og:title" content="' . $this->social_preview_title() . '"/>';
$meta_CRNRSTN_ARRAY[] = '<meta property="og:description" content="' . $this->social_preview_description() . '"/>';
$meta_CRNRSTN_ARRAY[] = '<meta property="og:url" content="' . $this->current_location() . '"/>';
$meta_CRNRSTN_ARRAY[] = '<meta property="og:site_name" content="' . $this->proper_version() . '"/>';
//$meta_CRNRSTN_ARRAY[] = '<meta property="article:publisher" content="https://www.facebook.com/react"/>';
//$meta_CRNRSTN_ARRAY[] = '<meta property="og:image" content="' . $this->return_creative('SOCIAL_META_PREVIEW', CRNRSTN_STRING) . '"/>';
//$meta_CRNRSTN_ARRAY[] = '<meta property="og:image:secure_url" content="' . $this->return_creative('SOCIAL_META_PREVIEW', CRNRSTN_STRING) . '"/>';
$meta_CRNRSTN_ARRAY[] = '<meta name="twitter:card" content="summary"/>';
$meta_CRNRSTN_ARRAY[] = '<meta name="twitter:description" content="' . $this->social_preview_description() . '"/>';
$meta_CRNRSTN_ARRAY[] = '<meta name="twitter:title" content="' . $this->social_preview_title() . '" />';
//$meta_CRNRSTN_ARRAY[] = '<meta name="twitter:image" content="' . $this->return_creative('SOCIAL_META_PREVIEW', CRNRSTN_STRING) . '"/>';
$meta_CRNRSTN_ARRAY[] = '<meta name="twitter:creator" content="@CRNRSTN_v2_0_0"/>';

$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_CRNRSTN_ARRAY, $tmp_data_type_family);

$meta_str = '<meta name="description" content="' . $this->social_preview_description() . '"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_str, $tmp_data_type_family);

$meta_str = '<meta name="keywords" content="' . $this->crnrstn_meta_keywords() . '"/>';
$this->config_add_resource(CRNRSTN_RESOURCE_ALL, 'HTML_HEAD_CRNRSTN_META', $meta_str, $tmp_data_type_family);

/*
Basic HTML Meta Tags
https://gist.github.com/lancejpollard/1978404#basic-html-meta-tags
<meta name="keywords" content="your, tags"/>
<meta name="description" content="150 words"/>
<meta name="subject" content="your website's subject">
<meta name="copyright"content="company name">
<meta name="language" content="ES">
<meta name="robots" content="index,follow" />
<meta name="revised" content="Sunday, July 18th, 2010, 5:15 pm"/>
<meta name="abstract" content="">
<meta name="topic" content="">
<meta name="summary" content="">
<meta name="Classification" content="Business">
<meta name="author" content="name, email@hotmail.com">
<meta name="designer" content="">
<meta name="copyright" content="">
<meta name="reply-to" content="email@hotmail.com">
<meta name="owner" content="">
<meta name="url" content="http://www.websiteaddrress.com">
<meta name="identifier-URL" content="http://www.websiteaddress.com">
<meta name="directory" content="submission">
<meta name="category" content="">
<meta name="coverage" content="Worldwide">
<meta name="distribution" content="Global">
<meta name="rating" content="General">
<meta name="revisit-after" content="7 days">
<meta http-equiv="Expires" content="0">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache">

OpenGraph Meta Tags
https://gist.github.com/lancejpollard/1978404#opengraph-meta-tags
<meta name="og:title" content="The Rock"/>
<meta name="og:type" content="movie"/>
<meta name="og:url" content="http://www.imdb.com/title/tt0117500/"/>
<meta name="og:image" content="http://ia.media-imdb.com/rock.jpg"/>
<meta name="og:site_name" content="IMDb"/>
<meta name="og:description" content="A group of U.S. Marines, under command of..."/>

<meta name="fb:page_id" content="43929265776" />

<meta name="og:email" content="me@example.com"/>
<meta name="og:phone_number" content="650-123-4567"/>
<meta name="og:fax_number" content="+1-415-123-4567"/>

<meta name="og:latitude" content="37.416343"/>
<meta name="og:longitude" content="-122.153013"/>
<meta name="og:street-address" content="1601 S California Ave"/>
<meta name="og:locality" content="Palo Alto"/>
<meta name="og:region" content="CA"/>
<meta name="og:postal-code" content="94304"/>
<meta name="og:country-name" content="USA"/>

<meta property="og:type" content="game.achievement"/>
<meta property="og:points" content="POINTS_FOR_ACHIEVEMENT"/>

<meta property="og:video" content="http://example.com/awesome.swf" />
<meta property="og:video:height" content="640" />
<meta property="og:video:width" content="385" />
<meta property="og:video:type" content="application/x-shockwave-flash" />
<meta property="og:video" content="http://example.com/html5.mp4" />
<meta property="og:video:type" content="video/mp4" />
<meta property="og:video" content="http://example.com/fallback.vid" />
<meta property="og:video:type" content="text/html" />

<meta property="og:audio" content="http://example.com/amazing.mp3" />
<meta property="og:audio:title" content="Amazing Song" />
<meta property="og:audio:artist" content="Amazing Band" />
<meta property="og:audio:album" content="Amazing Album" />
<meta property="og:audio:type" content="application/mp3" />

= = = = = = = = =
= = = = = = = = = JONY5.COM PROD META
<meta name="distribution" content="Global" />

<meta name="ROBOTS" content="index, follow" />
<meta name="ROBOTS" content="follow" />

<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:description" content="" />
<meta property="og:type" content="website"/>

<meta name="twitter:card" content="summary"/>
<meta name="twitter:title" content=""/>
<meta name="twitter:image" content=""/>
<meta name="twitter:description" content="" />

<meta name="description" content="" />
<meta name="keywords" content="jesus, christ, jesus christ, gospel, j5, jonathan, harris, jonathan
harris, johnny 5, jony5, atlanta, moxie, agency, web, christian, web services, email, web
programming, marketing, CSS, XHTML, php, ajax" />

= = = = = = = = =
= = = = = = = = = TWITTER SOCIAL
https://developer.twitter.com/en/docs/twitter-for-websites/cards/guides/getting-started

<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="@nytimesbits" />
<meta name="twitter:creator" content="@nickbilton" />
<meta property="og:url" content="http://bits.blogs.nytimes.com/2011/12/08/a-twitter-for-my-sister/" />
<meta property="og:title" content="A Twitter for My Sister" />
<meta property="og:description" content="In the early days, Twitter grew so quickly that it was
almost impossible to add new features because engineers spent their time trying to keep the rocket
ship from stalling." />
<meta property="og:image" content="http://graphics8.nytimes.com/images/2011/12/08/technology/bits-newtwitter/bits-newtwitter-tmagArticle.jpg" />

URL Crawling & Caching
Twitter’s crawler respects Google’s robots.txt specification when scanning URLs. If a page with card
markup is blocked, no card will be shown. If an image URL is blocked, no thumbnail or photo will
be shown.

Twitter uses the User-Agent of Twitterbot (with version, such as Twitterbot/1.0), which can be used
to create an exception in the robots.txt file.

For example, here is a robots.txt which disallows crawling for all robots, except Twitter’s fetcher:

User-agent: Twitterbot
Disallow:

User-agent: *
Disallow: /
Here is another example, which specifies which directories are allowed to be crawled by Twitterbot
(in this case, disallowing all except the images and archives directories):

User-agent: Twitterbot
Disallow: *

Allow: /images
Allow: /archives
The server’s robots.txt file must be saved as plain text with ASCII character encoding. To verify
this, run the following command:

$ file -I robots.txt
robots.txt: text/plain; charset=us-ascii
Content is cached by Twitter for 7 days after a link to a page with card markup has been published
in a Tweet.

If you encounter issues with cards in Tweets not appearing properly, see the Cards
Troubleshooting Guide.

= = = = = = = = =
= = = = = = = = = FACEBOOK SOCIAL
Best Practices
Learn about the best practices for implementing Facebook Sharing for your websites and mobile apps
to build app experiences that people understand and trust.

Recommendations for Websites
Implement the Facebook Crawler to generate a preview of your publicly available Facebook content.

You must enable GZIP and/or deflate encoding on your web server to ensure that your website is
shared correctly by our crawler.

Use Open Graph meta tags to ensure the Facebook Crawler scrapes useful information, such as title,
description, and preview image, about your website when it is shared on Facebook.

Use the Sharing Debugger tool to test how your websites are viewed by our scraper. The debug tool
also refreshes any scraped content we have for your websites, so it can be useful if you need to
update them more often than the standard 24 hour update period.

Track the interactions of people on your website as they happen with the Facebook SDK for
JavaScript. You can subscribe to events such as someone clicking on a Like button, sending a message
with the Send button, or making a comment. The FB.Event.subscribe reference guide to learn how to
track these events.

Turn on Follow to allow your content creators to share public updates with their followers, while
saving personal updates for friends only. For example, journalists can allow readers or viewers to
follow their public content, like photos taken on location or links to published articles. Follow is
a simple, effective way for your audience to connect with you and keep up with your content, without
adding you as a friend.

Enable Follow - Go to your Page Account Settings and click on the Followers tab. Check the box to
allow followers, and if you’d like, you can adjust your settings for follower comments and
notifications.

Fill out your timeline - Make sure your timeline looks professional: add a cover photo, your title
and work history, key career milestones, and life events.

Observe – Follow other journalists, photographers, authors, and anyone else who has built up a large
follower base. Visit their timelines and check out the types of content they share.

Post to your followers - Share interesting photos, links to your content, and updates about what
you’re working on, etc. Any post you set to Public will be shown to your followers in Feed.

Images
Use images that are at least 1080 pixels in width for best display on high resolution devices. At
the minimum, you should use images that are 600 pixels in width to display image link ads. We
recommend using 1:1 images in your ad creatives for better performance with image link ads.
Pre-cache your images by running the URL through the URL Sharing Debugger tool to pre-fetch metadata
for the website. You should also do this if you update the image for a piece of content.

Use og:image:width and og:image:height Open Graph tags to specify the image dimensions to the
crawler so that it can render the image immediately without having to asynchronously download and
process it.

SOURCE :: https://blog.shahednasser.com/how-to-easily-add-share-links-for-each-social-media-platform/
<a href="https://twitter.com/intent/tweet?text=Awesome%20Blog!&url=blog.shahednasser.com">Share on Twitter</a>
<a href="https://www.linkedin.com/sharing/share-offsite/?url=blog.shahednasser.com">Share on LinkedIn</a>
<a href="https://www.facebook.com/sharer/sharer.php?u=blog.shahednasser.com&quote=Awesome%20Blog!">Share on Facebook</a>

<a href="https://wa.me/?text=Awesome%20Blog!%5Cn%20blog.shahednasser.com">Share on Whatsapp</a>
<a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=blog.shahednasser.com&caption=Awesome%20blog!&tags=test%2Chello">Share on Tumblr</a>
<a href="https://www.reddit.com/submit?url=blog.shahednasser.com&title=Awesome%20Blog!">Share on Reddit</a>


= = = = = = = = =
= = = = = = = = =
og:url
<meta property="og:url" content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
The <a>canonical URL</a> for your page. This should be the undecorated URL, without session
variables, user identifying parameters, or counters. Likes and Shares for this URL will aggregate at
this URL. For example, mobile domain URLs should point to the desktop version of the URL as the
canonical URL to aggregate Likes and Shares across different versions of the page.
https://developers.facebook.com/docs/sharing/webmasters/getting-started/versioned-link

og:title
<meta property="og:title" content="When Great Minds Don’t Think Alike" />
The title of your article without any branding such as your site name.

og:description
<meta property="og:description" content="How much does culture influence creative thinking?" />
A brief description of the content, usually between 2 and 4 sentences. This will displayed below the
title of the post on Facebook.

og:image
<meta property="og:image" content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
The URL of the image that appears when someone shares the content to Facebook. See below for more
info, and check out our best practices guide to learn how to specify a high quality preview image.
- - - - - - - - -
    Images in Link Shares
    The Open Graph meta-tag
    The og:image tag can be used to specify the URL of the image that appears when someone shares
    the content to Facebook. The full list of image properties can be found here.

    https://ogp.me/
        // IMG
        <meta property="og:image" content="https://example.com/ogp.jpg" />
        <meta property="og:image:secure_url" content="https://secure.example.com/ogp.jpg" />
        <meta property="og:image:type" content="image/jpeg" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:height" content="300" />
        <meta property="og:image:alt" content="A shiny red apple with a bite taken out" />
            Arrays
            If a tag can have multiple values, just put multiple versions of the same <meta> tag on
            your page. The first tag (from top to bottom) is given preference during conflicts.

            <meta property="og:image" content="https://example.com/rock.jpg" />
            <meta property="og:image" content="https://example.com/rock2.jpg" />
            Put structured properties after you declare their root tag. Whenever another root
            element is parsed, that structured property is considered to be done and another one
            is started.

            For example:
                <meta property="og:image" content="https://example.com/rock.jpg" />
                <meta property="og:image:width" content="300" />
                <meta property="og:image:height" content="300" />
                <meta property="og:image" content="https://example.com/rock2.jpg" />
                <meta property="og:image" content="https://example.com/rock3.jpg" />
                <meta property="og:image:height" content="1000" />

            ...means there are 3 images on this page, the first image is 300x300, the middle one has
            unspecified dimensions, and the last one is 1000px tall.

        // VIDEO
        <meta property="og:video" content="https://example.com/movie.swf" />
        <meta property="og:video:secure_url" content="https://secure.example.com/movie.swf" />
        <meta property="og:video:type" content="application/x-shockwave-flash" />
        <meta property="og:video:width" content="400" />
        <meta property="og:video:height" content="300" />

        // AUDIO
        <meta property="og:audio" content="https://example.com/sound.mp3" />
        <meta property="og:audio:secure_url" content="https://secure.example.com/sound.mp3" />
        <meta property="og:audio:type" content="audio/mpeg" />

    Requirements
    - The minimum allowed image dimension is 200 x 200 pixels.
    - The size of the image file must not exceed 8 MB.
    - Use images that are at least 1200 x 630 pixels for the best display on high resolution
      devices. At the minimum, you should use images that are 600 x 315 pixels to display link page
      posts with larger images.

    - If your image is smaller than 600 x 315 px, it will still display in the link page post, but
      the size will be much smaller.

    - We've also re-designed link page posts so that the aspect ratio for images is the same across
      desktop and mobile Feed. Try to keep your images as close to 1.91:1 aspect ratio as possible
      to display the full image in Feed without any cropping.

    - Our crawler only accepts gzip and deflate encodings, so make sure your server uses the
      right encoding.

    Use og:image:width and og:image:height Open Graph tags:
    Using these tags will specify the image dimensions to the crawler so that it can render the
    image immediately without having to asynchronously download and process it.

    https://developers.facebook.com/docs/sharing/webmasters/#images
    Images
    Use this set of properties for content that contains more than one image. See Sharing Best
    Practices for guidance on how best to use og:image.

    Meta tag	Description
    og:image
    URL for the image. To update an image after it's been published, use a new URL for the new
    image. Images are cached based on the URL and won't be updated unless the URL changes.

    og:image:url
    Equivalent to og:image

    og:image:secure_url
    https:// URL for the image

    og:image:type
    MIME type of the image. One of image/jpeg, image/gif or image/png

    og:image:width
    Width of image in pixels. Specify height and width for your image to ensure that the image loads
    properly the first time it's shared.

    og:image:height
    Height of image in pixels. Specify height and width for your image to ensure that the image
    loads properly the first time it's shared.

- - - - - - - - -

fb:app_id
In order to use <a>Facebook Insights</a> you must add the app ID to your page. Insights lets you
view analytics for traffic to your site from Facebook. Find the app ID in your <a>App Dashboard</a>.
https://developers.facebook.com/micro_site/url/?click_from_context_menu=true&country=US&destination=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fsharing%2Freferral-insights&event_type=click&last_nav_impression_id=1yifrTgmTcny89UEF&max_percent_page_viewed=44&max_viewport_height_px=833&max_viewport_width_px=1329&orig_http_referrer=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fsharing%2Fwebmasters%2F&orig_request_uri=https%3A%2F%2Fdevelopers.facebook.com%2Fajax%2Fdocs%2Fnav%2F%3Fpath1%3Dsharing%26path2%3Dwebmasters&region=noam&scrolled=true&session_id=1HkM3PUNhQ2jc0edr&site=developers
https://developers.facebook.com/apps/redirect/dashboard

og:type
<meta property="og:type" content="article" />
The type of media of your content. This tag impacts how your content shows up in Feed. If you don't
specify a type,the default is <>website</>. Each URL should be a single object, so multiple <>og:type</>
values are not possible. Find the full list of object types in <a>Object Types Reference</a>.

og:locale
The locale of the resource. Defaults to <>en_US</>. You can also use <>og:locale:alternate</> if
you have other available language translations available. Learn about the locales we support in our
<a>documentation on localization</a>.

= = = = = = = = =
= = = = = = = = =
https://developers.facebook.com/docs/sharing/webmasters/crawler
The Facebook Crawler
The Facebook Crawler crawls the HTML of an app or website that was shared on Facebook via copying
and pasting the link or by a Facebook social plugin. The crawler gathers, caches, and displays
information about the app or website such as its title, description, and thumbnail image.

Crawler Requirements
- Your server must use gzip and deflate encodings.
- Any Open Graph properties need to be listed before the first 1 MB of your website or app, or it
  will be cutoff.
- Ensure that the content can be crawled by the crawler within a few seconds or Facebook will be
  unable to display the content.
- Your app or website should either generate and return a response with all required properties
  according to the bytes specified in the Range header of the crawler request or it should ignore
  the Range header altogether.
- Add to your allow list either the user agent strings or the IP addresses (more secure) used by
  the crawler.
- Ensure that your app or website allows the Facebook Crawler to crawl the privacy policy associated
  with your app or website.

Crawler IPs and User Agents

The Facebook crawler user agent strings:
    facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)
    facebookexternalhit/1.1
    facebookcatalog/1.0

To get a current list of IP addresses the crawler uses, run the following command.
    whois -h whois.radb.net -- '-i origin AS32934' | grep ^route

These IP addresses change often.

Example Response
...
route:      69.63.176.0/21
route:      69.63.184.0/21
route:      66.220.144.0/20
route:      69.63.176.0/20
route6:     2620:0:1c00::/40
route6:     2a03:2880::/32
route6:     2a03:2880:fffe::/48
route6:     2a03:2880:ffff::/48
route6:     2620:0:1cff::/48
...

= = = = = = = = =
= = = = = = = = =
https://developers.facebook.com/docs/sharing/webmasters/optimizing#basic

Optimizing Metadata
The first time someone shares or likes a URL, the Facebook Crawler caches the resolved canonical URL
and its metadata. You can view the results of this cache or force a re-scrape with the
Sharing Debugger.

You can optimize content by delivering only Open Graph meta tags to the crawler and only the content
itself to regular users. Alternatively, you can choose to point the crawler to a separate page used
only for metadata with <link rel="opengraph" href="..."/>.

Handling Large Objects With Pointers
If your content has large amounts of metadata, you can improve performance by serving the metadata
and content from two separate URLs and using pointers to link the two pages. This approach is ideal
for responsive sites because you can serve the same page to both desktop and mobile browsers.

The URL where your content is hosted should contain the required Open Graph tags.

Then, add an additional tag pointing to the page where extra metadata is hosted:
<link rel="opengraph" href="{DESTINATION_URL}"/>

At the destination URL, include any additional metadata as well as a pointer to the original page:
<meta property="og:type" content="metadata"/>
<link rel="origin" href={SOURCE_URL}/>

Keep in mind:
The source URL must contain the basic tags
The source URL can have as many pointers as you like, but each page it points to should point back
with a link rel="origin" tag Pointers are only one level deep, so a page of type ‘metadata’ can't
contain another link rel="opengraph"

Optimizing for a Mobile Subdomain
Web apps that use subdomains for mobile-optimized versions can avoid adding extra metadata to the
mobile views of their pages by using canonical URLs pointing to the desktop view of the
same content.

Just add this meta tag to the mobile URL:
    <link rel="canonical" href="DESKTOP_OBJECT_URL" />
    Make sure that you use an absolute path, rather than a relative path, for your canonical
    href value.

    The desktop page should include the basic Open Graph tags for your content, as it will be
    used by Facebook's scraper to uniquely identify that content.

*/