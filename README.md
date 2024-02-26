# WooCommerce Payment Links

**Description:** Payment links for WooCommerce

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
- .parcel-cache/
- .idea/

**Files**
- *.lock


<h2 id="tree">File Tree</h2>

```
.
├── LICENSE
├── README.md
├── app
│   ├── API
│   │   ├── Routes
│   │   │   ├── Links.php
│   │   │   └── Route.php
│   │   └── Routes.php
│   ├── Controllers
│   │   ├── Menus
│   │   │   └── Links.php
│   │   ├── Menus.php
│   │   ├── Pages
│   │   │   └── PaymentLink.php
│   │   └── Render
│   │       ├── AbstractRender.php
│   │       └── InterfaceRender.php
│   ├── Core
│   │   ├── Boot.php
│   │   ├── Config.php
│   │   ├── Export.php
│   │   ├── Functions.php
│   │   ├── Uninstall.php
│   │   └── Utils.php
│   ├── Exceptions
│   │   ├── ExpiredTokenException.php
│   │   └── InvalidTokenException.php
│   ├── Helpers
│   │   └── Helper.php
│   ├── Infrastructure
│   │   ├── Bootstrap.php
│   │   ├── Model.php
│   │   └── Repository.php
│   ├── Model
│   │   ├── LinkModel.php
│   │   └── ProductModel.php
│   ├── Repository
│   │   ├── LinkRepository.php
│   │   └── ProductRepository.php
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
│       │   └── menus
│       │       └── settings
│       │           ├── index.php
│       │           └── modal.php
│       ├── Pages
│       │   └── checkout
│       │       └── index.php
│       └── WooCommerce
├── assets
│   ├── images
│   │   └── icons
│   ├── scripts
│   │   ├── admin
│   │   │   └── menus
│   │   │       └── settings
│   │   │           ├── index.js
│   │   │           └── table.js
│   │   ├── components
│   │   └── theme
│   │       └── pages
│   │           └── checkout
│   │               └── index.js
│   └── styles
│       └── app.css
├── composer.json
├── package.json
├── readme.txt
├── tailwind.config.js
└── wc-payment-link.php
```

