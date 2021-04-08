# Module distributor for Opencart

Its framework for resolve task: Develops a module on one version and integrates to another versions automatic! This framework is extension for [Opencart Quick Deploy framework](https://github.com/denis-kisel/opencart-deploy).
`Only for linux systems!`

## Requirements
- Zip (`sudo apt install zip`)
- PHP >= v7.0

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


### Define all files of module
First rules what should edit its `d_rules/files_to_distribute.php`   
Need to set all relative files pathes of module

### Set rules of copying files
Configure rule `d_rules/copy.php`. 


### Base integration
Edit rules: 
- `d_rules/controller.php`
- `d_rules/view.php`
- `d_rules/model.php`
  
For example: you need to integrate base code of controller file from 2000 version to 3000 version. You can replace some code in `d_rules/controller.php` file:

#### Replace format
```
'range_versions' => [
    'admin' => [
        ['search', 'replace'],
        ...
    ],
    'catalog' => [
        ['search', 'replace'],
        ...
    ]
]

#Example
'3000:3020' => [                
    ...
    'catalog' => [
        [
            'ControllerModule{class_name}',
            'ControllerExtensionModule{class_name}'
        ],
    ...
]

#Also available serach by regex
#just start search with "[regex]"
#Setted modifies: sU
'3000:3020' => [                
    ...
    'catalog' => [
        [
            '[regex]Contrller(.*)Module',
            'Controller${1}Module'
        ],
    ...
]
```


### You need to install.xml file in your module?
This file will automatic generated!  
First of all you need to set config `modification_code` in `distributor_config.php`

Then you can set modifications in `d_rules/install_xml.php` file


### You need to install.php or install.sql file in your module?
Just put `install.php` to root of developing site. For example: you have versions: 2000, 2200, 2300. Your developing version is 2000. Its meat what your file will be by path `your_site/2000/install.php`

Then you can config distribute file in `d_rules/install_php.php`.  

Config `install.sql` by analogy.


### Archivator
Configure `d_rules/archivator.php` to final collector your module


### Obfuscate some files(for safe licence)[optional]
Configure `d_rules/obfuscator.php`


## Build
```
$ cd proj_dir //Without version, just in root
$ oc-distribute
```

## Lifecycle
1. Module files copy from base version to another versions.  
First handler is `Distributor` class, which copy files with replace content by rules.  
Second handler is `AdditionalFiles` class, which copy additional files with replace content by `files_to_distribute[additional_files]` rules.  
Second handler is `InstallXML` class, which create install.xml file by `install_xml` rules and automatically apply modifications.  
1. Module collected to dir specify in `distributor_config[collection_folder]` config, by default to `dist`
1. Module's files obfuscated by `obfuscator` rules. (Optional)
1. Create `zip` archive by `archivator` rules.

## License
The MIT License (MIT)