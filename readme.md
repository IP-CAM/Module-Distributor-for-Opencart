# Module distributor for Opencart

DEVELOPING!!!

Its framework for resolve task: Develops a module on one version and integrates to another versions automatic! This framework is extension for [Opencart Quick Deploy framework](https://github.com/denis-kisel/opencart-deploy).
`Only for linux systems!`


## Demo
```
$ cd proj_dir
$ oc-distribute
```


## Install
```
$ mkdir -p ~/Download/opencart-distributor && git clone https://github.com/denis-kisel/opencart-distributor ~/Download/opencart-distributor
$ cd ~/Download/opencart-distributor && sudo bash install.sh

# Init configs
$ cd proj_dir
$ oc-dist-init
```

## Settings
First of all you need to deploy some versions of OC by [Opencart Quick Deploy framework](https://github.com/denis-kisel/opencart-deploy) and configure `distributor_config.php`.  
Then you need to edit some rules for specific your module:

#### Define all files of module
First rules what should edit its `d_rules/files_to_distribute.php`   
Need to set all relative files pathes of module

#### Base integration
Edit rules: 
- `d_rules/controller.php`
- `d_rules/view.php`
- `d_rules/model.php`
  
For example: you need to integrate base code of controller file from 2000 version to 3000 version. You can replace some code in `d_rules/controller.php` file:

```
'3000:3020' => [                
    ...
    'catalog' => [
        [
            'ControllerModule{class_name}',
            'ControllerExtensionModule{class_name}'
        ],
    ...
]
```

#### You need to install.xml file in your module?
This file will automatic generated!  
First of all you need to set config `modification_code` in `distributor_config.php`

Then you can set modifications in `d_rules/install_xml.php` file


#### You need to install.php or install.sql file in your module?
Just put `install.php` to root of developing site. For example: you have versions: 2000, 2200, 2300. Your developing version is 2000. Its meat what your file will be by path `your_site/2000/install.php`

Then you can config distribute file in `d_rules/install_php.php`.  

Config `install.sql` by analogy.


#### Archivator
Configure `d_rules/archivator.php` to final collector your module


#### Obfuscate some files(for safe licence)
Configure `d_rules/obfuscator.php`


## Build
```
$ cd proj_dir //Without version, just in root
$ oc-distribute
```

## License
The MIT License (MIT)

## Donation
If this project help you reduce time to develop, you can give me a cup of coffee :)
Also you can support project if you want to use framework with new versions of Opencart in the future!

WebMoney:
USD: Z379807461542
RUB: R540812684383

YandexMoney(YooMoney): denis.kisel92@gmail.com