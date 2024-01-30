# WooCommerce Payment Link

**Description:** Template for WordPress plugins

## Anchors
- [Developer notes](#notes)
- [Install dependencies](#install)
- [Build dependencies](#build)
- [Ignored folders and files](#ignore)
- [File Tree](#tree)



<h2 id="notes">Developer notes</h1>

This is a template developed to facilitate the creation of plugins for the WordPress platform. It uses an adapted MVC pattern for a better development experience within the WordPress environment.

The plugin uses Typescript to develop features for Javascript. This is also optional and if necessary the files can be exchanged for Javascript files.
</br>
**Author:** [Matheus Aguiar](https://github.com/devaguia)
</br>

<h2 id="install">Installing the dependencies</h1>

**Install the plugin autoload and dependencies with the composer**
``` 
composer install
```

**Install the node dependencies with the yarn or npm**
``` 
yarn install
npm install
```

<h2 id="build">Build dependencies</h2>

**Build production and watch the resource page changes**
```
yarn watch
```

**Build production assets**
```
yarn build
```

<h2 id="ignore">Ignored folders and files</h2>

**Folders**
- vendor/
- dist/
- node_modules/
- .cache/

**Files**
- *.lock


<h2 id="tree">File Tree</h2>

```
.
├── app
│   ├── Controllers
│   │   ├── Entities
│   │   │   └── Settings.php
│   │   ├── Menus
│   │   │   └── Settings.php
│   │   ├── Menus.php
│   │   ├── Notification.php
│   │   └── Render
│   │       ├── AbstractRender.php
│   │       └── InterfaceRender.php
│   ├── Core
│   │   ├── Actions.php
│   │   ├── Config.php
│   │   ├── Export.php
│   │   ├── Functions.php
│   │   └── Uninstall.php
│   ├── Exceptions
│   ├── Helpers
│   │   └── Helper.php
│   ├── index.php
│   ├── Model
│   │   ├── Entity
│   │   │   └── Settings.php
│   │   ├── Entity.php
│   │   ├── Infrastructure
│   │   │   ├── Bootstrap.php
│   │   │   ├── Table.php
│   │   │   └── Tables
│   │   │       └── Settings.php
│   │   ├── InterfaceRepository.php
│   │   ├── Repository
│   │   │   └── Settings.php
│   │   └── Repository.php
│   ├── Services
│   │   └── WooCommerce
│   │       ├── Checkout
│   │       ├── Logs
│   │       │   └── Logger.php
│   │       ├── Orders
│   │       ├── Thankyou
│   │       ├── Webhooks
│   │       ├── Webhooks.php
│   │       └── WooCommerce.php
│   └── Views
│       ├── Admin
│       │   ├── notifications
│       │   └── settings
│       │       └── index.php
│       └── Pages
├── assets
│   ├── images
│   │   └── icons
│   ├── scripts
│   │   ├── admin
│   │   │   ├── components
│   │   │   │   ├── Ajax
│   │   │   │   │   └── index.ts
│   │   │   │   ├── Mutations
│   │   │   │   ├── Notification
│   │   │   │   │   └── index.ts
│   │   │   │   └── Popup
│   │   │   │       └── index.ts
│   │   │   └── pages
│   │   │       └── settings
│   │   │           └── index.ts
│   │   ├── global
│   │   │   └── components
│   │   └── theme
│   │       ├── components
│   │       └── pages
│   └── styles
│       ├── admin
│       │   ├── base
│       │   │   ├── index.scss
│       │   │   └── _vars.scss
│       │   ├── components
│       │   │   ├── _container.scss
│       │   │   └── popup
│       │   │       └── index.scss
│       │   ├── index.scss
│       │   └── pages
│       │       └── settings
│       │           └── index.scss
│       ├── global
│       │   ├── base
│       │   │   ├── index.scss
│       │   │   └── _vars.scss
│       │   ├── components
│       │   │   └── index.scss
│       │   └── index.scss
│       └── theme
│           ├── base
│           │   ├── index.scss
│           │   └── _vars.scss
│           ├── components
│           │   └── index.scss
│           ├── index.scss
│           └── pages
│               ├── checkout
│               │   └── index.scss
│               └── thankyou
│                   └── index.scss
├── composer.json
├── LICENSE
├── package.json
├── README.md
├── readme.txt
├── tsconfig.json
└── wc-payment-link.php

```

