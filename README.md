# A Lighthouse Style Guide: Wordpress

*How we do it why we do it and some resources to help you*

## Table of Contents

1. [Project Structure](#project-structure)
2. [Theme](#theme)
2. Custom Post Types
3. Custom Taxonomies
4. Custom Meta (Boxes)
5. Plugins

## 1. Project Structure

Wordpress development is not just the theme, that would be theme development, as such we are using [Bedrock](https://github.com/roots/bedrock) as the starting point for all of our projects.

### Bedrock

Bedrock has a lot to offer and the best thing to do is to head over to their [site](https://roots.io/bedrock/) and learn all about it there.

These, however, are the reasons we are using is (taken pretty much straight from their site):

* Better Wordpress project structure - Every bit of code should "live" somewhere and that somewhere should be obvious 
* Dependency management - Composer is how we manage PHP dependencies everywhere but Wordpress, this alone is reason enough to use Bedrock
* Easy Wordpress configuration - Using Dotenv you can easily setup environment specific configuration
* Enhanced security - Everything is no longer in the web root... See point one

#### Starting a Project

Again taken from the [Bedrock Github](https://github.com/roots/bedrock).

1. Create the project using `composer create-project`, [`create-project`](https://getcomposer.org/doc/03-cli.md#create-project) pretty much does a `git clone` followed by a `composer install`  

  `composer create-project roots/bedrock your-project-folder-name`
  
2. Copy `.env.example` to `.env` and fill in appropriately

Easy right?

#### Key Points

* Any time you start working on a project run `composer-install` to make sure you have all the dependencies the project requires
* Wordpress is now also a dependency, when you run `composer-install` it is installed to `/web/wp`. There is no need to look in that folder just know its there!
* The document root for Wordpress projects is no longer the root directory, for example `/var/www/wordpress-site`. In the example it would be `/var/www/wordpress-site/web`
* As the document root has changed so has the admin portal, you will find it at `http://yourproject.com/wp/wp-admin`

## 2. Theme

We haven't settled on a definitive theme skeleton yet, there are definite points within theme developoment that are nailed down like [scss linting](https://github.com/wearelighthouse/linthouse-scss) and our [scss skeleton](https://github.com/wearelighthouse/lightbones-scss) but not the entire theme itself.

The two starting points that are currently being used are:

* [Lightbones](https://bitbucket.org/wearelighthouse/lightbones) - This has been used on a lot of sites although is a bit outdated
* [Sage](https://github.com/roots/sage) - This could be seen as the accompanying theme to Bedrock

### Installation

Once you've chosen your starting point you need to put it somewhere, Bedrock abstracts `wp-content` out of the Wordpress core to `/web/app`. In there you will find all the directories you would expect to find in `wp-content`, just drop your theme in `/web/app/themes` and you are good to go.
