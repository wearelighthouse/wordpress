# A Lighthouse Style Guide: Wordpress

*How we do it why we do it and some resources to help you*

## Table of Contents

1. [Project Structure](#1-project-structure)
2. [Theme](#2-theme)
3. [Plugins](#3-plugins)
4. [Must Use Plugins](#4-must-use-plugins)
5. [Custom Post Types and Taxonomies](#5-custom-post-types-and-taxonomies)
6. [Custom Meta (Boxes)](#6-custom-meta-boxes)

## 1. Project Structure

Wordpress development is not just the theme, that would be theme development, as such we are using [Bedrock](https://github.com/roots/bedrock) as the starting point for all of our projects.

### Bedrock

Bedrock has a lot to offer and the best thing to do is to head over to their [site](https://roots.io/bedrock/) and learn all about it there. These are the reasons we are using is (taken pretty much straight from their site):

> Better Wordpress project structure

Every bit of code should "live" somewhere and that somewhere should be obvious.

> Dependency management

Composer is how we manage PHP dependencies everywhere but Wordpress, this alone is reason enough to use Bedrock.

> Easy Wordpress configuration

Using Dotenv you can easily setup environment specific configuration.

> Enhanced security

Separated web root and secure passwords.

### Starting a Project

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

### Plugin exists on Wordpress Packagist or Packagist

[Wordpress Packagist](https://wpackagist.org/) mirrors the Wordpress plugin and theme directories as Composer repositories, this should be where you first go look. If it exists run `composer require wpackagist-plugin/cmb2` from the root of your project - Where `cmb2` is the name of your plugin.

[Packagist](https://packagist.org/) is where Composer will go look by default for a package when you require it. Using [CMB2](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress) as an example here is how you would find and install a CM2 from Packagist:

1. Check its [repository](https://github.com/WebDevStudios/Custom-Metaboxes-and-Fields-for-WordPress), is there a [`composer.json`](https://github.com/WebDevStudios/CMB2/blob/trunk/composer.json) and does it have the `type` property equal `wordpress-plugin` -  `"type": "wordpress-plugin"`
2. Take the name found in [`composer.json`](https://github.com/WebDevStudios/CMB2/blob/trunk/composer.json) - In this case `"name": "webdevstudios/cmb2"` - and run `composer require webdevstudios/cmb2` from the root of your project

If Composer cannot find the package then it is not registered on [Packagist](https://packagist.org/) - see 3.2!

### Plugin doesn't exist on Wordpress Packagist or Packagist

This is normally the case if it is a paid plugin, but don't worry there is a workaround. The following steps will use [Gravity Forms](https://bitbucket.org/wearelighthouse/gravityforms) as an eaxmple.

1. Create a private [Bitbucket](https://bitbucket.org/wearelighthouse/gravityforms) repository and add the plugins files
2. Create a [`composer.json`](https://bitbucket.org/wearelighthouse/gravityforms/src/6edeeb7f6158c3e903c25f32b648fef3c91b5160/composer.json?at=master&fileviewer=file-view-default) in the root of the plugin
3. Push it up to Bitbucket!
4. In your projects `composer.json` there will be a propery called [`repositories`](https://bitbucket.org/wearelighthouse/donatemate/src/765e9dca5a26701d1a17e1c07be6c5465fea4305/composer.json?at=master&fileviewer=file-view-default#composer.json-29), you will need to add the [repository](https://bitbucket.org/wearelighthouse/gravityforms/src/6edeeb7f6158c3e903c25f32b648fef3c91b5160/composer.json?at=master&fileviewer=file-view-default#composer.json-4) specified in your plugins `composer.json` to that array
5. Install it like other packages by running  `composer require wearelighthouse/gravityforms` from the root of your project

## 4. Must Use Plugins

**From the [Wordpress Codex](https://codex.wordpress.org/Must_Use_Plugins)**

> Must-use plugins (a.k.a. mu-plugins) are plugins installed in a special directory inside the content folder and which are automatically enabled on all sites in the installation. Must-use plugins do not show in the default list of plugins on the Plugins page of wp-admin – although they do appear in a special Must-Use section – and cannot be disabled except by removing the plugin file from the must-use directory, which is found in ~~`wp-content/mu-plugins`~~ `web/app/mu-plugins` by default.

Must-use plugins are prime candidates for custom post types, taxonomies and custom meta boxes.

**You might think:**

> Why aren't we putting them in our theme like normal?

**To which we would say:**

> [Separation of concerns](https://en.wikipedia.org/wiki/Separation_of_concerns)

As we've taken steps to better structure our Wordpress projects using Bedrock we can bring tightly coupled code out of our themes and put it where it makes sense.

### Installation

#### Using Composer

Run the command `composer require mupluginautor/muplugin` from the root of your project.

**N.B.** when using this method you need to check that the `type` property specified in the mu-plugins `composer.json` is `wordpress-muplugin`.

#### Manually

Just drop the file/folder into `web/app/mu-plugins`.

**Gotcha!!**

The default `.gitignore` is set to ignore all directories within `web/app/mu-plugins`, if you add a directory and need it checked it you will need to add a negating rule.

`!web/app/mu-plugins/yourplugin`

## 5. Custom Post Types and Taxonomies

Custom post types and taxonomies should be created as [mu-plugins](#must-use-plugins), this will mean they are always loaded (cause you generally always need them!). It also means everyone will know where to create and find them when working on a project.

### Naming Conventions

Property | Rule | Example
---------|------|--------
Name | Singular | person, job
Slug | Plural | people, jobs
Filename | Singular | PostTypePerson, TaxonomyJob

**N.B.** there will be times where the slug might not be the strict plural of the name, for example team. But the slug should still represent a group of the singular.

[An example custom post type](examples/mu-plugins/PersonPostType.php)

[An example custom taxonomy](examples/mu-plugins/JobTaxonomy.php)

## 6. Custom Meta (Boxes)

The library we prefer to use for custom meta boxes is [CMB2](https://github.com/WebDevStudios/CMB2), it has a simple API with plenty of example applications. If you require custom meta boxes you will need to install CMB2 which can be done using Composer.

`composer require webdevstudios/cmb2`

There are a whole bunch of field types built into CMB2 which can be found [here](https://github.com/WebDevStudios/CMB2/wiki/Field-Types).

Like custom post types and taxonomies, custom meta boxes are to be implemented as [mu-plugins](#must-use-plugins) for the exact same reasons as above.

### Naming Conventions

Property | Rule | Example
---------|------|--------
Filename | (Page\|Post\|PostType\|Taxonomy)MetaBoxes | AboutPageMetaBoxes, PersonMetaBoxes

[Example custom meta boxes](examples/mu-plugins/AboutPageMetaBoxes.php)

### Custom `show_on` filters

CMB2 allows you to determine what interfaces meta boxes are shown on through the `show_on` key. There are a series of built in [filters](https://github.com/WebDevStudios/CMB2/wiki/Display-Options) that you can use but sometimes you need something a bit more [custom](https://github.com/WebDevStudios/CMB2/wiki/Adding-your-own-show_on-filters)!

[`show_on` slug filter](resources/mu-plugins/ShowOnSlugFilter.php)
