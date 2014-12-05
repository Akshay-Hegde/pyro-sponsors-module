pyro-sponsors-module
====================

Create a list of sponsors. Sponsors can also be marked as `featured` and are pushed into a new array for the display.

### Installation

[Download](https://github.com/james2doyle/pyro-sponsors-module/archive/master.zip) or clone this repo. Make sure the name of the module folder is `sponsors`. Then, drop into `addons/shared_addons/modules`.

Go to to `admin/addons` in your site, and click install on the module.

### Screenshots

Main view with some items:

![screen1](https://raw.githubusercontent.com/james2doyle/pyro-sponsors-module/master/screen1.png)

Editing an item that is already featured:

![screen2](https://raw.githubusercontent.com/james2doyle/pyro-sponsors-module/master/screen2.png)

Editing an item that cannot be feature, since the limit is reached:

![screen3](https://raw.githubusercontent.com/james2doyle/pyro-sponsors-module/master/screen3.png)

### Features

* List sponsors with sort ordering
* Feature sponsors with limit
* Simple image dropdown for selecting photos

#### Fields

* id
* title
* link
* image

You could use this module for listing other things, but I find that when listing out sponsors, this info is pretty standard.

#### Changing The Feature Limit

Open `controller/admin.php` and change `$max_featured` to whatever you want the limit to be.

### Usage

```html
{{ sponsors:items }}
  {{ featured }}
  <a href="{{ link }}" title="{{ title }}" target="_blank" id="number-{{ id }}"><img src="{{ files:image_url id=image }}" width="465" height="106" alt="Redshoe Sponsor {{ title }}"></a>
  {{ /featured }}
  <div class="sponsors-overflow">
    {{ sponsors }}
      <a href="{{ link }}" title="{{ title }}" target="_blank" id="number-{{ id }}"><img src="{{ files:image_url id=image }}" width="125" height="75" alt="Redshoe Sponsor {{ title }}"></a>
    {{ /sponsors }}
  </div>
{{ /sponsors:items }}
```

[Created with the Pyro Module Generator](http://dev.warpaintmedia.ca/pyro-module-generator/)