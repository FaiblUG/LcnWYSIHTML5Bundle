LcnWYSIHTML5Bundle
==================

WYSIWYG-Editor form widget for Symfony2 base on [WYSIHTML5 by Xing](http://xing.github.io/wysihtml5/). MIT License.


Installation
------------

### Step 1: Install dependencies

Install the required [LcnIncludeAssetsBundle](https://github.com/FaiblUG/LcnIncludeAssetsBundle).


### Step 2: Download the Bundle

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require locaine/lcn-file-uploader-bundle "~1.0"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

### Step 3: Enable the Bundle

Then, enable the bundle by adding the following line in the `app/AppKernel.php`
file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new Lcn\WYSIHTML5Bundle\LcnWYSIHTML5Bundle(),
        );

        // ...
    }

    // ...
}
```

Usage
-----

In your Form class, set the field type "lcn_wysihtml5" whenever you want to output the WYSIWYG-Editor.

```php
$form = $this->createFormBuilder($entity)->add('your_html_field', 'lcn_wysihtml5');
```

That's it. You're done.


Configuration
-------------

You can customize the default settings by overriding them in your app/config/parameters.yml or app/config/config.yml file. 

### Available editor commands

```twig
parameters:
    # configure the editor commands
    lcn_wysihtml5.commands:
        - { command: bold }
        - { command: italic }
        - { command: insertUnorderedList }
        - { command: insertOrderedList }
        - { command: formatBlock, value: h1 }
        - { command: formatBlock, value: h2 }
```

### Use custom Stylsheets and Javascripts for advanced customizations
  
You can configure the included assets to achieve any configuration provided by WYSIHTML5.
For more details, consult the [documentation](https://github.com/xing/wysihtml5).

```twig
parameters:
    # stylesheets get included directly in the web page with the form widget
    lcn_wysihtml5.stylesheets.controls:
        - /bundles/lcnwysihtml5/dist/themes/basic/controls.css

    # stylesheets get included in the editor's sandboxed iframe
    # and should be included when outputting the generated html code.
    # you might want to add some base stylsheets from your own theme
    lcn_wysihtml5.stylesheets.content:
        - /bundles/lcnwysihtml5/dist/themes/basic/content.css

    lcn_wysihtml5.parser_rules: /bundles/lcnwysihtml5/dist/themes/basic/parser_rules.js
```

### Customize HTMLPurifier Options for Server Side Sanitization

```twig
parameters:
    lcn_wysihtml5.purifier_config:
        'Attr.AllowedClasses':
            - wysiwyg-color-primary
            - wysiwyg-color-secondary
            - wysiwyg-float-left
            - wysiwyg-float-right
            - wysiwyg-clear-left
            - wysiwyg-clear-right
```

### Customize Colors

The editor uses class names to apply pre-defined colors:

You need to adjust the colors in the css file (set your own theme):
  
```twig
parameters:
    lcn_wysihtml5.stylesheets.content:
        - /bundles/lcnwysihtml5/dist/themes/basic/content.css
```

This stylesheet gets automatically included in the editor.
However, you have to manually include this stylesheet in your page where you output the html code:

```html
<link rel="stylesheet" href="/bundles/lcnwysihtml5/dist/themes/basic/content.css">
```

Configure the available colors in the editor toolbar:

```twig
parameters:
    # configure the editor commands
    lcn_wysihtml5.commands:
        ...
        - { command: foreColor, values: [primary, secondary] }
```

Configure the allowed color-classnames for Server-Side validation using HTMLPurifier:

```twig
parameters:
    lcn_wysihtml5.purifier_config:
        'Attr.AllowedClasses':
            - wysiwyg-color-primary
            - wysiwyg-color-secondary
            ...
```
