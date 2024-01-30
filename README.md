# WooCommerce Payment Link

**Description:** Template for WordPress plugins

## Anchors
- [Install dependencies](#install)
- [Build dependencies](#build)
- [Ignored folders and files](#ignore)
- [File Tree](#tree)



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
├── LICENSE
├── README.md
├── app
│   ├── API
│   │   ├── Routes
│   │   │   ├── Route.php
│   │   │   └── TestRoute.php
│   │   └── Routes.php
│   ├── Controllers
│   │   ├── Menus
│   │   │   └── Settings.php
│   │   ├── Menus.php
│   │   └── Render
│   │       ├── AbstractRender.php
│   │       └── InterfaceRender.php
│   ├── Core
│   │   ├── Boot.php
│   │   ├── Config.php
│   │   ├── Export.php
│   │   ├── Functions.php
│   │   ├── Uninstall.php
│   │   └── Utils.php
│   ├── Helpers
│   │   └── Helper.php
│   ├── Model
│   │   ├── Bootstrap.php
│   │   ├── Entity
│   │   │   └── TestEntity.php
│   │   ├── Infrastructure
│   │   │   ├── Entity.php
│   │   │   └── Repository.php
│   │   └── Repository
│   │       └── TestRepository.php
│   ├── Services
│   │   └── WooCommerce
│   │       ├── Checkout
│   │       ├── Logs
│   │       │   └── Logger.php
│   │       ├── Orders
│   │       ├── Thankyou
│   │       ├── Webhooks
│   │       ├── Webhooks.php
│   │       └── WooCommerce.php
│   └── Views
│       ├── Admin
│       │   └── menus
│       │       └── settings
│       │           └── index.php
│       ├── Pages
│       └── WooCommerce
├── assets
│   ├── images
│   │   └── icons
│   ├── scripts
│   │   ├── admin
│   │   │   └── menus
│   │   │       └── settings
│   │   │           └── index.ts
│   │   ├── components
│   │   └── theme
│   │       └── pages
│   └── styles
│       ├── admin
│       │   ├── base
│       │   │   ├── _vars.scss
│       │   │   └── index.scss
│       │   ├── components
│       │   ├── index.scss
│       │   └── menus
│       │       └── settings
│       ├── app.css
│       ├── global
│       │   ├── base
│       │   │   ├── _vars.scss
│       │   │   └── index.scss
│       │   ├── components
│       │   │   └── index.scss
│       │   └── index.scss
│       └── theme
│           ├── base
│           │   ├── _vars.scss
│           │   └── index.scss
│           ├── components
│           ├── index.scss
│           └── pages
│               ├── checkout
│               │   └── index.scss
│               └── thankyou
│                   └── index.scss
├── composer.json
├── package.json
├── readme.txt
├── tailwind.config.js
├── tsconfig.json
└── wc-payment-link.php

```

