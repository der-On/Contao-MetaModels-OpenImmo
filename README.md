# MetaModels - OpenImmo
[![Gitter](https://badges.gitter.im/Join Chat.svg)](https://gitter.im/der-On/Contao-MetaModels-OpenImmo?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

This module makes it possible to import OpenImmo-Data into an existing MetaModel.


## Installation

The files need to be placed within the folder system/modules/metamodels_openimmo/

## Import the Template

You can save a lot of time and work by importing the pre-made template.

It consists of the MetaModel "immo" and pre-configured attributes and the corresponding MetaModel-OpenImmo link.

1. In the Backend under "MetaModels - OpenImmo > Settings" select the MetaModels-Version you have installed.
2. Hit "Import Template" and you will get a good starting point for your object catalog.

**Warning:** Importing the template will erase all of your existing MetaModels and MetaModels-OpenImmo links.

## Usage

1. Create your metamodel
2. In the Backend under "MetaModels - OpenImmo > Links" add a new MetaModel-OpenImmo link
3. Select the folder in which the object-data will be uploaded to by your Software
4. Select the folder in which file attachments for object should be stored
5. Link each field in your metamodel to an OpenImmo field.
6. Setup the upload of your object data in your Software to upload the files in the directory you selected in step 3

## Synchronising

1. Trigger uploading of the data in your software
2. In the Backend unter "MetaModels - OpenImmo > Links" click on the "sync" icon
3. Select the data-file to sync, by default the oldest unsynced file will be selected
4. hit the "Sync" button, if it is a zip file it gets unpacked and you must hit the "Sync" button again
5. The data is now synced with your database


## Automation

For each MetaModels-OpenImmo Link you can configure automatic syncing and deletion of old files.

This automation uses Contao's cron service. By default it requires the page to be called by any web browser regulary to work.

You can also setup Contao's cron service to be executed by your systems cron.


## Field Callbacks

You can add a callback function to each field-link.

It will be passed the value from the XML, the field object, the immo-array, the xml tree, the current xpath and the metamodel attribute.

It must return the value to be set on the field.

    public static function fieldCallback($value, $field_obj, &$immo, &$xml, $xpath, $metamodelAttribute)
    {
        ...

        return $value;
    }

## Hooks

MetaModels - OpenImmo provides a hook that is called for each item that will be synced with the database

    $GLOBALS['TL_HOOKS']['metaModelsOpenImmoSync'][] = array('MyClass', 'myMethod')

It gets passed an array containing all synced fields and the original XML tree for that particular object within the <code>\_xml_</code> key of the array.

It must return the array. Every modification you made to it will be stored in the database.
