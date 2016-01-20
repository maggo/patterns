# patterns

This is a pattern collection built using the awesome [Silex PHP micro-framework](http://silex.sensiolabs.org/) and [Twig templating language](http://twig.sensiolabs.org/).
It's heavily inspired by [Brad Frost's Pattern Lab](https://github.com/pattern-lab/patternlab-php) and borrows most patterns from it. Thanks!

## Features

- Over 30 different patterns and HTML elements found in most web applications and sites
- SCSS with autoprefixer
- ES6 / JSX ready
- Source map generation for JS and SCSS

## Usage

### Setup

```
$ npm install
$ composer install
$ npm run build
```

### Webserver

Either start a local php server using `php -S localhost:8000 -t ./src` or set up a new vhost with the webroot `./src` 

### Development

Start a webpack watcher, this will recompile your JS and SCSS every time you change something

```
$ npm run devel
```

#### Patterns and templates

Your pattern templates go into `src/templates/patterns`. There, all templates are structured as specified in the [Atomic Design guidelines](http://patternlab.io/about.html). 

All templates inside the patterns folder will be listed on the homepage of your website in file-system order. A whole list consisting of dozens and dozens of patterns might seem overwhelming but could also provide a grand perspective over all patterns on your website. Use CTRL/CMD+F to find your patterns and click on the title to get a single view.

There's a special `src/templates/pages` folder as well, allowing you to display one template as full-page instead of using the wrapping pattern markup.

#### CSS and JS

The asset entry points are located in `src/css` and `src/js` respectively.
