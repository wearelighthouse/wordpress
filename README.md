# A Lighthouse Style Guide: Wordpress

*How we do it why we do it and some resources to help you*

## Table of Contents

1. [Project Structure](#project-structure)
2. [Theme](#theme)
3. [Plugins](#plugins)
3. Must Use Plugins (mu-plugins)
5. Custom Post Types
6. Custom Taxonomies
7. Custom Meta (Boxes)

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

## 3. Plugins

This is where Composer really comes into play as we can use it to manage the sites plugin dependencies! There are two scenarios that will come about when installing plugins as dependencies.

### 3.1. Plugin exists on Wordpress Packagist or Packagist

[Wordpress Packagist](https://wpackagist.org/) mirrors the Wordpress plugin and theme directories as Composer repositories, this should be where you first go look. If it exists run `composer require wpackagist-plugin/cmb2` from the root of your project - Where `cmb2` is the name of your plugin.

[Packagist](https://packagist.org/) is where Composer will go look by default for a package when you require it. Using [CMB2](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress) as an example here is how you would find and install a CM2 from Packagist:

1. Check its [repository](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress), is there a [`composer.json`](https://github.com/WebDevStudios/CMB2/blob/trunk/composer.json) and does it have the `type` property equal `wordpress-plugin` -  `"type": "wordpress-plugin"`
2. Take the name found in [`composer.json`](https://github.com/WebDevStudios/CMB2/blob/trunk/composer.json) - In this case `"name": "webdevstudios/cmb2"` - and run `composer require webdevstudios/cmb2` from the root of your project

If Composer cannot find the package then it is not registered on [Packagist](https://packagist.org/) - see 3.2!

### 3.2. Plugin doesn't exist on Wordpress Packagist or Packagist

This is normally the case if it is a paid plugin, but don't worry there is a workaround. The following steps will use [Gravity Forms](https://bitbucket.org/wearelighthouse/gravityforms) as an eaxmple.

1. Create a private [Bitbucket](https://bitbucket.org/wearelighthouse/gravityforms) repository and add the plugins files
2. Create a [`composer.json`](https://bitbucket.org/wearelighthouse/gravityforms/src/6edeeb7f6158c3e903c25f32b648fef3c91b5160/composer.json?at=master&fileviewer=file-view-default) in the root of the plugin
3. Push it up to Bitbucket!
4. In your [`composer.json`](https://bitbucket.org/wearelighthouse/donatemate/src/765e9dca5a26701d1a17e1c07be6c5465fea4305/composer.json?at=master&fileviewer=file-view-default#composer.json-29) there will be a propery called `repositories`, you will need to add the repository specified in your plugins [`composer.json`](https://bitbucket.org/wearelighthouse/gravityforms/src/6edeeb7f6158c3e903c25f32b648fef3c91b5160/composer.json?at=master&fileviewer=file-view-default#composer.json-4) to this array
5. Install it like other packages by running  `composer require wearelighthouse/gravityforms` from the root of your project
